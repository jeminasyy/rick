<?php

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategController;
use App\Http\Controllers\ReopenController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

// Show Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard']);


// ----SECURITY----
// Show Change Password Form
Route::get('/security', [UserController::class, 'changePassword'])->middleware('auth');


// ----CATEGORIES----
// Show Categories List
Route::get('/categories', [CategController::class, 'index'])->middleware('auth');
// Show Create Category Form
Route::get('/categories/create', [CategController::class, 'create'])->middleware('auth');
// Create New Category
Route::post('/categories', [CategController::class, 'store'])->middleware('auth');
// Update Category

// Delete Category



// ----TICKETS----
// **Students Only

// 1. Submit New Ticket
// Show Input Email Form
Route::get('/new/verify-email', [TicketController::class, 'inputNew'])->middleware('guest');
// Send Email
Route::put('/new/email', [TicketController:: class, 'emailNew'])->middleware('guest');
// Show Input Code Form
Route::get('/new/code', [TicketController::class, 'codeNew'])->middleware('guest');
// Verify Code
Route::put('/new/verify', [TicketController::class, 'verifyNew'])->middleware('guest');
// Show Complete Student Information Form
Route::get('/student-information/{student}', [TicketController::class, 'completeInfo'])->middleware('guest')->name('completeInfo');
// Show Update Student Information 
Route::put('/student-information/{student}/save', [TicketController::class, 'saveInfo'])->middleware('guest');
// Show Create Ticket Form
Route::get('/tickets/{student}/create', [TicketController::class, 'create'])->middleware('guest')->name('createTicket');
// Store Ticket Data
Route::put('/tickets/{student}', [TicketController::class, 'store'])->middleware('guest');
// Display Success Page
Route::get('/new/submitted', [TicketController::class, 'newSuccess'])->middleware('guest');

// Display Student's Tickets
Route::get('/tickets/student/{student}', [TicketController::class, 'studentView'])->middleware('guest');
// Show Single Ticket
Route::get('/ticket/student/{student}/{ticket}', [TicketController::class, 'studentShow'])->middleware('guest');

// 2. Reopen Tickets
// Show Input Email Form
Route::get('/reopen/verify-email', [ReopenController::class, 'inputReopen'])->middleware('guest');
// Send Code to Email
Route::put('/reopen/email', [ReopenController:: class, 'emailReopen'])->middleware('guest');
// Show Input Code Form 
Route::get('/reopen/code', [ReopenController::class, 'codeReopen'])->middleware('guest');
// Verify the code
Route::put('/reopen/verify', [ReopenController::class, 'verifyReopen'])->middleware('guest');
// Display Student's Finished Tickets
Route::get('/reopen/view/{student}', [ReopenController::class, 'viewReopen'])->middleware('guest')->name('viewReopen');
// Show Reopen Ticket Form **PUT method
Route::get('/reopen/create/{ticket}/{student}', [ReopenController::class, 'createReopen'])->middleware('guest');
// Reopen Ticket
Route::put('/reopen/store/{ticket}/{student}', [ReopenController::class, 'storeReopen'])->middleware('guest');

// When Student is unsatisfied with the solution
// They can re-open the ticket
Route::get('/reopenConfirm/{ticket}/{student}', [FeedbackController::class, 'reopenUnsolved'])->middleware('guest')->name('reopenUnsolved');
// If Yes - Redirect to /reopen/ticket/student


// ----TICKETS----
// **Admin/FDO Only

