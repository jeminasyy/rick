<?php

namespace App\Http\Controllers;

use App\Models\Reopen;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() {
        $totalTickets = Ticket::count();
        $newTickets = Ticket::where('status', 'New')->count();
        $resolvedTickets = Ticket::where('status', 'Resolved')->count();
        $reopenedTickets = Reopen::count();

        return view('dashboard.index', compact('totalTickets', 'newTickets', 'resolvedTickets', 'Reopened Tickets'));
    }
}
