<?php include 'header.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile Page</title>
    <style>
    .logout-button {
        background-color: #008CBA;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .logout-button:hover {
        background-color: #005f80;
    }

    .main-content {
        margin-left: 220px;
        padding: 20px;
    }
    </style>
</head>

<body>
    <div class="main-content">
        <button class="logout-button" id="logoutButton">Logout</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
    <script>
    // Define a Backbone view for the logout button
    var LogoutButtonView = Backbone.View.extend({
        el: '#logoutButton',
        events: {
            'click': 'logout'
        },
        logout: function() {
            // Send an AJAX request to invalidate the session
            Backbone.$.ajax({
                url: 'logout', // Replace with the path to your logout endpoint
                method: 'POST',
                success: function(response) {
                    // Redirect to the login page or perform any other actions after logout
                    window.location.replace("logout");
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });

    // Instantiate the LogoutButtonView
    var logoutButtonView = new LogoutButtonView();
    </script>
</body>

</html>