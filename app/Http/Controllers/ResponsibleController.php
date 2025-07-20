<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\ClubMember;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // Make sure you have this at the top

class ResponsibleController extends Controller
{
    public function index() {
        $user = Auth::user();
        $clubs = Club::where('responsable_user_id', $user->id)
            ->withCount('members')
            ->withCount('events')
            ->withCount('posts')

            ->get();
        return view('responsable.clubs.index', compact('clubs'));
    }

public function show($clubId)
{
    $club = Club::findOrFail($clubId);

    // On récupère les ClubMember avec user lié
    $members = ClubMember::with('user')
        ->where('club_id', $clubId)
        ->paginate(10);

    return view('responsable.clubs.show', compact('club', 'members'));
}


    public function editMember($clubId, $memberId) {
        $club = Club::findOrFail($clubId);
        $member = ClubMember::where('club_id', $clubId)->where('user_id', $memberId)->firstOrFail();
        return view('responsable.clubs.members.edit', compact('club', 'member'));
    }

    public function updateMember(Request $request, $clubId, $memberId) {
        $request->validate(['function' => 'required|string|max:255']);
        $member = ClubMember::where('club_id', $clubId)->where('user_id', $memberId)->firstOrFail();
        $member->function = $request->function;
        $member->save();
        return redirect()->route('responsible.clubs.show', $clubId)->with('success', 'Member function updated.');
    }

    public function validateMember($clubId, $memberId) {
        $member = ClubMember::where('club_id', $clubId)->where('user_id', $memberId)->firstOrFail();
        $member->status = 'accepted';
        $member->joined_at = now();
        $member->save();
        return back()->with('success', 'Member accepted.');
    }

    public function cancelMember($clubId, $memberId) {
        $member = ClubMember::where('club_id', $clubId)->where('user_id', $memberId)->firstOrFail();
        $member->status = 'rejected';
        $member->left_at = now();
        $member->save();
        return back()->with('success', 'Member rejected.');
    }

    public function switchStatus($clubId, $memberId) {
        $member = ClubMember::where('club_id', $clubId)->where('user_id', $memberId)->firstOrFail();
        $member->status = $member->status === 'accepted' ? 'rejected' : 'accepted';
        $member->save();
        return back()->with('success', 'Member status switched.');
    }
    public function destroyMember($clubId, $memberId)
{
    ClubMember::where('club_id', $clubId)->where('user_id', $memberId)->delete();
    return back()->with('success', 'Member deleted successfully.');
}

public function edit($id)
{
    $club = Club::findOrFail($id);
    // Optionally, check if Auth::user()->id === $club->responsable_user_id
    return view('responsable.clubs.edit', compact('club'));
}

public function update(Request $request, $id)
{
    $club = Club::findOrFail($id);

    $request->validate([
        'name' => 'string|max:255',
        'description' => 'string',
        'objective' => 'nullable|string',
        'facebook_link' => 'nullable|url',
        'instagram_link' => 'nullable|url',
        'logo' => 'nullable|image|max:2048',
    ]);

    $club->name = $request->name;
    $club->description = $request->description;
    $club->objective = $request->objective;
    $club->facebook_link = $request->facebook_link;
    $club->instagram_link = $request->instagram_link;

    if ($request->hasFile('logo')) {
        $club->logo = $request->file('logo')->store('clubs', 'public');
    }

    $club->save();

    return redirect()->route('responsible.clubs.index')->with('success', 'Club updated successfully!');
}

public function downloadMembersPdf($clubId)
{
    $club = Club::findOrFail($clubId);

    $members = $club->members()
        ->withPivot('function', 'status', 'joined_at', 'left_at', 'facebook_link', 'instagram_link')
        ->get();

    $pdf = Pdf::loadView('responsable.clubs.members.pdf', compact('club', 'members'));
    return $pdf->download('club_members_' . $club->id . '.pdf');
}

public function dashboard()
{
    $user = auth()->user();

    // Clubs the user joined
    $joinedClubIds =ClubMember::where('user_id', $user->id)
        ->where('status', 'accepted')
        ->pluck('club_id');
    $joinedClubs = Club::whereIn('id', $joinedClubIds)
        ->withCount('members')
        ->withCount('events')
        ->withCount('posts')
        ->paginate(9);

    // Clubs the user is responsible for
    $responsibleClubs = Club::where('responsable_user_id', $user->id)
        ->withCount('members')
        ->get();

    // Recent members only in clubs you manage
    $recentMembers = ClubMember::whereIn('club_id', $responsibleClubs->pluck('id'))
        ->with(['user', 'club'])
        ->orderBy('joined_at', 'desc')
        ->take(5)
        ->get();

    // Events the user participated in
    $participatedEventIds =EventParticipant::where('user_id', $user->id)
        ->pluck('event_id');
    $participatedEvents =Event::whereIn('id', $participatedEventIds)
        ->with('club')
        ->get();

    return view('responsable.dashboard', compact(
        'joinedClubs',
        'responsibleClubs',
        'recentMembers',
        'participatedEvents'
    ));
}


}
