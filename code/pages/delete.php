<?php
session_start();
if (!isset($_SESSION['admin_user_id'])) {
    header("Location: ../index.php");
    exit();
}

include_once '../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $project_id = $_GET['project_id'];

    if (isset($project_id) && !empty($project_id)) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Delete Project</title>
                <link rel="stylesheet" href="../assets/css/delete.css">
            <script>
                function confirmDelete() {
                    var result = confirm("Are you sure you want to delete this project?");
                    if (result) {
                        window.location.href = "../back_end/delete_project.php?project_id=<?php echo $project_id; ?>";
                    }
                }
            </script>
        </head>
        <body>
            <h2>Delete Project</h2>
            <button onclick="confirmDelete()">Delete Project</button>
        </body>
        </html>
        <?php
    } else {
        echo "Invalid project ID!";
    }
} else {
    echo "Invalid request!";
}
$conn = null;
?>
