<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categ;
use App\Models\Usercateg;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\CreateYourAccount;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            'categs' => Categ::all()
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

        $formFields = $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

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

    // Change Password


    // Forgot Password


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
            'categ' => DB::table('categs')->select('id', 'type', 'name')->get()->toArray(),
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

        return redirect('/users')->with('message', 'User updated successfully');
    }

    // Delete User
    public function destroy(User $user) {
        // Make sure logged in user is owner
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }
        
        User::withTrashed()
            ->where('id', $user->id)
            ->restore();
        // DB::table('users')->where('id', $user->id)->delete();
        return redirect('/users')->with('message', 'User deleted successfully');
    }

    // Restore User
    public function restore(User $user) {
        if(auth()->user()->role == "FDO"){
            abort(403, 'Unauthorized Access');
        }

        $user->restore();
        // DB::table('users')->where('id', $user->id)->delete();
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

    // Change Password (Security Settings)
    public function changePassword() {
        return view('admin.settings.security');
    }
}
