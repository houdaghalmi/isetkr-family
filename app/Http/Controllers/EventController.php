<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Club;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('club')->paginate(10);
        $clubs = Club::all();
        $responsibles = User::where('role', 'club_responsible')->orWhere('role', 'student')->get();
        return view('admin.events.index', compact('events', 'clubs', 'responsibles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clubs = Club::all();
        return view('admin.events.create', compact('clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'title' => 'required|string|max:255',
            'intervenant' => 'required|string|max:255',
            'description' => 'required|string',
            'datetime' => 'required|date',
            'location' => 'required|string|max:255',
            'poster' => 'nullable|image',
            // 'status' => 'required|in:pending,completed,canceled',
            // 'certificated' => 'boolean',
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('events', 'public');
        }
        $validated['certificated'] = $request->has('certificated');
        $validated['status'] = $request->input('status', 'pending');

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event created!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::with('club')->findOrFail($id);
        $participants = $event->participants()->with('user')->paginate(5);
        return view('admin.events.show', compact('event', 'participants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $clubs = Club::all();
    
        return view('admin.events.edit', compact('event', 'clubs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'title' => 'required|string|max:255',
            'intervenant' => 'required|string|max:255',
            'description' => 'required|string',
            'datetime' => 'required|date',
            'location' => 'required|string|max:255',
            'poster' => 'nullable|image',
            'status' => 'required|in:pending,completed,canceled',
            'certificated' => 'boolean',
        ]);

        if ($request->hasFile('poster')) {
            // Delete old poster if exists
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }
            $validated['poster'] = $request->file('poster')->store('events', 'public');
        }
        $validated['certificated'] = $request->has('certificated');

        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->poster) {
            Storage::disk('public')->delete($event->poster);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted!');
    }

    public function downloadPdf()
    {
        $events = \App\Models\Event::with('club')->get();
        $pdf = Pdf::loadView('admin.events.pdf', compact('events'));
        return $pdf->download('events_report.pdf');
    }
}
