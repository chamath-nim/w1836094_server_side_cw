<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Login</h2>
                <?php if(isset($error)) echo '<div class="alert alert-danger">'.$error.'</div>'; ?>
                <?php echo validation_errors(); ?>
                <?php echo form_open('login'); ?>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</body>
</html>
