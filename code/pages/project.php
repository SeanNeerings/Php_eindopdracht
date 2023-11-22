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
        <div class="filter">
            <form action="" method="get">
                <label for="year_filter">Filter by Year:</label>
                <select name="year_filter" id="year_filter">
                    <option value="">All</option>
                    <?php
        include '../dbconn.php';

        $stmt = $conn->prepare("SELECT DISTINCT year FROM projects");
        $stmt->execute();
        $years = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($years as $year) {
            $selected = (isset($_GET['year_filter']) && $_GET['year_filter'] === $year) ? 'selected' : '';
            echo "<option value='$year' $selected>$year</option>";
        }
        ?>
        </select>
        <input type="submit" value="Apply Filter">
        </form>
        </div>

        <div class="button">
            <a href="../back_end/logout.php">Logout</a>
        </div>
        <div class="add">
            <a href="add.php">Add</a>
        </div>
        
    <?php
    include_once '../dbconn.php';
    include '../back_end/search.php';

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $results_per_page = 5;

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start_index = ($current_page - 1) * $results_per_page;

        $query = "SELECT project_id, project_name, project_about, type_project, year FROM projects";

        $conditions = [];

        if (isset($_GET['year_filter']) && !empty($_GET['year_filter'])) {
            $year_filter = $_GET['year_filter'];
            $conditions[] = "year = :year_filter";
        }

        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = '%' . $_GET['search'] . '%';
            $conditions[] = "(year LIKE :search OR project_name LIKE :search OR type_project LIKE :search)";
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " LIMIT $start_index, $results_per_page";

        $stmt = $conn->prepare($query);

        if (isset($year_filter)) {
            $stmt->bindParam(':year_filter', $year_filter, PDO::PARAM_STR);
        }
        if (isset($search)) {
            $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        }

        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        foreach ($stmt->fetchAll() as $k => $v) {
            echo "<div class='project_box'>";
            echo "<a href='detail.php?project=" . $v['project_id'] . "'><h1 class='title'>$v[project_name] </h1> </a>";
            echo "<p class='type'> $v[type_project]</p>";
            echo "<p class='about'> $v[project_about] </p>";
            echo "<p class='year'> $v[year]</p>";
            echo "<a href='edit.php?project_id=" . $v['project_id'] . "'>Edit</a>";
            echo "<br>";
            echo "<a href='delete.php?project_id=" . $v['project_id'] . "'>delete</a>";
            echo "</div>";
            echo "<br>";
        }

        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM projects");
        $stmt->execute();
        $total_results = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        $total_pages = ceil($total_results / $results_per_page);

        for ($page = 1; $page <= $total_pages; $page++) {
            $query_string = http_build_query(array_merge($_GET, ['page' => $page]));
            echo "<a href='?" . htmlspecialchars($query_string) . "'>$page</a> ";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
    ?>
    </div>
</body>

</html>