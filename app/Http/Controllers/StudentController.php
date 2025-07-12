<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\EventParticipant;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


class StudentController extends Controller
{
    // Show the posts index page for students
    public function postsIndex()
    {
        // Fetch the 3 most recent event posts
        $recentPosts = Post::with('club')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Fetch all event posts, paginated (6 per page for a compact grid)
        $allPosts = Post::with('club')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        // Pass the data to the Blade view
        return view('student.posts.index', compact('recentPosts', 'allPosts'));
    }

    public function eventsIndex()
    {
        $user = Auth::user();
        $events = Event::with('club')->orderBy('datetime', 'desc')->get();

        // Get all event IDs the user is registered for
        $registeredEventIds = $user->eventParticipations->pluck('event_id')->toArray();

        return view('student.events.index', compact('events', 'registeredEventIds'));
    }

    public function showParticipationForm($eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = Auth::user();
        return view('student.events.participate', compact('event', 'user'));
    }

    public function participate(Request $request, $eventId)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'numero' => 'required|string|max:8',
            'classe' => 'required|string|max:10',
        ]);

        // Update user's phone if changed
        if ($user->numero !== $validated['numero']) {
            $user->numero = $validated['numero'];
            $user->save();
        }

        // Save participation
        EventParticipant::create([
            'event_id' => $eventId,
            'user_id' => $user->id,
            'classe' => $validated['classe'],
        ]);

        return redirect()->route('student.events.index')->with('success', 'Participation registered!');
    }
}
