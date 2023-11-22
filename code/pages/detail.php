<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/detail.css">
  <title>Project Details</title>
</head>
<body>
  <div class="container">
    <?php
    include '../dbconn.php';

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['project']) && is_numeric($_GET['project'])) {
            $project_id = $_GET['project'];

            $stmt = $conn->prepare("SELECT project_id, project_name, type_project, project_about_long, project_link, github_link, image_uuid FROM projects WHERE project_id = :project_id");
            $stmt->bindParam(':project_id', $project_id, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt->fetchAll() as $project) {
                echo "<h1>{$project['project_name']}</h1>";
                echo "<div class='project-details'>";
                $imagePath = "../assets/images/{$project['image_uuid']}.jpg"; 
                echo "<img src='{$imagePath}' alt='{$project['project_name']}' class='project-image'>";
                echo "<p>Type: {$project['type_project']}</p>";
                echo "<p>Description: {$project['project_about_long']}</p>";
                echo "<p>Project Link: <a href='{$project['project_link']}' target='_blank'>{$project['project_link']}</a></p>";
                echo "<p>Github Link: <a href='{$project['github_link']}' target='_blank'>{$project['github_link']}</a></p>";
                echo "<a href='project.php' class='back-button'>Back</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Invalid project ID.</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
  </div>
</body>
</html>
