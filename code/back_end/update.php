<?php
session_start();
if (!isset($_SESSION['admin_user_id'])) {
    header("Location: ../index.php");
    exit();
}

include_once '../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = $_POST['project_id'];
    $project_name = $_POST['project_name'];
    $project_image = $_POST['project_image'];
    $project_about = $_POST['project_about'];
    $project_link = $_POST['project_link'];
    $github_link = $_POST['github_link'];
    $project_about_long = $_POST['project_about_long'];
    $type_project = $_POST['type_project'];
    $year = $_POST['year'];

    
    $targetDirectory = "../assets/images/"; 
    $uploadedFile = $_FILES['project_image']['tmp_name'];
    $fileExtension = pathinfo($_FILES['project_image']['name'], PATHINFO_EXTENSION);
    
   
    $uuid = uniqid();
    $targetFile = $targetDirectory . $uuid . '.' . $fileExtension;

    if (move_uploaded_file($uploadedFile, $targetFile)) {
        $project_image = $targetFile;
    try {
        $stmt = $conn->prepare("UPDATE projects SET project_name = :project_name, project_image = :project_image, project_about = :project_about, project_link = :project_link, github_link = :github_link, project_about_long = :project_about_long, type_project = :type_project, image_uuid = :image_uuid, year = :year WHERE project_id = :project_id");

        $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':project_image', $project_image);
        $stmt->bindParam(':project_about', $project_about);
        $stmt->bindParam(':project_link', $project_link);
        $stmt->bindParam(':github_link', $github_link);
        $stmt->bindParam(':project_about_long', $project_about_long);
        $stmt->bindParam(':type_project', $type_project);
        $stmt->bindParam(':image_uuid', $uuid); 
        $stmt->bindParam(':year', $year);

        if ($stmt->execute()) {
            header("Location: ../pages/project.php");
            exit();
        } else {
            echo "Error updating project. Please try again.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request!";
}
}
$conn = null;
?>
