<?php
session_start();
if (!isset($_SESSION['admin_user_id'])) {
    header("Location: ../index.php");
    exit();
}

include_once '../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $project_id = $_GET['project_id'];

    try {
        $stmt_select = $conn->prepare("SELECT project_image FROM projects WHERE project_id = :project_id");
        $stmt_select->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $stmt_select->execute();
        $result = $stmt_select->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $project_image_path = $result['project_image'];


            if (file_exists($project_image_path)) {
                unlink($project_image_path); 
            }
        }

        $stmt_delete = $conn->prepare("DELETE FROM projects WHERE project_id = :project_id");
        $stmt_delete->bindParam(':project_id', $project_id, PDO::PARAM_INT);

        if ($stmt_delete->execute()) {
            header("Location: ../pages/project.php");
            exit();
        } else {
            echo "Error deleting project. Please try again.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request!";
}
$conn = null;
?>
