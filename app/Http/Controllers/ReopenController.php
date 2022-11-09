<?php

namespace App\Http\Controllers;

use App\Models\Reopen;
use App\Models\Ticket;
use App\Mail\VerifyNew;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReopenController extends Controller
{
    // ---- STUDENT VIEWS ----
    // Reopen Ticket
    // Verify email first
    public function inputReopen() {
        return view('email.reopen.index');
    }

    // Send code
    public function emailReopen(Request $request) {
        $code = Str::random(6);
        $find = DB::table('students')->where('email', $request->email)->first();
        
        if ($find) {
            $student = Student::find($find->id);
            if ($student->ongoingTickets >= 3) {
                return view('admin.tickets.limit-reached');
            }
            if($student->tickets > $student->ongoingTickets) {
                $formFields['code'] = $code;
                $student->update($formFields);
                Mail::to($student->email)->send(new VerifyNew($student, $code));
                return redirect('/reopen/code');
            }
            return view('email.reopen.no-tickets');
        }
        return redirect('/reopen/code');
    }

    // Show verify code form
    public function codeReopen(){
        return view('email.reopen.code');
    }

    // Verify email with code
    public function verifyReopen(Request $request){
        $find = DB::table('students')->where('code', $request->code)->first();
        if (! $find){
            abort(404, 'Not Found');
        }
        $student = Student::find($find->id);
        // return view();
        return redirect()->route('viewReopen', [$student]);
    }

    public function viewReopen(Student $student) {
        return view('email.reopen.view', [
            'tickets' => $student->tickets()->get()
        ]);
    }

    public function createReopen(Ticket $ticket){
        return view('email.reopen.create', [
            'ticket' => $ticket,
        ]);
    }

    public function storeReopen(Request $request, Ticket $ticket) {
        $formFields = $request->validate([
            'reason' => 'required'
        ]);
        
        if($request->reassign == 1) {
            $users = DB::table('users')->whereNot('id', $ticket->user->id)->where('verified', true)->where('role', 'FDO')->where('categ_id', 'like', '%' . $ticket->categ->id . '%')->get()->toArray();

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
        } else {
            $formFields['user_id'] = $ticket->user->id;
        }

        $formFields['ticket_id'] = $ticket->id;

        Reopen::create($formFields);
        $ticketField['status'] = "Opened";
        $ticket->update($ticketField);
    }
}
