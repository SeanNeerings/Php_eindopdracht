<?php
include "../dbconn.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit();
}

if (!isset($_POST['email']) || empty($_POST['email'])) {
    header("Location: ../index.php?error=email is required");
    exit();
}

if (!isset($_POST['password']) || empty($_POST['password'])) {
    header("Location: ../index.php?error=password is required");
    exit();
}

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$email = validate($_POST['email']);
$password = $_POST['password'];

$query = "SELECT `admin_user_id`, `password` FROM admin_user WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$email]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$userData) {
    header("Location: ../index.php?error=no user found");
    exit();
}

$storedPassword = $userData['password'];

// Check the password and update if necessary
if (password_verify($password, $storedPassword)) {
    // Passwords match, no need to update
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['admin_user_id'] = $userData['admin_user_id'];

    header("Location: ../pages/project.php");
    exit();
} else {
    // Passwords do not match, update the stored password hash
    $newHash = password_hash($password, PASSWORD_DEFAULT);
    
    // Update the password hash in the database for the specific user
    $updateQuery = "UPDATE admin_user SET password = ? WHERE email = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->execute([$newHash, $email]);

    // Start session and redirect after updating password
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['admin_user_id'] = $userData['admin_user_id'];

    header("Location: ../pages/project.php");
    exit();
}
?>
