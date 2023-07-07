<?php
include "functions.php";
include "../config/connection.php";
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    global $conn;
    $ID = $_GET["id"];
    $query = "SELECT * FROM vehicle v INNER JOIN price p ON v.price_id = p.price_id INNER JOIN model m ON v.model_id = m.model_id 
    INNER JOIN images i ON i.img_id = v.img_id";

    if($ID > 0){
        $query .= " WHERE m.model_id = :ID";
    }
    if(str_contains($query,"WHERE")){
        $select = $conn->prepare($query);
        $select->bindParam(":ID",$ID);
        $select->execute();
    }
    else {
        $select = $conn->query($query);
    }

    $select->execute();
    $result = $select->fetchAll();
    echo json_encode($result);
}
