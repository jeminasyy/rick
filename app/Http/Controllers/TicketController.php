<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categ;
use App\Models\Ticket;
use App\Mail\VerifyNew;
use App\Models\Student;
use App\Mail\VoidedTicket;
use App\Mail\OngoingTicket;
use Illuminate\Support\Str;
use App\Mail\ResolvedTicket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\NewTicketSubmitted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

// -------------------------------------------
// ** CONTROLLER FOR SUBMITTING NEW TICKETS **
// -------------------------------------------

class TicketController extends Controller
{
    // ---- STUDENT VIEWS ----
    // Submit new ticket show
    // Verify email first
    public function inputNew() {
        return view('email.new.index');
    }
    // Send code
    public function emailNew(Request $request) {
        $code = Str::random(6);
        $find = DB::table('students')->where('email', $request->email)->first();
        
        if ($find) {
            $student = Student::find($find->id);
            if($student->ongoingTickets >= 3){
                return view('admin.tickets.limit-reached');
            }
            $formFields['code'] = $code;
            $student->update($formFields);
            Mail::to($student->email)->send(new VerifyNew($student, $code));
            return redirect('/new/verify-code');
        }

        $formFields = $request->validate([
            'email' => ['required', 'email', Rule::unique('students', 'email')],
        ]);

        $formFields['id'] = Student::generateStudentid();
        $formFields['ongoingTickets'] = 0;
        $formFields['tickets'] = 0;
        // $formFields['code'] = bcrypt($code);
        $formFields['code'] = $code;

        $student = Student::create($formFields);
        
        Mail::to($student->email)->send(new VerifyNew($student, $code));

        return redirect('/new/verify-code');
    }

    // Show verify code form
    public function codeNew(){
        return view('email.new.code');
    }

    // Verify email with code
    public function verifyNew(Request $request){
        $find = DB::table('students')->where('code', $request->code)->first();
        if (! $find){
            abort(404, 'Not Found');
        }
        $student = Student::find($find->id);
        if(!$student->FName || !$student->LName || !$student->studNumber){
            return redirect()->route('completeInfo', [$student]);
        }

        return redirect()->route('createTicket', [$student]);
    }

    // Show complete information form
    public function completeInfo(Student $student){
        return view('complete-info', [
            'student' => $student
        ]);
    }

    // Update student information
    public function saveInfo(Request $request, Student $student){
        $formFields = $request->validate([
            'FName' => ['required', 'min:2'],
            'LName' => ['required', 'min:2'],
            'studNumber' => ['required', 'min:10']
        ]);

        $student->update($formFields);

        return redirect()->route('createTicket', [$student]);
    }

    // Show submit ticket form
    public function create(Student $student){
        return view('admin.tickets.create', [
            'categs' => Categ::all(),
            'student' => $student
        ]);
    }

    // Store new ticket
    public function store(Request $request, Student $student) {
        $studentFields['tickets'] = $student->tickets+1;
        $studentFields['ongoingTickets'] = $student->ongoingTickets + 1;

        $formFields = $request->validate([
            'categ_id' => 'required',
            'description' => 'required',
            'department' => 'required',
            'year' => 'required'
        ]);

        $categ_id = "|" . $request->categ->id . "|";

        $formFields['student_id'] = (string)$student->id;
        $users = DB::table('users')->where('verified', true)->where('role', 'FDO')->where('categ_id', 'like', '%' . $categ_id . '%')->get()->toArray();

        if (count($users) == 0) {
            $admins = DB::table('users')->where('verified', true)->where('role', 'Admin')->get()->toArray();

            $min = DB::table('tickets')->where('user_id', $admins[0]->id)->whereNot('status', 'Resolved')->whereNot('status', 'Voided')->count();
            $min_id = $admins[0]->id;

            for($x=1; $x<count($users); $x++){
                $a = DB::table('tickets')->where('user_id', $admins[$x]->id)->whereNot('status', 'Resolved')->whereNot('status', 'Voided')->count();
                if($min > $a) {
                    $min = $a;
                    $min_id = $admins[$x]->id;
                }
            }

            $formFields['user_id'] = $min_id;
            $formFields['status'] = 'New';
            $formFields['dateSubmitted'] = now();

            Ticket::create($formFields);
            $student->update($studentFields);
            return redirect('/new/submitted');
        }
        
        $min = DB::table('tickets')->where('user_id', $users[0]->id)->whereNot('status', 'Resolved')->count();
        $min_id = $users[0]->id;
        
        for($x=1; $x<count($users); $x++){
            $a = DB::table('tickets')->where('user_id', $users[$x]->id)->whereNot('status', 'Resolved')->count();
            if($min > $a) {
                $min = $a;
                $min_id = $users[$x]->id;
            }
        }

        $formFields['user_id'] = $min_id;
        $formFields['dateSubmitted'] = now();

        $ticket = Ticket::create($formFields);
        $student->update($studentFields);

        Mail::to($ticket->student->email)->send(new NewTicketSubmitted($ticket));

        return redirect('/new/submitted');
    }

    // Show submitted successfully page
    public function newSuccess(){
        return view('admin.tickets.submitted');
    }

