<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post', compact('post'));
    }
}
