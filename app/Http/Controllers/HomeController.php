<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Event;
use App\Models\Post;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $nextEvent = Event::where('datetime', '>', now())
            ->orderBy('datetime', 'asc')
            ->first();
        $clubs=Club::all();

        $events = Event::with('club')
            ->orderBy('datetime', 'desc')
            ->take(3)
            ->get();

        // Format events for FullCalendar
        $calendarEvents = Event::where('datetime', '>', now())
            ->with('club')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->datetime->toIso8601String(),
                    'intervenant' => $event->intervenant,
                    'description' => $event->description,
                    'location' => $event->location,
                    'certificated' => $event->certificated,
                    'className' => $event->certificated ? 'certificated-event' : 'regular-event',
                    'extendedProps' => [
                        'club' => $event->club->name ?? null,
                        'poster' => $event->poster ? asset('storage/' . $event->poster) : null,
                    ]
                ];
            });

        $posts = Post::with('club')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('welcome', compact('nextEvent', 'events', 'posts', 'calendarEvents','clubs'));
    }

    public function saveContact(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create([
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your message has been sent!');
    }
}