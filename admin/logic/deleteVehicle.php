<?php
include "../../config/connection.php";
include "../../logic/functions.php";

if(isset($_POST["id"])){
    global $conn;
    $id = $_POST["id"];
    $query = "DELETE FROM vehicle WHERE vehicle_id = :id";
    $delete = $conn->prepare($query);
    $delete->bindParam(":id",$id);
    $res = $delete->execute();

    if($res){
        http_response_code(200);
        echo json_encode("Successfilly");
    }
    else {
        http_response_code(422);
        echo json_encode("Error");
    }
}