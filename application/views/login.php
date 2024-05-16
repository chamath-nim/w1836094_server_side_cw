<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body,
    html {
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #dde1f7;
    }

    .background {
        background: linear-gradient(to top, #4b6cb7, #182848);
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0;
        left: 0;
    }

    .login-container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 300px;
        /* Ensure a consistent width for the container */
    }

    .login-container h2 {
        margin-bottom: 20px;
        color: #fff;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #fff;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
    }

    button {
        margin-top: 20px;
        width: 100%;
        padding: 10px;
        background-color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #f0f0f0;
    }

    .register-link {
        margin-top: 10px;
        color: #fff;
    }

    .register-link a {
        color: #fff;
        text-decoration: none;
    }
    </style>
</head>

<body>
    <div class="background">
        <div class="login-container">
            <h2>Login</h2>
            <form>
                <div class="form-group"><label for="username">User name</label><input type="text" id="username"
                        required>
                </div>
                <div class="form-group"><label for="password">Password</label><input type="password" id="password"
                        required>
                </div>
                <button type="submit">Login</button>
                <div class="register-link">Don't have an account? <a href="register">Register</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
    <script>
    var UserModel = Backbone.Model.extend({
        url: 'login',
        defaults: {
            username: '',
            password: ''
        }
    });

    var LoginView = Backbone.View.extend({
        el: '.login-container',

        events: {
            'submit form': 'submitForm'
        },

        initialize: function() {
            this.model = new UserModel();
            this.render();
        },

        render: function() {
            // Render the view
        },

        submitForm: function(event) {
            event.preventDefault();
            var formData = {
                username: this.$('#username').val(),
                password: this.$('#password').val()
            };
            this.model.set(formData);
            this.model.save(null, {
                success: function(model, response) {
                    if (response.success) {
                        window.location.replace('/serverside/cw/index.php/home');
                    } else {
                        window.location.replace('/serverside/cw/index.php/login');
                        console.log('success fail')
                    }
                },
                error: function(model, xhr, options) {
                    window.location.replace('/serverside/cw/index.php/login');
                    console.log(' fail')
                }
            });
        }
    });

    var loginView = new LoginView();
    </script>
</body>

</html>