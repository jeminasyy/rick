<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Student;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            $notifications = DB::table('notifications')->get()->toArray();
            for ($z=0; $z < count($notifications); $z++) {
                $date4 = date_create(Carbon::now());
                $date3 = date_create($notifications[$z]->created_at);
                $interval = date_diff($date3, $date4);

                // testing
                $intervalNum = intval($interval->format("%R%i"));
                if ($intervalNum > 3 ) {
                    DB::table('notifications')->where('id', $notifications[$z]->id)->delete();
                    $user = User::find($notifications[$z]->user_id);
                    if ($notifications[$z]->clicked == 0) {
                        $userField['newNotifs'] = $user->newNotifs - 1;
                        $user->update($userField);
                    }
                }

                // actual
                // $intervalNum = intval($interval->format("%R%d"));
                // if ($intervalNum > 7 ) {
                //     DB::table('notifications')->where('id', $notifications[$z]->id)->delete();
                // }
            }

            $tickets = DB::table('tickets')
                            ->where('dateResponded', null)
                            ->get()->toArray();

            for ($x=0; $x < count($tickets); $x++) {
                $date6 = date_create(Carbon::now());
                $date5 = date_create($tickets[$x]->updated_at);
                $interval = date_diff($date5, $date6);

                // testing
                $intervalNum = intval($interval->format("%R%i"));
                if ($intervalNum > 5 ) {
                    $notif['type'] = "Reminder Ticket";
                    $notif['user_id'] = $tickets[$x]->user_id;
                    $notif['ticketId'] = $tickets[$x]->id;
                    Notification::Create($notif);

                    $user = User::find($tickets[$x]->user_id);
                    $userField['newNotifs'] = $user->newNotifs + 1;
                    $user->update($userField);
                    echo($tickets[$x]->id);
                    // echo();
                }

                // actual
                // $intervalNum = intval($interval->format("%R%d"));
                // if ($intervalNum > 7 ) {
                //     $notif['type'] = "Reminder Ticket";
                //     $notif['user_id'] = $tickets[$x]->user_id;
                //     $notif['ticketId'] = $tickets[$x]->id;
                //     Notification::Create($notif);

                //     $user = User::find($tickets[$x]->user_id);
                //     $userField['newNotifs'] = $user->newNotifs + 1;
                //     $user->update($userField);
                // }
            }

            $reopens = DB::table('reopens')
                            ->where('dateResponded', null)
                            ->get()->toArray();

            for ($y=0; $y < count($reopens); $y++) {
                $date2 = date_create(Carbon::now());
                $date1 = date_create($reopens[$y]->updated_at);
                $interval = date_diff($date1, $date2);

                // testing
                $intervalNum = intval($interval->format("%R%i"));
                if ($intervalNum > 5 ) {
                    $notif['type'] = "Reminder Reopen";
                    $notif['user_id'] = $reopens[$y]->user_id;
                    $notif['ticketId'] = $reopens[$y]->ticket_id;
                    $notif['reopenId'] = $reopens[$y]->id;
                    Notification::Create($notif);

                    $user = User::find($reopens[$y]->user_id);
                    $userField['newNotifs'] = $user->newNotifs + 1;
                    $user->update($userField);
                    // echo($ticket);
                }

                // actual
                // $intervalNum = intval($interval->format("%R%d"));
                // if ($intervalNum > 7 ) {
                //     $notif['type'] = "Reminder Reopen";
                //     $notif['user_id'] = $reopens[$y]->user_id;
                //     $notif['ticketId'] = $reopens[$y]->ticket_id;
                //     $notif['reopenId'] = $reopens[$y]->id;
                //     Notification::Create($notif);
                
                //     $user = User::find($tickets[$x]->user_id);
                //     $userField['newNotifs'] = $user->newNotifs + 1;
                //     $user->update($userField);
                // }
            }

            $pendingTickets = DB::table('tickets')
                                ->whereNot('dateResponded', null)
                                ->where('status', "Pending")
                                ->get()->toArray();
            // echo($pendingTickets);

            for ($m=0; $m < count($pendingTickets); $m++) {
                $date7 = date_create($pendingTickets[$m]->dateResponded);
                $date8 = date_create(Carbon::now());
                $interval = date_diff($date7, $date8);
                
                $intervalNum = intval($interval->format("%R%i"));
                // echo($intervalNum);
                if ($intervalNum > 5) {
                    $student = Student::find($pendingTickets[$x]->student_id);
                    $studField['ongoingTickets'] = $student->ongoingTickets - 1;
                    $student->update($studField);

                    DB::table('tickets')->where('id', $pendingTickets[$x]->id)->update(['status' => "Inactive"]);
                }
            }

        })->everyMinute();

        // for actual
        // notifications stay in one week
        // ticket with no response - notify after one week
        // schedule daily

        // for testing
        // notifications - one minute
        // ticket with no response - four minutes
        // schedule every five minutes

        // 03:02:45.0 - 3 hours 2 mins 45 sec
        // 07:00:00.0 - 1 week
        // 1d 23:43:59.0

        // DB::table('usercategs')->where('user_id', $user->id)->delete();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
