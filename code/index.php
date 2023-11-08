<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Document</title>
</head>
<body>

<?php

include 'dbconn.php';


try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT project_id, project_name, project_about FROM projects");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach ($stmt->fetchAll() as $k => $v) {
        echo $v['project_id'] . ": ";
        echo "<a href='detail.php?project=" . $v['project_id'] . "'><h1 class='title'>$v[project_name] </h1> </a>";
        echo $v['project_about'];
        echo "<br>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
</body>
</html>

