<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Ticket;
use App\Models\Student;
use App\Models\Feedback;
use Illuminate\Http\Request;

// --------------------------------------------------------------
// ** CONTROLLER FOR RECEIVING FEEDBACKS AND RESOLVING TICKETS **
// --------------------------------------------------------------

class FeedbackController extends Controller
{
    // Show Feedback Form
    public function feedback(Ticket $ticket){
        return view('submit.feedback', [
            'ticket' => $ticket
        ]);
    }

    // Submit Feedback and Mark as Resolved
    public function setResolved(Request $request, Ticket $ticket) {

        dd($request);
        $feedbackFields = $request->validate([
            'rating' => 'required',
            'solved' => 'required',
            'satisfied' => 'required'
        ]);

        if ($request->comments) {
            $feedbackFields['comments'] = $request->comments;
        }
        $feedbackFields['student_id'] = $ticket->student->id;
        $feedbackFields['ticket_id'] = $ticket->id;

        $formFields['status'] = "Resolved";
        $formFields['dateResolved'] = now();

        $student = Student::find($ticket->student_id);        
        $studentFields['ongoingTickets'] = $student->ongoingTickets - 1;

        $feedback = Rating::create($feedbackFields);
        $ticket->update($formFields);
        $student->update($studentFields);

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

    // Reopen Unresolved Ticket
    public function reopenUnsolved(Ticket $ticket, Student $student){
        return view();
    }
}
