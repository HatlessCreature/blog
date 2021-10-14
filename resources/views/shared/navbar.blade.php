<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/posts">
            Vivify Blog
        </a>
        <a href="/posts/create" class="navbar-brand">
            Create Post
        </a>
        @auth
        <div>
            {{ auth()->user()->name }}
        </div>
        <div>
            <!-- ne mora biti forma, ne mora biti post metod, samo nam treba metoda za logout, moze biti samo link sa get npr -->
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </div>
        @else
        <div>
            <a href="/login" class="nav-link">Login</a>
        </div>
        <div>
            <a href="/register" class="nav-link">Register</a>
        </div>
        @endauth
    </div>
</nav>