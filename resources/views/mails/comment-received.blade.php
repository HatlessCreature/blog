<html>

<head>

</head>

<body>
    <div>
        <p>Hello, {{ $author->name }}</p>
        <p>The user {{ $user->name }} has left a comment on your post: <i>{{ $post->title }}</i></p>
        <blockquote>
            {{ $comment->body  }}
        </blockquote>
    </div>
</body>

</html>