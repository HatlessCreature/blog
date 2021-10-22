<html>

<body>
    <div>
        <p>Hello {{$user->name}}</p>
        <p>To verify click</p>
        <a href="{{ route('emailVerification', ['token' => $user->verification_token]) }}">Verify email adress</a>
    </div>
</body>

</html>