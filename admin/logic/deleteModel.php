<?php
include "../../config/connection.php";
if(isset($_POST["id"])){
    global $conn;
    $modelID = $_POST["id"];

    if(!is_numeric($modelID)){
        //http_response_code(404);
        echo json_encode(404);
        exit;
    }
    $query = "SELECT model_id FROM vehicle WHERE model_id = :ID";
    $select = $conn->prepare($query);
    $select->bindParam(":ID",$modelID);
    $select->execute();
    $result = $select->rowCount();


    if($result){
        http_response_code(202);
        //echo json_encode('The model is in use.Cannot delete!');
        echo json_encode("in use");
    }
    else {
        $deleteQuery = "DELETE FROM model WHERE model_id = :ID";
        $delete = $conn->prepare($deleteQuery);
        $delete->bindParam(":ID",$modelID);
        $delResult = $delete->execute();

        if($delResult){
            http_response_code(200);
            echo json_encode("success");
        }
        else {
            http_response_code(304);
            echo json_encode("server error");
        }

    }

}
