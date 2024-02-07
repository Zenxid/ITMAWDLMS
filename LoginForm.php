<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="LoginForm.css">
</head>
<body>
    <div id="page" class="site">
        <div class="form-wrapper">
            <div class="login">
                <h1>Sign in</h1>
                <form action="login.php" method="post">
                    <?php if(isset($_GET['error'])) { ?>
                        <p class ="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <div>
                        <input type="number" name="school_id" id="schlId" placeholder=" ">
                        <label for="schlId">School ID:</label>
                        <i class="ri-pass-valid-fill"></i>
                    </div>
                    <div>
                        <input type="text" name="name" id="username" placeholder=" ">
                        <label for="username">Username</label>
                        <i class="ri-user-line"></i>
                    </div>
                    <div>
                        <input type="password" name="password" id="password" placeholder=" ">
                        <label for="password">Password</label>
                        <i class="ri-lock-2-line"></i>
                    </div>
                    <div>
                        <button type="submit">Login</button>
                    </div>
                    <div class="split">
                        <a href="#">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>