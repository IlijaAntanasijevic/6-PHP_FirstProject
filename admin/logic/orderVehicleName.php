<?php
include "../../config/connection.php";
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    global $conn;
    $type = $_GET["type"];

    $query = "SELECT v.vehicle_id,vehicle_name,r.*,c.* 
              FROM vehicle v INNER JOIN reservation r ON v.vehicle_id = r.vehicle_id 
              INNER JOIN customer c ON c.customer_id = r.customer_id INNER JOIN images i ON v.img_id = i.img_id 
              ORDER BY r.vehicle_id = $type DESC";
    $select = $conn->query($query);
    $result = $select->fetchAll();
    echo json_encode($result);
}