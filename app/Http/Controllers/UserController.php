<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categ;
use App\Models\Ticket;
use App\Models\Userlog;
use App\Models\Usercateg;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\CreateYourAccount;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    // Show User Profile
    public function profile() {
        return view('admin.users.profile', [
            'usercategs' => Usercateg::where('user_id', auth()->user()->id)->get()
        ]);
    }

    // Show users list
    public function index() {
        // Make sure user is an admin
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        return view('admin.users.index', [
            'heading' => 'Users',
            'users' => User::latest()->filter(request(['search']))->paginate(5)
        ]);
    }

    // Show archived users list
    public function archived(){
        // Make sure user is an admin
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }
        return view('admin.users.archived', [
            'heading' => 'Users',
            'users' => User::onlyTrashed()->filter(request(['search']))->paginate(5)
        ]);
    }

    // Show single user
    public function show(User $user) {
        return view('admin.users.show', [
            'user' => $user,
            'usercategs' => Usercateg::where('user_id', $user->id)->get()
        ]);
    }

    // Show create form
    public function create() {
        // Make sure user logged in is an admin
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        return view('admin.users.create', [
            'categs' => Categ::where('archive', 0)->get()
        ]);
    }

    // Store New User Data
    public function store(Request $request) {
        // Make sure user is an admin
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        // $categs = [];
        // for($x=0; $x<count($request->categ_id); $x++){
        //     $categ = (int)$request->categ_id[$x];
        //     $categs[$x] = $categ;
        // }

        // $categString = strval($categs);

        // $categs = "|";
        // for($x=0; $x<count($request->categ_id); $x++){
        //     $categ = strval($request->categ_id[$x]);
        //     $categs = $categs . $categ . "|";
        // }

        $formFields = $request->validate([
            'firstName' => ['required', 'min:2'],
            'lastName' => ['required', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'role' => 'required',
        ]);

        $formFields['register_token'] = Str::random(42);
        // $formFields['tickets'] = 0;
        $formFields['password'] = bcrypt(Str::random(20));

        $formFields['verified'] = false;

        // $formFields['categ_id'] = $categString;
        // $formFields['categ_id'] = $categs;

        // dd($formFields);

        $logFields['user_id'] = auth()->user()->id;
        $logFields['action_type'] = "CreateU";
        $logFields['userId'] = $request->email;

        Userlog::Create($logFields);

        $user = User::create($formFields);

        if ($request->categ_id != null) {
            for($x=0; $x < count($request->categ_id); $x++) {
                $categFields['user_id'] = $user->id;
                $categFields['categ_id'] = $request->categ_id[$x];
                Usercateg::create($categFields);
            }
        }

        Mail::to($user->email)->send(new CreateYourAccount($user));

        return redirect('/users')->with('message', 'User invitation created');
    }

    // Show Create Password For New Users
    public function register($id){
        $user = User::find($id);
        // dd($user->id);
        if(!$user || !$user->register_token) {
            abort(404, 'Not Found');
        }

        return view('admin.users.register', ['user' => $user]);
    }

    // Create Password For New Users
    public function createPassword(User $user, Request $request){
        if (!$user->register_token){
            abort(403, 'Unauthorized Action');
        }

        // $formFields = $request->validate([
        //     'password' => 'required|confirmed|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
        // ]);

        $formFields = $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()]
        ]);

        // $formFields = $request->validate([
        //     'passowrd' => [
        //         'required',
        //         Password::min(8)
        //             ->letters()
        //             ->mixedCase()
        //             ->numbers()
        //             ->symbols()
        //     ]
        // ]);
            

        // regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/

        // $formFields = Validator::make($request->all(), [
        //     'password' => [
        //         'required', 
        //         'confirmed', 
        //         Password::min(8)
        //             ->letters()
        //             ->mixedCase()
        //             ->numbers()
        //             ->symbols()
        //     ],
        // ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Set email_verified_at to true
        $formFields['verified'] = true;

        // Remove register_token
        $formFields['register_token'] = null;

        // Verify email
        $formFields['email_verified_at'] = now();

        $user->update($formFields);

        return redirect('/login')->with('message', 'Please log in to continue');
    } 

    // Show Edit User Form
    public function edit(User $user){
        // dd($user->id);
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }
        $getUserCategs = DB::table('usercategs')->where('user_id', $user->id)->select('categ_id')->get()->toArray();
        // $usercategs = array_values($getUserCategs);
        $usercategs = array();
        for ($x=0; $x < count($getUserCategs); $x++) {
            array_push($usercategs, $getUserCategs[$x]->categ_id);
        }

        // dd($usercategs);
        return view('admin.users.edit', [
            'user' => $user,
            'categ' => DB::table('categs')->where('archive', 0)->select('id', 'type', 'name')->get()->toArray(),
            'usercategs' => $usercategs
        ]);
    }

    // Update User
    public function update(Request $request, User $user){
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        $formFields = $request->validate([
            'role' => 'required',
        ]);

        DB::table('usercategs')->where('user_id', $user->id)->delete();

        // dd($request->categ);
        if ($request->categ_id != null) {
            for($x=0; $x < count($request->categ_id); $x++) {
                $categFields['user_id'] = $user->id;
                $categFields['categ_id'] = $request->categ_id[$x];
                Usercateg::create($categFields);
            }
        }

        $user->update($formFields);

        $logFields['user_id'] = auth()->user()->id;
        $logFields['action_type'] = "EditU";
        $logFields['userId'] = $user->email;
        Userlog::create($logFields);

        return redirect('/users')->with('message', 'User updated successfully');
    }

    // Delete User
    public function destroy(User $user) {
        // Make sure logged in user is owner
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        $reopens = DB::table('reopens')
                    ->where('user_id', $user->id)
                    ->where('response', null)
                    ->get()->toArray();

        $tickets = DB::table('tickets')
                    ->where('user_id', $user->id)
                    ->whereNot('status', "Resolved")
                    ->whereNot('status', "Voided")
                    ->whereNot('status', "Inactive")
                    ->whereNot('status', "Reopened")
                    ->get()->toArray();

        
        // dd($user->id);
        // dd($reopens[0]->ticket_id);
        // dd(count($reopens));
        if (count($reopens) > 0) {
            // dd($reopens);
            for($x=0; $x < count($reopens); $x++) {
                // dd($x);
                $ticket = Ticket::find($reopens[$x]->ticket_id);
                $users = DB::table('usercategs')
                            ->whereNot('user_id', $user->id)
                            ->where('categ_id', $ticket->categ_id)
                            ->get()->toArray();
                
                $verified = DB::table('users')
                            ->where('deleted_at', null)
                            ->where('verified', true)
                            ->where('role', 'FDO')
                            ->select('id')
                            ->get()->toArray();

                $verifiedUsers = array();
                for ($y=0; $y < count($verified); $y++) {
                    array_push($verifiedUsers, $verified[$y]->id);
                }

                for ($z=0; $z < count($users); $z++) {
                    if (!(in_array($users[$z]->user_id, $verifiedUsers))){
                        unset($users[$z]);
                    }
                }
                // dd($users);
                if (count($users) == 0) {
                    $admins = DB::table('users')
                                ->whereNot('id', $user->id)
                                ->where('verified', true)
                                ->where('role', 'Admin')
                                ->get()->toArray();

                    // dd($admins);
    
                    $min = DB::table('tickets')->where('user_id', $admins[0]->id)->whereNot('status', 'Resolved')->count();
                    $min_id = $admins[0]->id;
    
                    for($b=1; $b<count($admins); $b++){
                        $a = DB::table('tickets')->where('user_id', $admins[$b]->id)->whereNot('status', 'Resolved')->count();
                        if($min > $a) {
                            $min = $a;
                            $min_id = $admins[$b]->id;
                        }
                    }
                    
                    $notifFields['user_id'] = $min_id;
                    // DB::table('reopens')->where('id', $reopens[$x]->id)->update(['user_id' => $min_id]);
                    // DB::table('tickets')->where('id', $reopens[$x]->ticket_id)->update(['user_id' => $min_id]);

                    // $notifFields['type'] = "Transfer Reopen";
                    // $notifFields['ticketId'] = $ticket->id;
                    // $notifFields['reopenId'] = $reopens[$x]->id;
                    // Notification::create($notifFields);

                    // $assignee = User::find($min_id);
                    // $userFields['newNotifs'] = $assignee->newNotifs + 1;
                    // $assignee->update($userFields);
                } else {
                    $firstKey = array_key_first($users);
                    $min = DB::table('tickets')->where('user_id', $users[$firstKey]->user_id)->whereNot('status', 'Resolved')->count();
                    $min_id = $users[$firstKey]->user_id;
                    
                    for($c=$firstKey+1; $c<count($users); $c++){
                        $a = DB::table('tickets')->where('user_id', $users[$c]->user_id)->whereNot('status', 'Resolved')->count();
                        if($min > $a) {
                            $min = $a;
                            $min_id = $users[$c]->user_id;
                        }
                    }
                    // dd($reopens);
                    // dd($min_id);
                    $notifFields['user_id'] = $min_id;
                    // DB::table('reopens')->where('id', $reopens[$x]->id)->update(['user_id' => $min_id]);
                    // DB::table('tickets')->where('id', $reopens[$x]->ticket_id)->update(['user_id' => $min_id]);

                    // $notifFields['type'] = "Transfer Reopen";
                    // $notifFields['ticketId'] = $ticket->id;
                    // $notifFields['reopenId'] = $reopens[$x]->id;
                    // Notification::create($notifFields);

                    // $assignee = User::find($min_id);
                    // $userFields['newNotifs'] = $assignee->newNotifs + 1;
                    // $assignee->update($userFields);
                }
                
                // dd($reopens);

                // dd($x);
                $notifFields['type'] = "Transfer Reopen";
                $notifFields['ticketId'] = $ticket->id;
                $notifFields['reopenId'] = $reopens[$x]->id;
                Notification::create($notifFields);

                // dd($min_id);
                $assignee = User::find($min_id);
                $userFields['newNotifs'] = $assignee->newNotifs + 1;
                $assignee->update($userFields);

                DB::table('reopens')->where('id', $reopens[$x]->id)->update(['user_id' => $min_id]);
                DB::table('tickets')->where('id', $reopens[$x]->ticket_id)->update(['user_id' => $min_id]);
            }
        }

        // $admins = DB::table('users')->where('verified', true)->where('role', 'Admin')->get()->toArray();
        // dd($admins);
        // dd($tickets[0]->categ_id);
        if (count($tickets) > 0) {
            for($x=0; $x < count($tickets); $x++) {
                $users = DB::table('usercategs')
                            ->whereNot('user_id', $user->id)
                            ->where('categ_id', $tickets[$x]->categ_id)
                            ->get()->toArray();

                $verified = DB::table('users')
                            ->where('deleted_at', null)
                            ->where('verified', true)
                            ->where('role', 'FDO')
                            ->select('id')
                            ->get()->toArray();

                $verifiedUsers = array();

                for ($y=0; $y < count($verified); $y++) {
                    array_push($verifiedUsers, $verified[$y]->id);
                }
                // dd($verifiedUsers);
                for ($z=0; $z < count($users); $z++) {
                    if (!(in_array($users[$z]->user_id, $verifiedUsers))){
                        unset($users[$z]);
                    }
                }

                // dd($users);
                if (count($users) == 0) {
                    $admins = DB::table('users')
                                ->where('deleted_at', null) //newline
                                ->whereNot('id', $user->id)
                                ->where('verified', true)
                                ->where('role', 'Admin')
                                ->get()->toArray();
    
                    // dd($admins);
                    $min = DB::table('tickets')->where('user_id', $admins[0]->id)->whereNot('status', 'Resolved')->whereNot('status', 'Voided')->count(); //newline voided
                    $min_id = $admins[0]->id;
    
                    for($b=1; $b<count($admins); $b++){
                        $a = DB::table('tickets')->where('user_id', $admins[$b]->id)->whereNot('status', 'Resolved')->whereNot('status', 'Voided')->count(); //newline voided
                        if($min > $a) {
                            $min = $a;
                            $min_id = $admins[$b]->id;
                        }
                    } 
                    $notifFields['user_id'] = $min_id;

                    // $assignee = User::find($min_id);
                    // $userFields['newNotifs'] = $assignee->newNotifs + 1;
                    // $assignee->update($userFields);

                    // DB::table('tickets')->where('id', $tickets[$x]->id)->update(['user_id' => $min_id]);
                } else {
                    $firstKey = array_key_first($users);
                    $min = DB::table('tickets')->where('user_id', $users[$firstKey]->user_id)->whereNot('status', 'Resolved')->whereNot('status', 'Voided')->count(); //newline voided
                    $min_id = $users[$firstKey]->user_id;
                    
                    for($c=$firstKey+1; $c<count($users); $c++){
                        $a = DB::table('tickets')->where('user_id', $users[$c]->user_id)->whereNot('status', 'Resolved')->whereNot('status', 'Voided')->count(); //newline voided
                        if($min > $a) {
                            $min = $a;
                            $min_id = $users[$c]->user_id;
                        }
                    }
                    $notifFields['user_id'] = $min_id;
                    // dd($min_id);

                    // $assignee = User::find($min_id);
                    // $userFields['newNotifs'] = $assignee->newNotifs + 1;
                    // $assignee->update($userFields);

                    // DB::table('tickets')->where('id', $tickets[$x]->id)->update(['user_id' => $min_id]);
                }
                // dd($tickets);
                $notifFields['type'] = "Transfer Ticket";
                $notifFields['ticketId'] = $tickets[$x]->id;
                Notification::create($notifFields);

                // dd($min_id);
                $assignee = User::find($min_id);
                $userFields['newNotifs'] = $assignee->newNotifs + 1;
                $assignee->update($userFields);

                DB::table('tickets')->where('id', $tickets[$x]->id)->update(['user_id' => $min_id]);

                // $updatedTickets = Ticket::all();
                // dd($updatedTickets);
                // DB::table('reopens')->where('id', $reopens[$x]->id)->update(['user_id' => 2]);
            }
        }

        $logFields['user_id'] = auth()->user()->id;
        $logFields['action_type'] = "ArchiveU";
        $logFields['userId'] = $user->email;
        Userlog::create($logFields);
        
        $user->delete();
        // DB::table('users')->where('id', $user->id)->delete();
        return redirect('/users')->with('message', 'User deleted successfully');
    }

    // Restore User
    public function restore($id) {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        User::onlyTrashed()
            ->where('id', $id)
            ->restore();
        // DB::table('users')->where('id', $user->id)->delete();

        $logFields['user_id'] = auth()->user()->id;
        $logFields['action_type'] = "UnarchiveU";
        $user = User::find($id);
        $logFields['userId'] = $user->email;
        Userlog::create($logFields);

        return redirect('/users')->with('message', 'User restored successfully');
    }

    // Show Login Form
    public function login(){
        return view('admin.users.login');
    }

    //Log User Out
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have logged out');
    }

    // Authenticate User
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            // auth()->login();

            return redirect('/dashboard')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    // Forgot Password --> Verify Email
    public function verifyFP(){
        return view('admin.forgotpass.email');
    }

    public function sendFP(Request $request) {
        // $code = Str::random(6);
        $find = DB::table('users')->where('email', $request->email)->first();

        if ($find) {
            $user = User::find($find->id);
            $formFields['resetToken'] = Str::random(42);
            $user->update($formFields);
            // dd($user->resetToken);
            Mail::to($user->email)->send(new ResetPassword($user));
            return redirect('/forgotpassword/sent');
        } else {
            return redirect('/forgotpassword/sent');
        }
    }

    public function sentFP() {
        return view('admin.forgotpass.sent');
    }

    // Reset Password Form
    public function resetPassword($id, $resetToken) {
        $user = User::find($id);

        return view('admin.forgotpass.reset', [
            'user' => $user
        ]);
    }

    // Update Password
    public function updatePassword(Request $request, User $user){
        if (!$user->resetToken){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()]
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Remove reset token
        $formFields['resetToken'] = null;

        $user->update($formFields);

        return redirect('/login')->with('message', 'Please log in to continue');
    }

    // Change Password (Security Settings)
    public function changePassword() {
        return view('admin.settings.security', [
            'message' => null
        ]);
    }

    // Update Change Password
    public function updateChange(Request $request, User $user) {
        if (auth()->user()->id != $user->id) {
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'currentPassword' => ['required', 'current_password'], 
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()]
        ]);

        // $formFields = $request->validate([
        //     'passowrd' => [
        //         'required',
        //         Password::min(8)
        //             ->letters()
        //             ->mixedCase()
        //             ->numbers()
        //             ->symbols()
        //     ]
        // ]);

        $hashedPassword = Auth::user()->getAuthPassword();

        if (Hash::check($request->currentPassword, $hashedPassword)){
            $formFields['password'] = bcrypt($request->password);
            $user->update($formFields);
            return view('admin.settings.security', [
                'message' => "Password Updated Successfully!",
                'color' => "#4BB543"
            ]);
        } else {
            return view('admin.settings.security', [
                'message' => "Failed to Change Password! Please Try Again.",
                'color' => "#FB7272"
            ]);
        }
    }

    // Decrement new notifications when clicked
    public function removeNew(Notification $notification){
        if (auth()->user()->id != $notification->user_id) {
            abort(403, 'Unauthorized Access');
        }

        // dd($notification->clicked == false);

        if ($notification->clicked == false) {
            $user = User::find($notification->user_id);
            $formFields['newNotifs'] = $user->newNotifs - 1;
            $user->update($formFields);

            $notifFields['clicked'] = 1;
            $notification->update($notifFields);
        }

        // dd($notification->clicked);

        // dd(auth()->user()->newNotifs);

        return redirect()->route('ticket', [$notification->ticketId]);
    }
}
