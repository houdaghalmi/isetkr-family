<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubMember;
use App\Models\ContactMessage;
use App\Models\Event;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'clubs' => Club::count(),
            'events' => Event::count(),
            'users' => User::count(),
            'posts' => Post::count(),
            'members'=>ClubMember::count(),
        ];
        $recentMessages = ContactMessage::latest()
            ->take(5)
            ->get();
        $user = Auth::user();
        return view('admin.dashboard', compact('stats','recentMessages', 'user'));
    }
}