<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Document</title>
</head>
<body>
<div class="container">
<?php
include '../dbconn.php';

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT project_id, project_name, type_project, project_about_long, project_link, github_link FROM projects WHERE project_id = ". $_GET['project']);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($stmt->fetchAll() as $k => $v) {
        echo $v['project_id'] . ": ";
        echo $v['project_name'];
        echo $v['type_project'];
        echo " - " . $v['project_about_long'];
        echo $v['project_link'] . " ";
        echo $v['github_link'] . " ";

        echo "<br>";

    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;



?>
</div>
</body>
</html>