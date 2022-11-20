<?php

namespace App\Http\Controllers;

use App\Models\Setting;
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
        $settings = DB::table('settings')->get()->toArray();
        return view('admin.settings.ticketlimit', [
            'limit' => $settings,
            'message' => "Ticket Limitation Updated Successfully!",
            'color' => "#4BB543"
        ]);
    }
}
