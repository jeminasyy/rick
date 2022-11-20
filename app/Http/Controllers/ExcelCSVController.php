<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TicketsExport; 
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Ticket;

class ExcelCSVController extends Controller
{
    // public function index() {

    // }

    public function exportExcelCSV($slug) {
        return Excel::download(new TicketsExport, 'users.xlsx');
        // return Excel::download(new TicketsExport, 'tickets.'.$slug);
    }
}
