<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Club;
use App\Models\ClubMember;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('clubMemberships')->paginate(10);
        $totalUsers = User::count();
        return view('admin.users.index', compact('users', 'totalUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::with('clubs')->findOrFail($id);
        $clubs = Club::where('responsable_user_id', $user->id)->get();
        $responsibles = User::where('role', 'club_responsible')->orWhere('role', 'student')->get();

        return view('admin.users.edit', compact('user', 'clubs','responsibles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->numero = $request->numero;
        $user->role = $request->role;

       $selectedClubIds = $request->input('clubs', []);

// Get all clubs where this user is currently responsible
$currentClubs = Club::where('responsable_user_id', $user->id)->get();

foreach ($currentClubs as $club) {
    if (!in_array($club->id, $selectedClubIds)) {
        // Remove user as responsable
        $club->responsable_user_id = null;
        $club->save();

        // Update club_members function to 'member'
        ClubMember::where('club_id', $club->id)
            ->where('user_id', $user->id)
            ->update(['function' => 'member']);
    }
}

// After updates, check if user is still responsible for any club
$stillResponsible = Club::where('responsable_user_id', $user->id)->exists();
if (!$stillResponsible) {
    $user->role = 'student';
    $user->save();
}


        return redirect()->route('admin.users.index')->with('success', 'Utilisateur modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->clubs()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé');
    }

    public function downloadPdf()
    {
        $users = \App\Models\User::all();
        $pdf = Pdf::loadView('admin.users.pdf', compact('users'));
        return $pdf->download('users_report.pdf');
    }
}
