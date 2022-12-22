<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Student;
use App\Models\Userlog;
use App\Models\Studentlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function ticketlimit() {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        $settings = DB::table('settings')->get()->toArray();

        // dd($settings);
        return view('admin.settings.ticketlimit', [
            'limit' => $settings,
            'message' => null
        ]);
    }

    public function updateLimit(Request $request) {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        // dd($request);

        $formFields = $request->validate([
            'ticketLimit' => 'required',
        ]);

        $setting = DB::table('settings')->get()->toArray();
        $getSetting = Setting::find($setting[0]->id);

        $getSetting->update($formFields);
        // dd($getSetting->ticketLimit);

        $logFields['action_type'] = "EditLimit";
        $logFields['user_id'] = auth()->user()->id;
        $logFields['ticketLimit'] = $request->ticketlimit;
        Userlog::create($logFields);

        $settings = DB::table('settings')->get()->toArray();
        return view('admin.settings.ticketlimit', [
            'limit' => $settings,
            'message' => "Ticket Limitation Updated Successfully!",
            'color' => "#4BB543"
        ]);
    }

    public function studentAudit() {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        return view('admin.settings.student-log', [
            'studentlogs' => Studentlog::latest()->paginate(20)
        ]);
    }

    public function studentSummary() {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        return view('admin.settings.student-summary', [
            'studentlogs' => Student::latest()->paginate(20)
        ]);
    }

    public function userAudit() {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        return view('admin.settings.user-log', [
            'userlogs' => Userlog::latest()->paginate(20)
        ]);
    }
}