    // Reopen existing ticket
    // Verify email first
    public function verifyReopen() {
        return view('admin.tickets.reopen.email');
    }
    // Show verify code form

    // Verify email with code

    

    // ---- ADMIN/FDO VIEW ----
    // Show all tickets
    public function index() {
        return view('admin.tickets.index', [
            'heading' => 'All Tickets',
            'tickets' => Ticket::latest()->filter(request(['search']))->paginate(10),
        ]);
    }

    // Show single ticket
    public function show($id){
        return view('admin.tickets.show', [
            'ticket' => Ticket::find($id)
        ]);
    } 

    // Update ticket priority
    public function updatePriority(Request $request, Ticket $ticket) {
        if ($ticket->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'priority' => 'required'
        ]);

        if ($request->priority == "High" || $request->priority == "Medium" || $request->priority == "Low"){
            if($ticket->status == "New"){
                $formFields['status'] = "Opened"; 
            }
            $ticket->update($formFields);
            return redirect()->route('ticket', [$ticket]);
        } else {
            auth()->logout();
        }
    }

    // Mark as ongoing
    public function setOngoing(Ticket $ticket) {
        if ($ticket->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        $formFields['status'] = "Ongoing";
        $ticket->update($formFields);

        Mail::to($ticket->student->email)->send(new OngoingTicket($ticket));
        
        return redirect()->route('ticket', [$ticket]);
    }

    // Show void ticket form
    public function void(Ticket $ticket) {
        return view('admin.tickets.void', [
            'ticket' => $ticket
        ]);
    }

    // Mark as voided
    public function setVoided(Request $request, Ticket $ticket) {
        if ($ticket->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'response' => 'required'
        ]);
        $formFields['status'] = "Voided";
        $formFields['dateResponded'] = now();

        $student = Student::find($ticket->student_id);
        $studentFields['ongoingTickets'] = $student->ongoingTickets - 1;

        $ticket->update($formFields);
        $student->update($studentFields);

        // dd($ticket);
        Mail::to($ticket->student->email)->send(new VoidedTicket($ticket));

        return redirect()->route('ticket', [$ticket]);
    }

    // Show resolve ticket form
    public function resolve(Ticket $ticket) {
        if ($ticket->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        return view('admin.tickets.resolve', [
            'ticket' => $ticket
        ]);
    }

    // Mark as Pending
    public function setPending(Request $request, Ticket $ticket) {
        if ($ticket->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([
            'response' => 'required'
        ]);
        $formFields['status'] = "Pending";
        $formFields['dateResponded'] = now();

        $ticket->update($formFields);

        Mail::to($ticket->student->email)->send(new ResolvedTicket($ticket));

        return redirect()->route('ticket', [$ticket]);
    }

    // Show transfer ticket form
    public function transfer(Ticket $ticket) {
        if (auth()->user()->role == "Admin" || $ticket->user_id == auth()->id()) {
            return view('admin.tickets.transfer', [
                'ticket' => $ticket,
                'categs' => Categ::all(),
                'users' => User::all()
            ]);
        }
        abort(403, 'Unauthorized Action');        
    }

    // Transfer Ticket
    public function setTransfer(Request $request, Ticket $ticket) {
        if (auth()->user()->role == "Admin" || $ticket->user_id == auth()->id()) {
            if (!$request->categ_id && !$request->user_id){
                return back()->withErrors(['categ_id' => 'Form is empty'])->onlyInput('categ_id');
            }
    
            if ($request->categ_id) {
                $formFields['categ_id'] = $request->categ_id;
            }
    
            if ($request->user_id) {
                $formFields['user_id'] = $request->user_id;
            } else {
                $users = DB::table('users')->where('verified', true)->where('categ_id', 'like', '%' . $request->categ_id . '%')->get()->toArray();
    
                if (count($users) == 0) {
                    $admins = DB::table('users')->where('verified', true)->where('role', 'Admin')->get()->toArray();
    
                    $min = DB::table('tickets')->where('user_id', $admins[0]->id)->whereNot('status', 'Resolved')->count();
                    $min_id = $admins[0]->id;
    
                    for($x=1; $x<count($users); $x++){
                        $a = DB::table('tickets')->where('user_id', $admins[$x]->id)->whereNot('status', 'Resolved')->count();
                        if($min > $a) {
                            $min = $a;
                            $min_id = $admins[$x]->id;
                        }
                    }
                    $formFields['user_id'] = $min_id;
                } else {
                    $min = DB::table('tickets')->where('user_id', $users[0]->id)->whereNot('status', 'Resolved')->count();
                $min_id = $users[0]->id;
                
                for($x=1; $x<count($users); $x++){
                    $a = DB::table('tickets')->where('user_id', $users[$x]->id)->whereNot('status', 'Resolved')->count();
                    if($min > $a) {
                        $min = $a;
                        $min_id = $users[$x]->id;
                    }
                }
                $formFields['user_id'] = $min_id;
                }
            }
            $ticket->update($formFields);
            return redirect()->route('ticket', [$ticket]);
        }
        abort(403, 'Unauthorized Action');
    }
}