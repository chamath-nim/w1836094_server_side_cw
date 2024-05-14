<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        margin: 0;
        padding: 0;
    }

    .sidebar {
        height: 100%;
        width: 200px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #333;
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
        background-color: #555;
    }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="container">
            <h4 class="text-center mt-3">Menu</h4>
            <hr class="bg-light">
            <ul class="list-unstyled">
                <li><a href="#" class="text-white">Home</a></li>
                <li><a href="#" class="text-white">Questions</a></li>
                <li><a href="#" class="text-white">Profile</a></li>
            </ul>
        </div>
    </div>

    <!-- Add Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>