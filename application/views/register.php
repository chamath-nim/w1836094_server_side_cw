<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
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
        <div id="signupContainer" class="login-container">
            <h2>Register</h2>
            <form id="signupForm">
                <div class="form-group">
                    <label for="firstname">Firstname:</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" required>
                    <div id="firstnameError" class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname:</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" required>
                    <div id="lastnameError" class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                    <div id="usernameError" class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                    <div id="emailError" class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                    <div id="passwordError" class="invalid-feedback"></div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Signup</button>
                </div>
                <div class="register-link">
                    Already have an account? <a href="login">Login</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Include jQuery and Backbone.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>

    <script>
    // Define Backbone model for user
    var UserModel = Backbone.Model.extend({
        url: 'register', // API endpoint for user registration
        defaults: {
            firstname: '',
            lastname: '',
            username: '',
            email: '',
            password: ''
        },
    });

    // Define Backbone view for signup form
    var SignupView = Backbone.View.extend({
        el: '#signupContainer', // Corrected selector for container

        initialize: function() {
            _.bindAll(this, 'render', 'handleSubmit');
            this.render();
        },
        render: function() {
            this.$el.find('.form-control').val('');
            return this;
        },
        events: {
            'submit #signupForm': 'handleSubmit' // Corrected event delegation
        },
        handleSubmit: function(event) {
            event.preventDefault();
            var formData = {
                firstname: this.$el.find('#firstname').val(),
                lastname: this.$el.find('#lastname').val(),
                username: this.$el.find('#username').val(),
                email: this.$el.find('#email').val(),
                password: this.$el.find('#password').val()
            };

            var model = new UserModel(formData);

            if (model.isValid()) {
                model.save(null, {
                    success: function(model, response) {
                        console.log('Form submitted successfully:', response);
                        window.location.replace('/serverside/cw/index.php/login');

                    },
                    error: function(model, response) {
                        console.error('Error submitting form:', response);
                        window.location.replace('/serverside/cw/index.php/register');
                    }
                });
            } else {
                // Display validation errors
                _.each(model.validationError, function(error, field) {
                    $('#' + field + 'Error').text(error).show();
                });
            }
        }
    });

    // Create an instance of the SignupView
    var signupView = new SignupView();
    </script>
</body>


</html>