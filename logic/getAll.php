<?php
include "functions.php";
include "../config/connection.php";
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    global $conn;
    $table = $_GET["table"];
    $query = "SELECT * FROM $table";
    $select = $conn->query($query);
    $result = $select->fetchAll();
    echo json_encode($result);
}
