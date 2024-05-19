<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Your existing styles */
    body {
        margin: 0;
        padding: 0;
    }

    .navbar {
        background-color: #15588F;
    }

    .navbar a {
        color: white;
        text-decoration: none;
    }

    .navbar a:hover {
        background-color: #ddd;
        color: black;
    }

    .sidebar {
        height: 100%;
        width: 200px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #15588F;
        color: white;
        padding-top: 20px;
    }

    .sidebar a {
        padding: 10px;
        text-decoration: none;
        display: block;
        color: white;
    }

    .sidebar a:hover {
        background-color: #888C93;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex mx-auto my-2 my-lg-0" id="headerSearchButton">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search by tag..."
                        aria-label="Search" style="height: 35px; width: 330px;">
                    <button class="btn btn-secondary" type="submit" style="height: 35px;">Search</button>
                </form>
            </div>
        </div>
    </nav>



    <div class="sidebar">
        <div class="container">
            <h4 class="text-center mt-3">Menu</h4>
            <hr class="bg-light">
            <ul class="list-unstyled">
                <li><a href="home" class="text-white">Home</a></li>
                <li><a href="myquestions" class="text-white">My Questions</a></li>
                <li><a href="profile" class="text-white">Profile</a></li>
            </ul>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>