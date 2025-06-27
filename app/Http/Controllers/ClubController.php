<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use App\Models\ClubMember;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::paginate(10);
        return view('admin.clubs.index', compact('clubs'));
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
        $responsibles = User::where('role', 'responsible')->get();
        return view('admin.clubs.edit', compact('club', 'responsibles'));
    }

    public function update(Request $request, Club $club)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'responsible_id' => 'required|exists:users,id',
        ]);

        $club->update($request->all());
        return redirect()->route('admin.clubs.index')->with('success', 'Club updated!');
    }

    public function destroy(Club $club)
    {
        $club->delete();
        return redirect()->route('admin.clubs.index')->with('success', 'Club deleted!');
    }
}