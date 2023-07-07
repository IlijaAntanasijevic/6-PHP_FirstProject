<?php
include "../../config/connection.php";
header("Content-type: application/json");
if($_SERVER["REQUEST_METHOD"] == "GET"){
    global $conn;
    $type = $_GET["type"];

    if($type == 0){
        $query = "SELECT * FROM messages";
        $select = $conn->query($query);
        $result = $select->fetchAll();
        echo json_encode($result);
    }
    else {
        $query = "SELECT * FROM messages ORDER BY date $type";
        $select = $conn->query($query);
        $result = $select->fetchAll();
        echo json_encode($result);
    }
}
else {
    header("Location: ../../404.php");
    http_response_code(404);
}
