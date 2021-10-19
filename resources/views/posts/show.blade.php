@extends('layouts.app')

@section('title', $post->title)

@section('content')
<h2>
    {{$post->title}}
</h2>
<p>
    {{$post->body}}
</p>

<h5>Comments</h5>
@forelse($post->comments as $comment)
<div>
    <div>{{ $comment->user->name }}</div>
    <blockquote>{{ $comment->body }}</blockquote>
    <small>{{ $comment->created_at }}</small>
</div>
@empty
<span>No comments</span>
@endforelse

<form class="mt-3" action="{{ route('createComment', ['post' => $post->id]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="body">Add comment:</label>
        <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
        @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection