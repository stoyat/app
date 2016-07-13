<!DOCTYPE html>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('users') }}">View Users</a></li>
            <li><a href="{{ URL::to('users/create') }}">Create User</a></li>
            <li><a href="{{ URL::to('books') }}">View Books</a></li>
            <li><a href="{{ URL::to('books/create') }}">Add book</a></li>
            <li><a href="{{ URL::to('register') }}">Register</a></li>
            <li><a href="{{ URL::to('register/create') }}">Assign a book</a></li>
        </ul>
    </nav>

    <h1>@yield('pagetitle')</h1>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    @yield('content')

</div>
</body>
</html>