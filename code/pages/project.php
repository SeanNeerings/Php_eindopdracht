<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="searchbar">
            <form action="" method="get">
                <input class="search" type="text" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" />
                <input type="submit" value="Search" />
            </form>
        </div>
        <?php
        include '../dbconn.php';
        include '../back_end/search.php';

        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $results_per_page = 5; 

            $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM projects");
            $stmt->execute();
            $total_results = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            $total_pages = ceil($total_results / $results_per_page);

            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            $start_index = ($current_page - 1) * $results_per_page;

            if (isset($_GET['search'])) {
                $search = '%' . $_GET['search'] . '%';

                $stmt = $conn->prepare("SELECT project_id, project_name, project_about, type_project, year FROM projects WHERE year LIKE :search OR project_name LIKE :search OR type_project LIKE :search  LIMIT $start_index, $results_per_page");
                $stmt->bindParam(':search', $search, PDO::PARAM_STR);
            } else {
                $stmt = $conn->prepare("SELECT project_id, project_name, project_about, type_project, year FROM projects LIMIT $start_index, $results_per_page");
            }

            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach ($stmt->fetchAll() as $k => $v) {
                echo "<div class='project_box'>";
                echo "<a href='detail.php?project=" . $v['project_id'] . "'><h1 class='title'>$v[project_name] </h1> </a>";
                echo "<p class='type'> $v[type_project]</p>";
                echo "<p class='about'> $v[project_about] </p>";
                echo "<p class='year'> $v[year]</p>";
                echo "</div>";
                echo "<br>";
            }
            for ($page = 1; $page <= $total_pages; $page++) {
                echo "<a href='?page=$page" . (isset($_GET['search']) ? "&search={$_GET['search']}" : "") . "'>$page</a> ";

            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
        ?>
    </div>
</body>

</html>
