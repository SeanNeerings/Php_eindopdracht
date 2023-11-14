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
$pass = validate($_POST['password']);

if (!$conn) {
    echo "Connection failure";
    exit();
}
$query = "SELECT `admin_user_id`, `password` FROM admin_user WHERE email = '$email'";

$sql = $conn->query($query);
$rowcount = $sql->rowCount();

if ($rowcount !== 1) {
    header("Location: ../index.php?error=no user found");
    exit();
}

$uInfo = $sql->fetch(PDO::FETCH_ASSOC);
if (!password_verify($pass, $uInfo['password'])) {
    header("Location: ../index.php?error=password is not correct");
    exit();
}

session_start();
$_SESSION['loggedin'] = true;
$_SESSION['admin_user_id'] = $uInfo['admin_user_id'];

function RandomString()
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 32; $i++) {
        $randstring .= $characters[rand(0, (strlen($characters) - 1))];
    }
    return $randstring;
}

$conn = null;

header("Location: ../pages/project.php ");
exit();
?>