// 1. Submit New Ticket
// Show Tickets list
Route::get('/tickets', [TicketController::class,'index'])->middleware('auth');
// Update Ticket Priority
Route::put('/{ticket}/ticket/updatePriority', [TicketController::class, 'updatePriority'])->middleware('auth');
// Mark as Ongoing
Route::put('/{ticket}/ticket/setOngoing', [TicketController::class, 'setOngoing'])->middleware('auth');
// Display Void Ticket Form
Route::get('/{ticket}/ticket/void', [TicketController::class, 'void'])->middleware('auth');
// Void Ticket
Route::put('/{ticket}/ticket/setVoided', [TicketController::class, 'setVoided'])->middleware('auth');
// Display Void Ticket Form
Route::get('/{ticket}/ticket/resolve', [TicketController::class, 'resolve'])->middleware('auth');
// Set Ticket as Pending Before Resolving
Route::put('/{ticket}/ticket/setPending', [TicketController::class, 'setPending'])->middleware('auth');
// Feedback Form --- STUDENTS ONLY
Route::get('/{ticket}/{student}/feedback', [FeedbackController::class, 'feedback'])->middleware('guest');
// Resolve Ticket -- AFTER SUBMITTING FEEDBACK
Route::put('/{ticket}/{student}/setResolved', [FeedbackController::class, 'setResolved'])->middleware('guest');
// Display Feedback Submitted Page
Route::get('/feedback/submitted', [FeedbackController::class, 'submitted'])->middleware('guest');
// View Single Ticket
Route::get('/tickets/{id}', [TicketController::class, 'show'])->middleware('auth')->name('ticket');
// Display Transfer Ticket Form
Route::get('/{ticket}/ticket/transfer', [TicketController::class, 'transfer'])->middleware('auth');
// Transfer Ticket
Route::put('/{ticket}/ticket/setTransfer', [TicketController::class, 'setTransfer'])->middleware('auth');

// 2. Reopen Tickets
// Update ticket priority
Route::put('/{reopen}/reopen/updatePriority', [ReopenController::class, 'updatePriority'])->middleware('auth');
// Mark as Ongoing
Route::put('/{reopen}/reopen/setOngoing', [ReopenController::class, 'setOngoing'])->middleware('auth');
// Display Void Ticket Form
Route::get('/{reopen}/reopen/void', [ReopenController::class, 'void'])->middleware('auth');
// Void Ticket
Route::put('/{reopen}/reopen/setVoided', [ReopenController::class, 'setVoided'])->middleware('auth');
// Display Resolve Ticket Form
Route::get('/{reopen}/reopen/resolve', [ReopenController::class, 'resolve'])->middleware('auth');
// Set Ticket as Pending Before Resolving
Route::put('/{reopen}/reopen/setPending', [ReopenController::class, 'setPending'])->middleware('auth');
// Feedback Form --- STUDENTS ONLY
Route::get('/{reopen}/{ticket}/{student}/feedback/reopen', [FeedbackController::class, 'feedbackReopen'])->middleware('guest');
// Resolve Ticket -- AFTER SUBMITTING FEEDBACK
Route::put('/{reopen}/{ticket}/{student}/reopen/setResolved', [FeedbackController::class, 'setResolvedReopen'])->middleware('guest');
// Display Transfer Ticket Form
Route::get('/{reopen}/reopen/transfer', [ReopenController::class, 'transfer'])->middleware('auth');
// Transfer Ticket
Route::put('/{reopen}/reopen/setTransfer', [ReopenController::class, 'setTransfer'])->middleware('auth');



// ----USERS----
// View User Profile
Route::get('profile', [UserController::class, 'profile'])->middleware('auth');
// View Users List
Route::get('/users', [UserController::class, 'index'])->middleware('auth');
// Show Create User Form
Route::get('/users/create', [UserController::class, 'create'])->middleware('auth');
// Create New Account
Route::post('/users', [UserController::class, 'store'])->middleware('auth');
// Verify User Email
Route::get('/users/verify', [UserController::class, 'verify'])->middleware('auth')->name('verification.notice');

// Complete Registration By Creating Password
// Show Create Password Form
Route::get('/{id}/{register_token}/register', [UserController::class, 'register'])->middleware('guest');
// Create Password
Route::put('/{user}/register', [UserController::class, 'createPassword'])->middleware('guest');

// Change Password


// Delete User


// ----AUTHENTICATION----
// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log User In
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
