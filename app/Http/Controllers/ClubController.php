<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use App\Models\ClubMember;
use App\Models\Event;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::withCount(['events', 'members'])->paginate(10);
        $responsibles = User::where('role', 'club_responsible')->orWhere('role', 'student')->get();
        $events = Event::all();
        return view('admin.clubs.index', compact('clubs', 'responsibles', 'events'));
    }

    public function create()
    {
        $responsibles = User::where('role', 'student')->get();
        return view('admin.clubs.create', compact('responsibles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'logo' => 'nullable|image',
            'description' => 'nullable|string',
            'objective' => 'nullable|string',
            'responsable_user_id' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('clubs', 'public');
        }

        $club = Club::create($data);

        // Update the user's role to club_responsible
        $responsibleUser = User::find($data['responsable_user_id']);
        if ($responsibleUser && $responsibleUser->role !== 'club_responsible') {
            $responsibleUser->role = 'club_responsible';
            $responsibleUser->save();
        }

        // Save the responsable as a member in club_members
        ClubMember::create([
            'club_id' => $club->id,
            'user_id' => $data['responsable_user_id'],
            'status' => 'accepted',
            'function' => 'responsable',
            'joined_at' => now(),
        ]);

        return redirect()->route('admin.clubs.index')->with('success', 'Club created!');
    }

    public function edit(Club $club)
    {
        $responsibles = User::where('role', 'club_responsible')->orWhere('role', 'student')->get();
        return view('admin.clubs.edit', compact('club', 'responsibles'));
    }

    public function update(Request $request, Club $club)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'string',
            'responsable_user_id' => 'exists:users,id',
            'status' => 'required|in:active,inactive',
            'logo' => 'nullable|image',
            'objective' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'description', 'responsable_user_id', 'status', 'objective']);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('clubs', 'public');
        }

        $club->update($data);

        // Update the user's role to club_responsible
        $responsibleUser = User::find($request->input('responsable_user_id'));
        if ($responsibleUser && $responsibleUser->role !== 'club_responsible') {
            $responsibleUser->role = 'club_responsible';
            $responsibleUser->save();
        }

        return redirect()->route('admin.clubs.index')->with('success', 'Club updated!');
    }

    public function destroy(Club $club)
    {
        $club->delete();
        return redirect()->route('admin.clubs.index')->with('success', 'Club deleted!');
    }

    public function show(Club $club)
    {
        $members = $club->members()->withPivot('function', 'joined_at')->paginate(5);
        $events = $club->events()->paginate(5);
        $posts = $club->posts()->with('user')->paginate(5);
        return view('admin.clubs.show', compact('club', 'members', 'events', 'posts'));
    }

    public function downloadPdf()
    {
        $clubs = Club::withCount(['events', 'members'])->with('responsable')->get();

        $pdf = Pdf::loadView('admin.clubs.pdf', compact('clubs'));
        return $pdf->download('clubs_report.pdf');
    }
}