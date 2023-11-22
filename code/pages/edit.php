<?php
session_start();
if (!isset($_SESSION['admin_user_id'])) {
    header("Location: ../index.php");
    exit();
}

include_once '../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM projects WHERE project_id = :project_id");
        $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $stmt->execute();

        $project = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$project) {
            echo "Project not found!";
            exit();
        }

        // Display the form for editing with existing project details
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Edit Project</title>
            <link rel="stylesheet" href="../assets/css/edit.css">
        </head>
        <body>
            <h1>Edit Project</h1>
            <form action="../back_end/update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="project_id" value="<?= $project['project_id'] ?>">
                <label for="project_name">Project Name:</label>
                <input type="text" id="project_name" name="project_name" value="<?= $project['project_name'] ?>">
                <label for="project_image">Project Image:</label>
                <input type="file" id="project_image" name="project_image"> 
                <label for="project_about">Project About:</label>
                <textarea id="project_about" name="project_about"><?= $project['project_about'] ?></textarea>
                <label for="project_link">Project Link:</label>
                <input type="text" id="project_link" name="project_link" value="<?= $project['project_link'] ?>">
                <label for="github_link">GitHub Link:</label>
                <input type="text" id="github_link" name="github_link" value="<?= $project['github_link'] ?>">
                <label for="project_about_long">Project About (Long):</label>
                <textarea id="project_about_long" name="project_about_long"><?= $project['project_about_long'] ?></textarea>
                <label for="type_project">Type of Project:</label>
                <input type="text" id="type_project" name="type_project" value="<?= $project['type_project'] ?>">
                <label for="year">Year:</label>
                <input type="text" id="year" name="year" value="<?= $project['year'] ?>">
                <input type="submit" value="Update">
            </form>
        </body>
        </html>
        <?php
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request!";
}
$conn = null;
?>
