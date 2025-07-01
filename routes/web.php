<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventParticipantController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::resource('events', EventController::class);
Route::resource('participants', EventParticipantController::class);
Route::resource('posts', PostController::class);
Route::resource('clubs', ClubController::class);
Route::resource('messages', ContactMessageController::class);
Route::get('messages/{id}/reply', [ContactMessageController::class, 'reply'])->name('messages.reply');
Route::post('messages/{id}/reply', [ContactMessageController::class, 'sendReply'])->name('messages.sendReply');
Route::post('messages/{id}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('messages.markAsRead');
Route::resource('users', UserController::class);
Route::get('/admin/clubs/pdf', [ClubController::class, 'downloadPdf'])->name('admin.clubs.pdf');
Route::get('/admin/events/pdf', [EventController::class, 'downloadPdf'])->name('admin.events.pdf');
Route::get('/admin/users/pdf', [UserController::class, 'downloadPdf'])->name('admin.users.pdf');
Route::get('/events/{event}/participants/pdf', [EventParticipantController::class, 'downloadPdf'])->name('admin.events.participants.pdf');

});
require __DIR__.'/auth.php';
