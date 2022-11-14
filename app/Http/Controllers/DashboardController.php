<?php

namespace App\Http\Controllers;

use App\Models\Reopen;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function dashboard() {
        $totalTickets = Ticket::count();
        $newTickets = Ticket::where('status', 'New')->count();
        $resolvedTickets = Ticket::where('status', 'Resolved')->count();
        $reopenedTickets = Reopen::count();

        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $requestThisMonth = Ticket::where($this->categ->type, 'Request')->whereMonth('created_at', $thisMonth)->whereYear( 'created_at',$thisYear)->count();
        $inquiryThisMonth = Ticket::where($this->categ->type, 'Inquiries')->whereMonth('created_at', $thisMonth)->whereYear( 'created_at',$thisYear)->count();
        $concernThisMonth = Ticket::where($this->categ->type, 'Concerns')->whereMonth('created_at', $thisMonth)->whereYear( 'created_at',$thisYear)->count();
        $otherThisMonth = Ticket::where($this->categ->type, 'Others')->whereMonth('created_at', $thisMonth)->whereYear( 'created_at',$thisYear)->count();

        return view('dashboard.index', compact('totalTickets', 'newTickets', 'resolvedTickets', 'reopenedTickets',
                                                'requestThisMonth', 'inquiryThisMonth', 'concernThisMonth', 'otherThisMonth'));
    }
}
