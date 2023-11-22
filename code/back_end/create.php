<?php
if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $minLength = strlen($password) > 6;
    $maxLength = strlen($password) < 21;
    $containsLetters = preg_match('/[A-Za-z]/', $password);
    $containsDigits = preg_match('/\d/', $password);
    $containsSpecialCharacters = preg_match('/\W|_/', $password);

    if (
        (!$minLength || !$maxLength) ||
        !($containsLetters && $containsDigits or $containsSpecialCharacters)
    ) {
        echo "<script>alert('Password too weak'); window.location.href='../index.php';</script>";
        exit();
    }

    require_once "../dbconn.php";

    try {
        $password = trim($password);
        $password = htmlspecialchars($password);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO admin_user (`email`, `password`) VALUES (?, ?)");
        
        $stmt->execute([$email, $hashed_password]);
        
        
        header('Location: ../index.php'); 
        exit();
    } catch (PDOException $e) {
       echo "<script>alert('Error: Could not insert user.'); window.location.href='../index.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Please fill in all fields'); window.location.href='../index.php';</script>";
    exit();
}
?>
