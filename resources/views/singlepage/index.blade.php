<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script src="js/underscore.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/backbone.js"></script>
    <script src="js/backbone.marionette.js"></script>
    <script src="app.js"></script>

    <style>
        body {
            font-family: 'Lato';
        }
        .load {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 999;
            background: rgba(179, 179, 179, 0.5) url("loading.gif") no-repeat center;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top" style="position: fixed; width: 100%">
        <div class="container">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav" id="menu-container">
                    <li><a href="#users">View Users</a></li>
                    <!-- <li><a href="#users/create">Add user</a></li> -->
                    <li><a href="#books">View Books</a></li>
                    <li><a href="#books/create">Add book</a></li>
                    <li><a href="#bookregister">Register</a></li>
                    <li><a href="#bookregister/create">Assign a book</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="load" style="display: none" id="loading"></div>
    <div class="container" id="content" style="padding-top: 70px"></div>

    <script type="text/template" id="welcome">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>
                    <div class="panel-body">
                        The Library welcomes you.
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script type="text/template" id="users-template">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Surname</td>
            <td>Email</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </script>
    <script type="text/template" id="user-template">
        <td><%- id %></td>
        <td><%- firstname %></td>
        <td><%- lastname %></td>
        <td><%- email %></td>
        <td>
            <a class="btn btn-small btn-success" href="#users/<%- id %>">Details</a>
        </td>
    </script>
    <script type="text/template" id="user_detail-template">
        <div class="row" id="user"></div>
        <div class="row">
            <div class="col-md-12" id="books"></div>
        </div>
    </script>
    <script type="text/template" id="user_detail_book-template">
        <td><%- id %></td>
        <td><%- title %></td>
        <td><%- author %></td>
        <td><%- year %></td>
        <td><%- genre %></td>
        <td><a class="btn btn-small btn-success" href="#userbook/<%- pivot.id %>/delete">Return book</a></td>
    </script>
    <script type="text/template" id="user_detail_info-template">
        <h1>User details</h1>
        <h2><%- firstname %> <%- lastname %></h2>
        <h4>Email: <%- email %></h4>
        <h6>id: <%- id %></h6>
    </script>

    <script type="text/template" id="books-template">
        <thead>
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Author</td>
            <td>Year</td>
            <td>Genre</td>
            <td style="min-width: 210px">Action</td>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </script>
    <script type="text/template" id="book-template">
        <td><%- id %></td>
        <td><%- title %></td>
        <td><%- author %></td>
        <td><%- year %></td>
        <td><%- genre %></td>
        <td>
            <a class="btn btn-small btn-success" href="#books/<%- id %>">Details</a>
            <a class="btn btn-small btn-success" href="#books/<%- id %>/edit">Edit</a>
            <a class="btn btn-small btn-success" href="#books/<%- id %>/delete">Delete</a>
        </td>
    </script>
    <script type="text/template" id="book_detail-template">
        <div class="row">
            <div class="col-md-12">
                <h1>Book details</h1>
                <h2><%- title %></h2>
                <h4>Author: <%- author %></h4>
                <h5><%- year %> Year, <%- genre %> genre</h5>
                <h6>library record id: <%- id %></h6>
            </div>
        </div>
        <div class="row" id="user">
            <div class="col-md-12">

            </div>
        </div>
    </script>
    <script type="text/template" id="book_edit-template">
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" name="title" type="text" value="<%- title %>" id="title">
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input class="form-control" name="author" type="text" value="<%- author %>" id="author">
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input class="form-control" name="year" type="number" value="<%- year %>" id="year">
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input class="form-control" name="genre" type="text" value="<%- genre %>" id="genre">
        </div>

        <input class="btn btn-success" type="submit" value="Save">
    </script>

    <script type="text/template" id="register_list-template">
        <thead>
            <tr>
                <td>Id</td>
                <td>User</td>
                <td style="max-width: 40%">Book</td>
                <td width="170">Took date</td>
                <td width="130">Action</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </script>
    <script type="text/template" id="register_record-template">
            <td><%- id %></td>
            <td><%- user.firstname %> <%- user.lastname %></td>
            <td><%- book.title %></td>
            <td><%- created_at %></td>
            <td><a class="btn btn-small btn-success" href="#bookregister/<%- id %>/delete">Return book</a></td>
    </script>
    <script type="text/template" id="register_attach-template">
    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="users">User:</label>
                <div id="users"></div>
            </div>
            <div class="form-group">
                <label for="books">Book:</label>
                <div id="books"></div>
            </div>
            <input type="submit" class="btn btn-primary" value="Attach!">
        </div>
    </div>
    </script>
    <script type="text/template" id="register_books-template">
        <% _.each(items, function(item){ %>
        <option value="<%- item.id %>"><%- item.title %></option>
        <% }) %>
    </script>
    <script type="text/template" id="register_users_item-template">
        <% _.each(items, function(item){ %>
        <option value="<%- item.id %>"><%- item.firstname %> <%- item.lastname %></option>
        <% }) %>
    </script>


</body>
</html>