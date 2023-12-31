<link rel="stylesheet" href="./assets/css/login.css">
<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel='stylesheet' href='style.css'>
</head>

<body>
    <div class="form-container">
        <!-- <form action="./login/login.php" method="post"> -->
        <form action="./back_end/login.php" method="post">
            <h3>Sign in to your account</h3>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <label for="email">Email:</label>
            <input type="email" name="email" id="" placeholder="Email">
            <label for="password">Password:</label>
            <input type="password" name="password" id="" placeholder="Password">
            <input type="submit" name="submit" value="Login">
            <a href="forgot_password.php">Forgot Password?</a>
            <a href="./pages/create_acc.php">create account</a>
        </form>
    </div>
</body>

</html>