<?php
session_start();
if (!isset($_SESSION['admin_user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_name = $_POST['project_name'];
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

        $stmt = $conn->prepare("INSERT INTO projects (project_name, project_image, project_about, project_link, github_link, project_about_long, type_project, year, image_uuid) VALUES (:project_name, :project_image, :project_about, :project_link, :github_link, :project_about_long, :type_project, :year, :image_uuid)");

        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':project_image', $project_image);
        $stmt->bindParam(':project_about', $project_about);
        $stmt->bindParam(':project_link', $project_link);
        $stmt->bindParam(':github_link', $github_link);
        $stmt->bindParam(':project_about_long', $project_about_long);
        $stmt->bindParam(':type_project', $type_project);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':image_uuid', $uuid); 

        if ($stmt->execute()) {
            header("Location: ../pages/project.php");
            exit();
        } else {
            echo "Error: Failed to add project. Please try again.";
        }
    } else {
        echo "Error uploading file. Please try again.";
    }
}

$conn = null;
?>
