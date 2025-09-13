<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\ClubMember;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
     public function create()
    {
        return view('responsable.clubs.create');
    }

    // Store new club
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:clubs,name',
            'description' => 'required|string',
            'objective' => 'nullable|string',
            'facebook_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:5120', // max 5MB
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('clubs/logos', 'public');
            $validated['logo'] = $path;
        }

        // Assign responsible user
        $validated['responsible_id'] = Auth::id();

        // Create the club
        Club::create($validated);

        return redirect()->route('clubs.index')->with('success', 'New club created successfully!');
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
         ->withCount('events')
        ->withCount('posts')
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
   $participatedEvents = Event::whereIn('id', $participatedEventIds)
    ->with('club')
    ->withCount('participants')
    ->get();

    $eventParticipationCount = EventParticipant::where('user_id', $user->id)->count();
   

    return view('responsable.dashboard', compact(
        'joinedClubs',
        'responsibleClubs',
        'recentMembers',
        'participatedEvents',
        'eventParticipationCount'
    ));
}


    // Events Management Methods

    // Show list of events
    public function eventsIndex()
    {
        $user = Auth::user();

        // Get events for clubs where the user is responsible, excluding canceled events
        $events = Event::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->where('status', '!=', 'canceled')
            ->with(['club', 'participants'])
            ->orderBy('datetime', 'desc')
            ->paginate(12);

        return view('responsable.events.index', compact('events'));
    }

    // Show create event form
    public function createEvent()
    {
        $user = Auth::user();
        $clubs = Club::where('responsable_user_id', $user->id)->get();

        return view('responsable.events.create', compact('clubs'));
    }

    // Store new event
    public function storeEvent(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'title' => 'required|string|max:255',
            'intervenant' => 'required|string|max:255',
            'description' => 'required|string',
            'datetime' => 'required|date',
            'location' => 'required|string|max:255',
            'poster' => 'nullable|image|max:2048',
        ]);

        // Verify that the club belongs to the user
        $club = Club::where('id', $validated['club_id'])
            ->where('responsable_user_id', $user->id)
            ->firstOrFail();

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('events', 'public');
        }

        Event::create($validated);

        return redirect()->route('responsible.events.index')->with('success', 'Event created successfully!');
    }

    // Show edit event form
    public function editEvent($id)
    {
        $user = Auth::user();

        $event = Event::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->findOrFail($id);

        $clubs = Club::where('responsable_user_id', $user->id)->get();

        return view('responsable.events.edit', compact('event', 'clubs'));
    }

    // Update event
    public function updateEvent(Request $request, $id)
    {
        $user = Auth::user();

        $event = Event::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->findOrFail($id);

        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'title' => 'required|string|max:255',
            'intervenant' => 'required|string|max:255',
            'description' => 'required|string',
            'datetime' => 'required|date',
            'location' => 'required|string|max:255',
            'poster' => 'nullable|image|max:2048',
            'status' => 'required|in:pending,completed,canceled',
            'certificated' => 'boolean',
        ]);

        // Verify that the club belongs to the user
        $club = Club::where('id', $validated['club_id'])
            ->where('responsable_user_id', $user->id)
            ->firstOrFail();

        if ($request->hasFile('poster')) {
            // Delete old poster if exists
            if ($event->poster) {
                Storage::disk('public')->delete($event->poster);
            }
            $validated['poster'] = $request->file('poster')->store('events', 'public');
        }

        $validated['certificated'] = $request->has('certificated');

        $event->update($validated);

        return redirect()->route('responsible.events.index')->with('success', 'Event updated successfully!');
    }

    // Cancel event
    public function cancelEvent($id)
    {
        $user = Auth::user();

        $event = Event::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->findOrFail($id);

        // Check if event is already completed
        if ($event->status === 'completed') {
            return back()->with('error', 'Cannot cancel an event that has already been completed.');
        }

        // Check if event date has passed
        if ($event->datetime < now()) {
            return back()->with('error', 'Cannot cancel an event whose date has already passed.');
        }

        $event->update(['status' => 'canceled']);

        return back()->with('success', 'Event canceled successfully!');
    }

        // Show event details
    public function showEvent($id)
    {
        $user = Auth::user();
        
        $event = Event::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->with(['club', 'participants.user'])
            ->findOrFail($id);
        
        return view('responsable.events.show', compact('event'));
    }

    // Show participants index for an event
    public function participantsIndex($eventId)
    {
        $user = Auth::user();
        
        $event = Event::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->findOrFail($eventId);
        
        $participants = $event->participants()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('responsable.events.participation.index', compact('event', 'participants'));
    }

    // Update participant information
    public function updateParticipant(Request $request, $eventId, $participantId)
    {
        $user = Auth::user();
        
        // Verify the event belongs to the user's club
        $event = Event::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->findOrFail($eventId);
        
        // Verify the participant belongs to this event
        $participant = EventParticipant::where('event_id', $eventId)
            ->where('id', $participantId)
            ->firstOrFail();
        
        $validated = $request->validate([
            'classe' => 'required|string|max:10',
            'participation_status' => 'required|in:registered,attended,absent',
        ]);
        
        $participant->update($validated);
        
        return back()->with('success', 'Participant information updated successfully!');
    }

    // Remove participant from event
    public function destroyParticipant($eventId, $participantId)
    {
        $user = Auth::user();
        
        // Verify the event belongs to the user's club
        $event = Event::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->findOrFail($eventId);
        
        // Verify the participant belongs to this event
        $participant = EventParticipant::where('event_id', $eventId)
            ->where('id', $participantId)
            ->firstOrFail();
        
        $participant->delete();
        
        return back()->with('success', 'Participant removed from event successfully!');
    }

    // Download participants list as PDF, filtered by status: attended, registered, absent
    public function downloadParticipantsPdf($eventId)
    {
        $user = Auth::user();

        $event = Event::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->with(['club', 'participants.user'])
            ->findOrFail($eventId);

        // Get participants and order by status: attended, registered, absent
        $participants = $event->participants()
            ->with('user')
            ->orderByRaw("FIELD(participation_status, 'attended', 'registered', 'absent')")
            ->get();

        $pdf = PDF::loadView('responsable.events.participation.pdf', compact('event', 'participants'));

        return $pdf->download('event_participants_' . $event->title . '_' . now()->format('Y-m-d') . '.pdf');
    }

    // Posts Management Methods

    // Show posts index
    public function postsIndex()
    {
        $user = Auth::user();
        
        // Get posts for clubs where the user is responsible
        $posts = Post::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->with(['club'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('responsable.posts.index', compact('posts'));
    }

    // Show create post form
    public function createPost()
    {
        $user = Auth::user();
        $clubs = Club::where('responsable_user_id', $user->id)->get();
        
        return view('responsable.posts.create', compact('clubs'));
    }

    // Store new post
    public function storePost(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
        ]);

        // Verify that the club belongs to the user
        $club = Club::where('id', $validated['club_id'])
            ->where('responsable_user_id', $user->id)
            ->firstOrFail();

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts', 'public');
                $imagePaths[] = $path;
            }
        }

        // Create post with images
        $post = Post::create([
            'club_id' => $validated['club_id'],
            'user_id' => $user->id,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'images' => $imagePaths,
        ]);
        
        return redirect()->route('responsible.posts.index')->with('success', 'Post created successfully!');
    }

    // Show edit post form
    public function editPost($id)
    {
        $user = Auth::user();
        
        $post = Post::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->findOrFail($id);
        
        $clubs = Club::where('responsable_user_id', $user->id)->get();
        
        return view('responsable.posts.edit', compact('post', 'clubs'));
    }

    // Update post
    public function updatePost(Request $request, $id)
    {
        $user = Auth::user();
        
        $post = Post::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->findOrFail($id);

        $validated = $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'current_images.*' => 'nullable|string',
            'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
        ]);

        // Verify that the club belongs to the user
        $club = Club::where('id', $validated['club_id'])
            ->where('responsable_user_id', $user->id)
            ->firstOrFail();

        // Handle current images
        $currentImages = $request->input('current_images', []);
        
        // Handle new image uploads
        $newImagePaths = [];
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $image) {
                $path = $image->store('posts', 'public');
                $newImagePaths[] = $path;
            }
        }

        // Combine current and new images
        $allImages = array_merge($currentImages, $newImagePaths);

        // Update post
        $post->update([
            'club_id' => $validated['club_id'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'images' => $allImages,
        ]);
        
        return redirect()->route('responsible.posts.index')->with('success', 'Post updated successfully!');
    }

    // Delete post
    public function destroyPost($id)
    {
        $user = Auth::user();
        
        $post = Post::whereHas('club', function($query) use ($user) {
                $query->where('responsable_user_id', $user->id);
            })
            ->findOrFail($id);

        // Delete associated images from storage
        if ($post->images) {
            foreach ($post->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $post->delete();
        
        return redirect()->route('responsible.posts.index')->with('success', 'Post deleted successfully!');
    }
}
