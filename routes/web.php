<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventParticipantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponsibleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::post('/contact', [HomeController::class, 'saveContact'])->name('contact.save');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');

    Route::get('/responsible/dashboard', function () {
        return view('responsible.dashboard'); 
    })->name('responsible.dashboard');

    Route::get('/student/dashboard', function () {
        return view('student.dashboard'); 
    })->name('student.dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::resource('admin/events', EventController::class);
Route::resource('participants', EventParticipantController::class);
Route::resource('admin/posts', PostController::class);
Route::resource('admin/clubs', ClubController::class);
Route::resource('messages', ContactMessageController::class);
Route::get('messages/{id}/reply', [ContactMessageController::class, 'reply'])->name('messages.reply');
Route::post('messages/{id}/reply', [ContactMessageController::class, 'sendReply'])->name('messages.sendReply');
Route::post('messages/{id}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('messages.markAsRead');
Route::resource('users', UserController::class);
Route::get('/clubs/pdf', [ClubController::class, 'downloadPdf'])->name('clubs.pdf');
Route::get('/events/pdf', [EventController::class, 'downloadPdf'])->name('events.pdf');
Route::get('admin/users/pdf', [UserController::class, 'downloadPdf'])->name('users.pdf');
Route::get('/events/{event}/participants/pdf', [EventParticipantController::class, 'downloadPdf'])->name('events.participants.pdf');
Route::get('/events/upcoming', [DashboardController::class, 'upcomingEvents'])->name('events.upcoming');
Route::post('/admin/clubs/{club}/validate', [ClubController::class, 'validateClub'])->name('clubs.validate');
});


//student routes

Route::middleware(['auth', 'role:student,club_responsible'])->name('student.')->group(function () {
Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

Route::get('/posts', [StudentController::class, 'postsIndex'])->name('posts.index');
Route::get('/events', [StudentController::class, 'eventsIndex'])->name('events.index');
// Show the participation form (GET)
Route::get('/events/{event}/participate', [StudentController::class, 'showParticipationForm'])
    ->name('events.participate');

// Handle the participation form submission (POST)
Route::post('/events/{event}/participate', [StudentController::class, 'participate'])
    ->name('events.participate.submit');

Route::get('/clubs', [StudentController::class, 'clubsIndex'])->name('clubs.index');

// Show the join form (GET)
Route::get('clubs/{club}/join', [StudentController::class, 'showJoinForm'])->name('clubs.join.form');

// Handle the join form submission (POST)
Route::post('clubs/{club}/join', [StudentController::class, 'joinClubSubmit'])->name('clubs.join.submit');

Route::get('clubs/{club}/leave', [StudentController::class, 'leaveClub'])->name('clubs.leave');

Route::get('/clubs/{club}', [StudentController::class, 'showClub'])->name('clubs.show');

Route::get('/clubs/{club}/members', [StudentController::class, 'showMembers'])->name('clubs.showMembers');

Route::get('student/clubs/create', [StudentController::class, 'createClub'])->name('clubs.create');
Route::post('/clubs', [StudentController::class, 'storeClub'])->name('clubs.store');


});
 //responsible routes
Route::middleware(['auth', 'role:club_responsible'])->name('responsible.')->group(function () {
Route::get('/responsible/dashboard', [ResponsibleController::class, 'dashboard'])->name('dashboard');

Route::get('responsible/clubs', [ResponsibleController::class, 'index'])->name('clubs.index');
    Route::get('responsible/clubs/{club}', [ResponsibleController::class, 'show'])->name('clubs.show');
    Route::get('responsible/clubs/{club}/edit', [ResponsibleController::class, 'edit'])->name('clubs.edit');
    Route::put('/responsible/clubs/{club}', [ResponsibleController::class, 'update'])->name('clubs.update');
    Route::get('responible/clubs/create', [ResponsibleController::class, 'create'])->name('clubs.create');
    Route::post('responsible/clubs', [ResponsibleController::class, 'store'])->name('clubs.store');

    Route::get('clubs/{club}/members/{member}/edit', [ResponsibleController::class, 'editMember'])->name('clubs.members.edit');
    Route::post('clubs/{club}/members/{member}/update', [ResponsibleController::class, 'updateMember'])->name('clubs.members.update');
    Route::post('clubs/{club}/members/{member}/validate', [ResponsibleController::class, 'validateMember'])->name('clubs.members.validate');
    Route::post('clubs/{club}/members/{member}/cancel', [ResponsibleController::class, 'cancelMember'])->name('clubs.members.cancel');
    Route::post('clubs/{club}/members/{member}/switch', [ResponsibleController::class, 'switchStatus'])->name('clubs.members.switch');
    Route::delete('/responsible/clubs/{club}/members/{member}', [ResponsibleController::class, 'destroyMember'])->name('clubs.members.destroy');
    Route::get('responsible/clubs/{club}/members/pdf', [ResponsibleController::class, 'downloadMembersPdf'])->name('clubs.members.pdf');

    // Events routes
    Route::get('responsible/events', [ResponsibleController::class, 'eventsIndex'])->name('events.index');
    Route::get('responsible/events/create', [ResponsibleController::class, 'createEvent'])->name('events.create');
    Route::post('responsible/events', [ResponsibleController::class, 'storeEvent'])->name('events.store');
    Route::get('responsible/events/{event}', [ResponsibleController::class, 'showEvent'])->name('events.show');
    Route::get('responsible/events/{event}/edit', [ResponsibleController::class, 'editEvent'])->name('events.edit');
    Route::put('responsible/events/{event}', [ResponsibleController::class, 'updateEvent'])->name('events.update');
    Route::patch('responsible/events/{event}/cancel', [ResponsibleController::class, 'cancelEvent'])->name('events.cancel');
    
    // Event Participants Management
    Route::get('responsible/events/{event}/participants', [ResponsibleController::class, 'participantsIndex'])->name('events.participants.index');
    Route::put('responsible/events/{event}/participants/{participant}', [ResponsibleController::class, 'updateParticipant'])->name('events.participants.update');
    Route::delete('responsible/events/{event}/participants/{participant}', [ResponsibleController::class, 'destroyParticipant'])->name('events.participants.destroy');
    Route::get('responsible/events/{event}/participants/pdf', [ResponsibleController::class, 'downloadParticipantsPdf'])->name('events.participants.pdf');
    
    // Posts Management
    Route::get('responsible/posts', [ResponsibleController::class, 'postsIndex'])->name('posts.index');
    Route::get('responsible/posts/create', [ResponsibleController::class, 'createPost'])->name('posts.create');
    Route::post('responsible/posts', [ResponsibleController::class, 'storePost'])->name('posts.store');
    Route::get('responsible/posts/{post}/edit', [ResponsibleController::class, 'editPost'])->name('posts.edit');
    Route::put('responsible/posts/{post}', [ResponsibleController::class, 'updatePost'])->name('posts.update');
    Route::delete('responsible/posts/{post}', [ResponsibleController::class, 'destroyPost'])->name('posts.destroy');

    
});
require __DIR__.'/auth.php';
