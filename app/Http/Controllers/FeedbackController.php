<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use App\Models\Reopen;
use App\Models\Ticket;
use App\Models\Student;
use App\Models\Feedback;
use App\Models\Studentlog;
use App\Models\Reopenrating;
use Illuminate\Http\Request;

// --------------------------------------------------------------
// ** CONTROLLER FOR RECEIVING FEEDBACKS AND RESOLVING TICKETS **
// --------------------------------------------------------------

class FeedbackController extends Controller
{
    // -------------
    // ** TICKETS **
    // -------------

    // Show Feedback Form
    public function feedback(Ticket $ticket){
        return view('submit.feedback', [
            'ticket' => $ticket
        ]);
    }

    // Submit Feedback and Mark as Resolved
    public function setResolved(Request $request, Ticket $ticket) {

        // dd($request);
        $feedbackFields = $request->validate([
            'rating' => 'required',
            'satisfied' => 'required'
        ]);

        // dd($feedbackFields);

        if ($request->comments) {
            $feedbackFields['comments'] = $request->comments;
        }

        // if ($feedbackFields['satisfied'] == "true") {
        //     $feedback['satisfied'] = true;
        // } else {
        //     $feedbackFields['satisfied'] = false;
        // }

        $feedbackFields['student_id'] = $ticket->student->id;
        $feedbackFields['ticket_id'] = $ticket->id;

        $formFields['status'] = "Resolved";
        $formFields['dateResolved'] = now();

        $student = Student::find($ticket->student_id);        
        $studentFields['ongoingTickets'] = $student->ongoingTickets - 1;

        $feedback = Rating::create($feedbackFields);
        $ticket->update($formFields);
        $student->update($studentFields);

        $logFields['student_id'] = (string)$student->id;
        $logFields['action_type'] = "FeedbackN";
        $logFields['ticketId'] = $ticket->id;
        $assignee = User::find($ticket->user->id);
        $logFields['userEmail'] = $assignee->email;
        Studentlog::create($logFields);
        
        // dd($feedback);

        if ($feedback->satisfied == false) {
            return redirect()->route('reopenUnsolved', [$ticket, $student]);
        }

        return redirect('/feedback/submitted');
    }

    // Display Submitted Page
    public function submitted(){
        return view('submit.feedback-submitted');
    }

    // When Student is unsatisfied with solution
    // Reopen Unresolved Ticket
    public function reopenUnsolved(Ticket $ticket, Student $student){
        return view('submit.reopen-unsatisfied', [
            'ticket' => $ticket,
            'student' => $student
        ]);
    }

    // --------------------
    // ** REOPEN TICKETS **
    // --------------------

    // Show Feedback Form for Reopen Ticket
    public function feedbackReopen(Reopen $reopen, Ticket $ticket) {
        return view('submit.feedback-reopen', [
            'reopen' => $reopen,
            'ticket' => $ticket
        ]);
    }

    // Submit Feedback and Mark as Resolved
    public function setResolvedReopen(Request $request, Reopen $reopen, Ticket $ticket, Student $student){
        $feedbackFields = $request->validate([
            'rating' => 'required',
            'satisfied' => 'required'
        ]);

        if ($request->comments) {
            $feedbackFields['comments'] = $request->comments;
        }

        $feedbackFields['student_id'] = $student->id;
        $feedbackFields['reopen_id'] = $reopen->id;

        $TicketFields['status'] = "Resolved";
        $TicketFields['dateResolved'] = now();

        $StudentFields['ongoingTickets'] = $student->ongoingTickets - 1;

        $feedbackReopen = Reopenrating::create($feedbackFields);
        $ticket->update($TicketFields);
        $student->update($StudentFields);

        $logFields['student_id'] = (string)$student->id;
        $logFields['action_type'] = "FeedbackR";
        $logFields['ticketId'] = $ticket->id;
        $logFields['reopenId'] = $reopen->id;

        $assignee = User::find($reopen->user->id);
        $logFields['userEmail'] = $assignee->email;
        
        Studentlog::create($logFields);

        if ($feedbackReopen->satisfied == false) {
            return redirect()->route('reopenUnsolved', [$ticket, $student]);
        }

        return redirect('/feedback/submitted');
    }
}