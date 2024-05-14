<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <!-- Link to CSS stylesheets or any other assets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    /* Add custom styles here */
    body {
        padding-top: 50px;
    }

    .navbar {
        background-color: #007bff;
        /* Navbar background color */
    }

    .navbar-brand {
        color: #ffffff !important;
        /* Navbar brand text color */
    }

    .navbar-brand:hover {
        color: #ffffff !important;
        /* Navbar brand text color on hover */
    }

    .navbar-text {
        color: #ffffff;
        /* Navbar text color */
    }

    .form-control {
        border-radius: 20px;
        /* Rounded corners for search bar */
    }
    </style>
</head>

<body>

    <nav class=" navbar navbar-expand-md navbar-dark fixed-top">
        <a class="navbar-brand" href="#">Your Application</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Search form -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0 mx-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

        <!-- Theme toggle icon -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-sun"></i> <!-- Theme toggle icon -->
                </a>
            </li>
        </ul>

        <!-- User icon -->
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- <div class="container">
        <div class="jumbotron mt-5">
            <h1 class="display-4">Welcome to Your Application</h1>
            <p class="lead">This is a simple home page.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div> -->

    <!-- Link to jQuery and Bootstrap JS scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>