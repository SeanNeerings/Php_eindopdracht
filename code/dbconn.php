<?php
$servername = "localhost";
$username = "root";
$password = "a";
$database = "php_eindopdracht";
class Connect
{
    public $conn;

    function __construct($servername, $username, $password, $database)
    {
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }
}
$obj = new Connect($servername, $username, $password, $database);
$conn = $obj->conn;
?>
