<?php
session_start();
if (!isset($_SESSION['admin_user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/add.css">
    <title>Add Project</title>
</head>

<body>
    <div class="container">
        <h2>Add Project</h2>
        <form action="../back_end/create_add.php" method="post" enctype="multipart/form-data">
            <label for="project_name">Project Name:</label><br>
            <input type="text" id="project_name" name="project_name" required><br><br>

            <label for="project_image">Project Image:</label><br>
            <input type="file" id="project_image" name="project_image" required><br><br>

            <label for="project_about">Project Description:</label><br>
            <textarea id="project_about" name="project_about" required></textarea><br><br>

            <label for="project_link">Project Link:</label><br>
            <input type="text" id="project_link" name="project_link" required><br><br>

            <label for="github_link">GitHub Link:</label><br>
            <input type="text" id="github_link" name="github_link" required><br><br>

            <label for="project_about_long">Project Description (Long):</label><br>
            <textarea id="project_about_long" name="project_about_long" required></textarea><br><br>

            <label for="type_project">Type of Project:</label><br>
            <input type="text" id="type_project" name="type_project" required><br><br>

            <label for="year">Year:</label><br>
            <input type="text" id="year" name="year" required><br><br>

            <input type="submit" value="Add Project">
        </form>
    </div>
</body>

</html>

<?php
$conn = null;
?>
