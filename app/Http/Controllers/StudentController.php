<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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
}
