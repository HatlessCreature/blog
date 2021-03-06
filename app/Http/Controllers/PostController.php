<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Tag;


// use App\Comment;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        // DB::listen(function ($query) {
        //         info($query->sql);
        //     });
        $posts = Post::published()->paginate(15);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if (!$post->is_published) {
            throw new ModelNotFoundException;
        }
        // info($post);
        // $post = Post::with('comments')->findOrFail($post);

        // $comments = Comment::where('post_id', $post->id)->get();
        $post->load(['comments.user' => function ($qb) {
            return $qb->select(['users.id', 'users.name']);
        }]);
        //stedimo memoriju kad u query stavimo samo ono sta hocemo
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    public function store(CreatePostRequest $request)
    {
        //stari nacin, ne koristi se vise
        // $post = new Post;
        // $post->title = $request->get('title');
        // $post->body = $request->get('body');
        // $post->is_published = $request->get('is_published', false);

        // $post->save();


        //noviji nacin
        $data = $request->validated();
        // $newPost = Post::create($data);

        // $newPost = Auth::user()->posts()->create($data);
        // laravelov bolji i skraceni zapis, radi ali se crveni ^

        $newPost = Post::create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'is_published' => $request->get('is_published', false),
            'user_id' => Auth::user()->id
        ]);
        //ovo ^ je isto kao ^^
        $newPost->tags()->attach($data['tags']); //moze sync umesto attach

        return redirect(route('post', ['post' => $newPost]));
    }

    public function getAuthorsPosts(User $author)
    {
        // $posts = $author->posts->where('is_published', true);
        // ovaj nacin bi dao sve iz baze, pa nam onda u ram-u odvojio published ^

        $posts = $author->posts()->where('is_published', true)->paginate(15);
        return view('posts.index', compact('posts'));
    }
}
