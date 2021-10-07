<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::unpublished()->get();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if ($post->is_published) {
            throw new ModelNotFoundException;
        }
        return view('posts.show', compact('post'));
    }
}
