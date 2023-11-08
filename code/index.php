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
    <div class="searchbar">
      <form action="" method="post">
      <input class="search" type="text" name="search" />
      <input type="submit" value="Search" />
      </form>
      </div>
  <?php
include 'dbconn.php';
include 'search.php';

try {
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_REQUEST['search'])) {
        $search = '%' . $_REQUEST['search'] . '%';
        $stmt = $conn->prepare("SELECT project_id, project_name, project_about, type_project FROM projects WHERE project_name LIKE :search OR type_project LIKE :search");
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    } else {
        $stmt = $conn->prepare("SELECT project_id, project_name, project_about, type_project FROM projects ");
    }

    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach ($stmt->fetchAll() as $k => $v) {
        echo "<div class='project_box'>";
        echo "<a href='detail.php?project=" . $v['project_id'] . "'><h1 class='title'>$v[project_name] </h1> </a>";
        echo "<p class='type'> $v[type_project]</p>";
        echo "<p class='about'> $v[project_about] </p>";
        echo "</div>";
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

