<!-- index.php -->
<link rel="stylesheet" href="../assets/css/login.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
    <div class="form-container">
        <form action="../back_end/create.php" method="post">
            <h3>Create your account</h3>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <label for="email">Email:</label>
            <input type="email" name="email" id="" placeholder="Email">
            <label for="password">Password:</label>
            <input type="password" name="password" id="" placeholder="Password">
            <input type="submit" name="submit" value="Create">
            <a href="../index.php">go back</a>
        </form>
    </div>
</body>
</html>
