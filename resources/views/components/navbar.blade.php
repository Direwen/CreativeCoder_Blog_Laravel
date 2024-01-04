<!-- navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Creative Coder</a>
        <div class="d-flex">
            <a href="/#blogs" class="nav-link text-white">Blogs</a>
            <!-- auth and guest directives -->
            <!-- auth will check whether there's a user logged in rn or not -->
            @auth
            <!-- can function will find the method in app service provider -->
            @can('admin')
            <a href="/admin/blogs" class="nav-link text-warning">Dashboard</a>
            @endcan
            <a href="" class="nav-link text-white">Welcome {{auth()->user()->name}}</a>
            <form action="/logout" method="post">
                @csrf
                <button type="submit" href="" class="nav-link btn btn-link text-danger">Logout</button>
            </form>    
            @else
            <a href="/register" class="nav-link text-white">Register</a>
            <a href="/login" class="nav-link text-white">Login</a>
            @endauth
            <!-- auth()->check() will return true if there's a user logged in rn -->
            <a href="#subscribe" class="nav-link text-white">Subscribe</a>
        </div>
    </div>
</nav>