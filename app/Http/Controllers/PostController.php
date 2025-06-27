<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Club;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['club', 'user'])->latest()->paginate(6);
        $clubs = Club::all();
        $events=Event::all();
        $responsibles = User::where('role', 'club_responsible')->orWhere('role', 'student')->get();
        return view('admin.posts.index', compact('posts', 'clubs','responsibles','events'));
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
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'club_id' => 'required|exists:clubs,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('posts', 'public');
            }
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'club_id' => $request->club_id,
            'user_id' => Auth::id(),
            'images' => $imagePaths,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['club', 'user']);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Keep only selected images
        $keepImages = $request->input('keep_images', []);
        $currentImages = $post->images ?? [];
        $imagesToDelete = array_diff($currentImages, $keepImages);
        foreach ($imagesToDelete as $img) {
            Storage::disk('public')->delete($img);
        }
        $finalImages = $keepImages;

        // Add new uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $finalImages[] = $image->store('posts', 'public');
            }
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'images' => $finalImages,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->images) {
            foreach ($post->images as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted!');
    }
}
