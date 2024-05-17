<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Login Form</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="LoginForm.css?v=<?php echo time() ?>">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="header">
                <img class="animation a1" src="Pictures/STI.png" alt="">
                <h1 class="animation a1">Welcome to STI Library!</h1>
                <h4 class="animation a2">Please log in to access the website.</h4>
            </div>
            <form action="login.php" method="post">
                <div class="form">
                    <input type="number" class="form-field animation a3" name="school_id" placeholder="School ID">
                    <?php if (isset($_GET['error']) && $_GET['error'] == 'School ID is required'): ?>
                        <p class="animation a3 error">School ID is required</p>
                    <?php endif; ?>
                    <input type="text" class="form-field animation a3" name="name" placeholder="Username">
                    <?php if (isset($_GET['error']) && $_GET['error'] == 'User Name is required'): ?>
                        <p class="animation a3 error">Username is required</p>
                    <?php endif; ?>
                    <input type="password" class="form-field animation a4" name="password" placeholder="Password">
                    <?php if (isset($_GET['error']) && $_GET['error'] == 'Password is required'): ?>
                        <p class="animation a4 error">Password is required</p>
                    <?php endif; ?>
                    <?php if (isset($_GET['error']) && $_GET['error'] == 'Incorrect ID, Username, or Password'): ?>
                        <p class="animation a4 error">Incorrect ID, Username, or Password</p>
                    <?php endif; ?>
                    <p class="animation a5"><a href="#">Forgot Password</a></p>
                    <button class="animation a6" type="submit">LOGIN</button>
                </div>
            </form>
        </div>
        <div class="right-section"></div>
    </div>
</body>
</html>