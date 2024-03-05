<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('posts.create');
        } else {
            return redirect()->route('posts.index')->with('error', 'Unauthorized action');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $post = new Post;
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            return redirect()->route('posts.index');
        } else {
            return redirect()->route('posts.index')->with('error', 'Unauthorized action');
        }
    }

    public function edit(Post $post)
    {
        if (Gate::allows('isAdmin')) {
            return view('posts.edit', compact('post'));
        } else {
            return redirect()->route('posts.index')->with('error', 'Unauthorized action');
        }
    }

    public function update(Request $request, Post $post)
    {
        if (Gate::allows('isAdmin')) {
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            return redirect()->route('posts.index');
        } else {
            return redirect()->route('posts.index')->with('error', 'Unauthorized action');
        }
    }

    public function destroy(Post $post)
    {
        if (Gate::allows('isAdmin')) {
            $post->delete();

            return redirect()->route('posts.index');
        } else {
            return redirect()->route('posts.index')->with('error', 'Unauthorized action');
        }
    }
}
