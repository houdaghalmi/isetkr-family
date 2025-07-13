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
use App\Models\Club;
use Illuminate\Support\Facades\Str;
use App\Models\ClubMember;


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

    public function clubsIndex()
    {
        $user = auth()->user();
        $clubs = Club::all();

        // Get IDs of clubs where the user is an active member (left_at is null and status is not 'rejected')
        $joinedClubIds = $user->clubMemberships()
            ->whereNull('left_at')
            ->where('status', '!=', 'rejected')
            ->pluck('club_id')
            ->toArray();

        return view('student.clubs.index', compact('clubs', 'joinedClubIds'));
    }

    public function joinClub($clubId)
    {
        $user = Auth::user();
        $user->clubs->attach($clubId);
        return back()->with('success', 'You joined the club!');
    }

    public function leaveClub($clubId)
    {
        $user = auth()->user();

        // Update the left_at field in the pivot table for this user and club
        $user->joinedClubs()->updateExistingPivot($clubId, [
            'left_at' => now()
        ]);

        return back()->with('success', 'You have left the club.');
    }

    public function showJoinForm($clubId)
    {
        $club = Club::findOrFail($clubId);
        $user = Auth::user();
        return view('student.clubs.join', compact('club', 'user'));
    }

    public function joinClubSubmit(Request $request, $clubId)
    {
        $user = auth()->user();

        // Validate numero and other fields
        $request->validate([
            'numero' => 'required|string|max:30',
            // add other validations as needed
        ]);

        // Update user's numero if changed
        if ($user->numero !== $request->numero) {
            $user->numero = $request->numero;
            $user->save();
        }

        ClubMember::updateOrCreate(
            ['club_id' => $clubId, 'user_id' => $user->id],
            [
                'facebook_link' => $request->facebook_link,
                'instagram_link' => $request->instagram_link,
                'status' => 'pending',
                'joined_at' => now(),
                'left_at' => null, 
                'function'=>'member',
            ]
        );

        return redirect()->route('student.clubs.index')->with('success', 'Your join request has been sent!');
    }

public function showClub($clubId)
{
    $club = Club::findOrFail($clubId);

    // Get all ClubMember records for this club where function != 'member'
    $members = ClubMember::where('club_id', $clubId)
        ->where('function', '!=', 'member')
        ->with('user')
        ->get();

    $user = Auth::user();
    $joinedClubIds = $user->clubMemberships()
        ->whereNull('left_at')
        ->where('status', '!=', 'rejected')
        ->pluck('club_id')
        ->toArray();

    return view('student.clubs.show', compact('club', 'members', 'joinedClubIds'));
}

public function showMembers($clubId)
{
    $club = Club::findOrFail($clubId);

    // Récupère les membres (Users) liés au club avec les données du pivot
    $members = $club->members()
        ->withPivot('status', 'function', 'joined_at', 'left_at')
        ->get();

    $centerIndex = intval($members->count() / 2);

    return view('student.clubs.showMembers', [
        'club' => $club,
        'members' => $members,
        'centerIndex' => $centerIndex,
    ]);
}

// Show the create club form
public function createClub()
{
    return view('student.clubs.create');
}

// Store the new club
public function storeClub(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'description' => 'required|string',
        'objective' => 'string',
        'numero' => 'string|max:8',
    ]);

    // Update user's numero if changed
    $user = auth()->user();
    if ($user->numero !== $request->numero) {
        $user->numero = $request->numero;
        $user->save();
    }

    // Handle logo upload
    $logoPath = $request->file('logo')->store('clubs', 'public');

    // Create the club
    $club = Club::create([
        'name' => $request->name,
        'logo' => $logoPath,
        'description' => $request->description,
        'objective' => $request->objective,
        'responsable_user_id' => $user->id,
        'status' => 'inactive',
    ]);

    // Add creator as member with function 'responsable'
     ClubMember::create([
        'club_id' => $club->id,
        'user_id' => $user->id,
        'function' => 'responsable',
        'status' => 'pending',
        'joined_at' => now(),
        'left_at' => null,
    ]);

    return redirect()->route('student.clubs.index')->with('success', 'Club request submitted!');
}

public function dashboard()
{
    $user = auth()->user();

    // ✅ Récupère les clubs via joinedClubs() (modèle Club)
    $joinedClubs = $user->joinedClubs()
        ->withCount('members')
        ->withCount('events')
        ->get();

    // ✅ Récupère les événements avec participants
    $registeredEvents = $user->eventParticipations()
        ->with(['event.club'])
        ->get()
        ->pluck('event');

    // ✅ Ajouter les participants_count manuellement
    foreach ($registeredEvents as $event) {
        $event->participants_count = $event->participants()->count();
    }

    return view('student.dashboard', compact('joinedClubs', 'registeredEvents'));
}



}
