<?php

namespace App\Http\Controllers;

use App\Models\Categ;
use App\Models\Rating;
use App\Models\Reopen;
use App\Models\Reopenrating;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use PDF;

class DashboardController extends Controller
{
    public function dashboard() {
        $totalTickets = Ticket::count();
        $newTickets = Ticket::where('status', 'New')->count();
        $resolvedTickets = Ticket::where('status', 'Resolved')->count();
        $reopenedTickets = Reopen::count();

        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        // Get the categories for each type
        $requests = DB::table('categs')->where('type', 'Request')->select('id')->get()->toArray();
        $inquiries = DB::table('categs')->where('type', 'Inquiries')->select('id')->get()->toArray();
        $concerns = DB::table('categs')->where('type', 'Concerns')->select('id')->get()->toArray();
        $others = DB::table('categs')->where('type', 'Others')->select('id')->get()->toArray();

        // Get the total number of satisfied solution (new and reopened)
        $ticketSatisfied = Rating::where('satisfied', 1)->count();
        $reopenSatisfied = Reopenrating::where('satisfied', 1)->count();
        $satisfied = $ticketSatisfied + $reopenSatisfied;

        // Get the total number of rating/feedback (new and reopened)
        $totalTicketRating = Rating::count();
        $totalReopenRating = Reopenrating::count();
        $totalRating = $totalTicketRating + $totalReopenRating;

        if ($totalRating != 0) {
            // Calculate the satisfaction rating
            $calculate =(($satisfied / $totalRating) * 100);
            // Round up to 2 decimal points
            $roundCalculate = round($calculate, 2);
            $studentSatisfaction = $roundCalculate . "%";
        } else {
            $studentSatisfaction = "No Data";
        }

        if ($totalTickets != 0) {
            $requestThisMonth = 0;
            $inquiryThisMonth = 0;
            $concernThisMonth = 0;
            $otherThisMonth = 0;

            // Get the total number of requests this month
            for ($x=0; $x < count($requests); $x++) {
                $add = Ticket::where('categ_id', $requests[$x]->id)->whereMonth('created_at', $thisMonth)->whereYear( 'created_at',$thisYear)->count();
                $requestThisMonth = $requestThisMonth + $add;
            }

            // Get the total number of inquiries this month
            for ($x=0; $x < count($inquiries); $x++) {
                $add = Ticket::where('categ_id', $inquiries[$x]->id)->whereMonth('created_at', $thisMonth)->whereYear( 'created_at',$thisYear)->count();
                $inquiryThisMonth = $inquiryThisMonth + $add;
            }

            // Get the total number of concern this month
            for ($x=0; $x < count($concerns); $x++) {
                $add = Ticket::where('categ_id', $concerns[$x]->id)->whereMonth('created_at', $thisMonth)->whereYear( 'created_at',$thisYear)->count();
                $concernThisMonth = $concernThisMonth + $add;
            }

            // Get the total number of others this month
            for ($x=0; $x < count($others); $x++) {
                $add = Ticket::where('categ_id', $others[$x]->id)->whereMonth('created_at', $thisMonth)->whereYear( 'created_at',$thisYear)->count();
                $otherThisMonth = $otherThisMonth + $add;
            }
        } else {
            $requestThisMonth = "No Data";
            $inquiryThisMonth = "No Data";
            $concernThisMonth = "No Data";
            $otherThisMonth = "No Data";
        }

        // Get the array of all tickets_id
        // Get the count of reopen with the ticket_id (Reopens table)
        // Push to array
        // Calculate the average

        $ticket_ids = DB::table('tickets')->select('id')->get()->toArray();
        $reopens = array();

        for ($x=0; $x < count($ticket_ids); $x++) {
            $count = Reopen::where('ticket_id', $ticket_ids[$x]->id)->count();
            array_push($reopens, $count);
        }

        if (count($reopens) != 0) {
            $calcAverageReopen = round(array_sum($reopens) / count($reopens));
            $averageReopen = $calcAverageReopen . " Time/s";
        } else {
            $averageReopen = "No Data";
        }
 
        // Get the start and end date of each tickets
        // Calculate the diff of each start and end dates
        // Get the average

        $ticket_dates = DB::table('tickets')->whereNot('dateResponded', null)->select('created_at', 'dateResponded')->get()->toArray();
        $intervalsNew = array();

        $reopen_dates = DB::table('reopens')->whereNot('dateResponded', null)->select('created_at', 'dateResponded')->get()->toArray();
        $intervalsReopen = array();

        if (count($ticket_dates) != 0 || count($reopen_dates) != 0) {
            // dd($ticket_dates[0]->created_at);
            for ($x=0; $x < count($ticket_dates); $x++) {
                $date1 = strtotime($ticket_dates[$x]->created_at);
                $date2 = strtotime($ticket_dates[$x]->dateResponded);
                $interval = abs($date2 - $date1);

                array_push($intervalsNew, $interval);
            }

            for ($x=0; $x < count($reopen_dates); $x++) {
                $date1 = strtotime($reopen_dates[$x]->created_at);
                $date2 = strtotime($reopen_dates[$x]->dateResponded);
                $interval = abs($date2 - $date1);
                array_push($intervalsReopen, $interval);
            }

            // $merge = array();
            $merge = array_merge($intervalsNew, $intervalsReopen);
            // dd($merge);
            // 32715
            // 1924.411765

            // dd(array_sum($merge));

            $avgInterval = array_sum($merge) / count($merge);

            // dd($avgInterval);

            $years = floor($avgInterval / (365*60*60*24));
            $months = floor(($avgInterval - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($avgInterval - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $hours = floor(($avgInterval - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
            $minutes = floor(($avgInterval - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
            $seconds = floor(($avgInterval - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));

            $hours = strval($hours);
            $minutes = strval($minutes);
            $seconds = strval($seconds);

            if (strlen($hours) == 1) {
                $hours = "0" . $hours;
            }
            if (strlen($minutes) == 1) {
                $minutes = "0" . $minutes;
            }
            if (strlen($seconds) == 1) {
                $seconds = "0" . $seconds;
            }

            $averageResponseTime = $days . " Day/s " .$hours . ":" . $minutes . ":" . $seconds;
            // dd($avgResponseTime);
        } else {
            $averageResponseTime = "No Data";
        }

        


        $ratingsNew = DB::table('ratings')->select('rating')->get()->toArray();
        $ratingsReopen = DB::table('reopenratings')->select('rating')->get()->toArray();
        $ratings = array_merge($ratingsNew, $ratingsReopen);

        if (count($ratings) != 0) {
            $sum = 0;

            for ($x=0; $x < count($ratings); $x++) {
                $sum += $ratings[$x]->rating;
            }

            $averageRating = round($sum / count($ratings), 2);

            // 3.15
            // dd($averageRating);
        } else {
            $averageRating = "No Data";
        }

        // CHARTS
        // Tickets per month
        $chart_options = [
            'chart_title' => 'Users by days',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Tickets by days',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Ticket',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];
        $chart2 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Tickets by category',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Ticket',
            // 'group_by_field' => 'categ_id',
            'relationship_name' => 'categ',
            'group_by_field' => 'name',
            // 'group_by_period' => 'day',
            'chart_type' => 'pie',
        ];
        $chart3 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Tickets by type',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Ticket',
            // 'group_by_field' => 'categ_id',
            'relationship_name' => 'categ',
            'group_by_field' => 'type',
            // 'group_by_period' => 'day',
            'chart_type' => 'pie',
        ];
        $chart4 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Users by role',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\User',
            'group_by_field' => 'role',
            // 'group_by_period' => 'day',
            'chart_type' => 'pie',
        ];
        $chart5 = new LaravelChart($chart_options);

        return view('dashboard.index', compact('totalTickets', 'newTickets', 'resolvedTickets', 'reopenedTickets',
                                                'requestThisMonth', 'inquiryThisMonth', 'concernThisMonth', 'otherThisMonth',
                                                'studentSatisfaction', 'averageRating', 'averageReopen', 'averageResponseTime', 
                                                'chart1', 'chart2', 'chart3', 'chart4', 'chart5'));
    }

    // public function createPDF(){

    // }
}
