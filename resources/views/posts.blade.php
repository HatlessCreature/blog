<html>

<head>
    <title>Blog</title>
</head>

<body>
    <h1>Posts</h1>
    <ul>
        @foreach($posts as $post)
        <li>
            <a href="/posts/{{$post->id}}">
                {{$post->title}}
            </a>
        </li>
        @endforeach
    </ul>
</body>

</html>