<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Categ;
use App\Models\Reopen;
use App\Models\Ticket;
use App\Mail\VerifyNew;
use App\Models\Setting;
use App\Models\Student;
use App\Mail\VoidedTicket;
use App\Mail\OngoingTicket;
use Illuminate\Support\Str;
use App\Mail\ResolvedTicket;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\NewTicketSubmitted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
// use Barryvdh\DomPDF\PDF;

// -------------------------------------------
// ** CONTROLLER FOR SUBMITTING NEW TICKETS **
// ** AND UPDATING TICKET STATUS **
// -------------------------------------------

class TicketController extends Controller
{
    // ---- STUDENT VIEWS ----
    // Submit new ticket show
    // Verify email first
    public function inputNew() {
        return view('email.new.index');
    }

    // View Student Tickets
    public function studentView(Student $student){
        return view('admin.tickets.student-view', [
            'tickets' => $student->tickets()->get()
        ]);
    }

    // Show Single Student Ticket
    public function studentShow(Student $student, Ticket $ticket){
        return view('admin.tickets.student-show', [
            'ticket' => $ticket,
            'student' => $student
        ]);
    }

    // Send code
    public function emailNew(Request $request) {
        $code = Str::random(6);
        $find = DB::table('students')->where('email', $request->email)->first();
        
        if ($find) {
            $student = Student::find($find->id);

            $setting = DB::table('settings')->get()->toArray();
            $getSetting = Setting::find($setting[0]->id);
            // dd($getSetting->ticketLimit);
            if($student->ongoingTickets >= $getSetting->ticketLimit){
                return view('admin.tickets.limit-reached', [
                    'student' => $student
                ]);
            }
            $formFields['code'] = $code;
            $student->update($formFields);
            Mail::to($student->email)->send(new VerifyNew($student, $code));
            return redirect('/new/code');
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

        return redirect('/new/code');
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
            'categs' => Categ::where('archive', 0)->get(),
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

        // $categ_id = "|" . $request->categ_id . "|";

        $formFields['student_id'] = (string)$student->id;
        // $verifiedUsers = DB::table('users')->where('verified', true)->get();
        // $users = DB::table('users')
        // ->joinSub($latestPosts, 'latest_posts', function ($join) {
        //     $join->on('users.id', '=', 'latest_posts.user_id');
        // })->get();
        $users = DB::table('usercategs')->where('categ_id', $request->categ_id)->get()->toArray();
        
        $verified = DB::table('users')->where('verified', true)->where('role', "FDO")->select('id')->get()->toArray();
        $verifiedUsers = array();
        for ($x=0; $x < count($verified); $x++) {
            array_push($verifiedUsers, $verified[$x]->id);
        }

        // dd($users);

        for ($x=0; $x < count($users); $x++) {
            if (!(in_array($users[$x]->user_id, $verifiedUsers))){
                unset($users[$x]);
            }
        }

        // dd($verifiedUsers);
        // dd($users);
        // $users = array(); 
        // dd($users);
        // $users = DB::table('users')->where('verified', true)->where('role', 'FDO')->where('categ_id', 'like', '%' . $categ_id . '%')->get()->toArray();

        if (count($users) == 0) {
            $admins = DB::table('users')->where('verified', true)->where('role', "Admin")->get()->toArray();
            // dd($admins);
            $min = DB::table('tickets')->where('user_id', $admins[0]->id)->whereNot('status', 'Resolved')->whereNot('status', 'Voided')->count();
            $min_id = $admins[0]->id;
            // dd($min_id);

            for($x=1; $x<count($admins); $x++){
                $a = DB::table('tickets')->where('user_id', $admins[$x]->id)->whereNot('status', 'Resolved')->whereNot('status', 'Voided')->count();
                if($min > $a) {
                    $min = $a;
                    $min_id = $admins[$x]->id;
                    // dd($min);
                }
            }
            // dd($min);

            $formFields['user_id'] = $min_id;
            $formFields['status'] = 'New';
            $assignee = User::find($min_id);
            $formFields['assignee'] = $assignee->email;
            // $formFields['dateSubmitted'] = now();

            $ticket = Ticket::create($formFields);
            $student->update($studentFields);

            $notifFields['user_id'] = $min_id;
            $notifFields['type'] = "New Ticket";
            $notifFields['ticketId'] = $ticket->id;
            Notification::create($notifFields);

            $userFields['newNotifs'] = $assignee->newNotifs + 1;
            $assignee->update($userFields);

            // return redirect('/new/submitted');
        } else {
            $firstKey = array_key_first($users);
            $min = DB::table('tickets')->where('user_id', $users[$firstKey]->user_id)->whereNot('status', 'Resolved')->count();
            $min_id = $users[$firstKey]->user_id;

            // dd($firstKey+1);
            
            for($x=$firstKey+1; $x<count($users); $x++){
                $a = DB::table('tickets')->where('user_id', $users[$x]->id)->whereNot('status', 'Resolved')->count();
                if($min > $a) {
                    $min = $a;
                    $min_id = $users[$x]->id;
                }
            }

            $formFields['user_id'] = $min_id;
            // $formFields['dateSubmitted'] = now();
            $assignee = User::find($min_id);
            $formFields['assignee'] = $assignee->email;

            $ticket = Ticket::create($formFields);
            $student->update($studentFields);

            $notifFields['user_id'] = $min_id;
            $notifFields['type'] = "New Ticket";
            $notifFields['ticketId'] = $ticket->id;
            Notification::create($notifFields);
        }

        // dd($ticket->user->email);

        Mail::to($ticket->student->email)->send(new NewTicketSubmitted($ticket));

        return redirect('/new/submitted');
    }

    // Show submitted successfully page
    public function newSuccess(){
        return view('admin.tickets.submitted');
    }


    // ---- ADMIN/FDO VIEW ----
    // Generate pdf
    public function createPDF() {
        $tickets = Ticket::all();

        // $pdf = new PDF;
        // $pdf->loadView('admin.tickets.report');
        $pdf = PDF::loadView('admin.tickets.report', ['tickets'=>$tickets]);

        return $pdf->download('report.pdf');
    }

    // Show all tickets
    public function index() {
        return view('admin.tickets.index', [
            'heading' => 'All Tickets',
            'tickets' => Ticket::latest()
                ->filter(request(['search']))
                ->filter(request(['categ_id']))
                ->filter(request(['priority']))
                ->filter(request(['user_id']))
                ->filter(request(['status']))
                ->paginate(10),
            'categs' => Categ::where('archive', 0)->get(),
            'users' => User::all()
        ]);
    }

    public function manage() {
        return view('admin.tickets.manage', [
            'heading' => 'All Tickets',
            'tickets' => Ticket::where('user_id', auth()->user()->id)
                ->filter(request(['search']))
                ->filter(request(['categ_id']))
                ->filter(request(['priority']))
                ->filter(request(['user_id']))
                ->filter(request(['status']))
                ->paginate(10),
            'categs' => Categ::all(),
            'users' => User::all()
        ]);
    }

    // Show single ticket
    public function show($id){
        return view('admin.tickets.show', [
            'ticket' => Ticket::find($id),
            'reopen' => DB::table('reopens')->where('ticket_id', $id)->latest()->first(),
            // 'rating' => DB::table('ratings')->where('ticket_id', $id)->get(),
            // 'reopenratings' => DB::table('reopenratings')->where
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

    // --------------------------------------------------
    // ** RESOLVING TICKETS IS AT FEEDBACK CONTROLLER **
    // --------------------------------------------------

    // Mark as Pending while waiting for student's feedback
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
        if ($ticket->user_id == auth()->id()) {
            return view('admin.tickets.transfer', [
                'ticket' => $ticket,
                'categs' => Categ::where('archive', 0)->get(),
                'users' => User::all()
            ]);
        }
        abort(403, 'Unauthorized Action');        
    }

    // Transfer Ticket
    public function setTransfer(Request $request, Ticket $ticket) {
        if ($ticket->user_id == auth()->id()) {
            if (!$request->categ_id && !$request->user_id){
                return back()->withErrors(['categ_id' => 'Form is empty'])->onlyInput('categ_id');
            }
    
            if ($request->categ_id) {
                $formFields['categ_id'] = $request->categ_id;
            }
    
            if ($request->user_id) {
                $formFields['user_id'] = $request->user_id;
                $notifFields['user_id'] = $request->user_id;
            } else {
                if ($ticket->status != "Resolved" && $ticket->status != "Voided") {
                    // $users = DB::table('users')->where('verified', true)->where('categ_id', 'like', '%' . $request->categ_id . '%')->get()->toArray();

                    $users = DB::table('usercategs')->where('categ_id', $request->categ_id)->get()->toArray();
                    $verified = DB::table('users')->where('verified', true)->where('role', 'FDO')->select('id')->get()->toArray();
                    $verifiedUsers = array();
                    for ($x=0; $x < count($verified); $x++) {
                        array_push($verifiedUsers, $verified[$x]->id);
                    }

                    for ($x=0; $x < count($users); $x++) {
                        if (!(in_array($users[$x]->user_id, $verifiedUsers))){
                            unset($users[$x]);
                        }
                    }

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
                        $notifFields['user_id'] = $min_id;
                    } else {
                        $firstKey = array_key_first($users);
                        $min = DB::table('tickets')->where('user_id', $users[$firstKey]->user_id)->whereNot('status', 'Resolved')->count();
                        $min_id = $users[$firstKey]->user_id;
                        
                        for($x=$firstKey+1; $x<count($users); $x++){
                            $a = DB::table('tickets')->where('user_id', $users[$x]->id)->whereNot('status', 'Resolved')->count();
                            if($min > $a) {
                                $min = $a;
                                $min_id = $users[$x]->id;
                            }
                        }
                        $formFields['user_id'] = $min_id;
                        $notifFields['user_id'] = $min_id;
                    }
                }
            }

            if ($request->user_id != null) {
                $user = User::find($formFields['user_id']);
            }
            $formFields['assignee'] = $user->email;
            $ticket->update($formFields);

            $notifFields['type'] = "Transfer Ticket";
            $notifFields['ticketId'] = $ticket->id;
            Notification::create($notifFields);
            return redirect()->route('ticket', [$ticket]);
        }
        abort(403, 'Unauthorized Action');
    }
}