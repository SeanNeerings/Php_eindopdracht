<?php

$queryCondition = " WHERE ";
$conditions = array();
if (!empty($_REQUEST["search"])) {

            $v = htmlspecialchars($_REQUEST["search"], ENT_QUOTES, 'UTF-8');
       
}
if (!empty($conditions)) {
    $queryCondition .= implode(" AND ", $conditions);
}
$sql = "SELECT * FROM projects" . $queryCondition;
?>