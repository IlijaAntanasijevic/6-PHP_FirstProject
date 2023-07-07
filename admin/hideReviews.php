<?php
include "../config/connection.php";
include "../logic/functions.php";
if(isset($_POST["id"])){
    global $conn;
    $ID = (int)$_POST["id"];
    $result = selectReviewsById($ID);
    $activeFromTable = $result->active;

        $queryUpdate = "UPDATE reviews set active = ";
        if($activeFromTable == 1){
            $queryUpdate .= 0;
        }
        else if($activeFromTable == 0){
            $queryUpdate .= 1;

            $checkReviews = "SELECT COUNT(*) as number FROM reviews WHERE active = 0";
            $select = $conn->query($checkReviews);
            $totalShowedReviews = $select->fetch();
            $totalShowedReviews = $totalShowedReviews->number;
            if($totalShowedReviews < 4){

                echo json_encode('Limit');
                die;
            }
        }
            $queryUpdate.= " WHERE reviews_id = :ID";
            $update = $conn->prepare($queryUpdate);
            $update->bindParam(":ID",$ID);
            $resultUpdate = $update->execute();

            $resultUpdateActive = selectReviewsById($ID);
            $updatedActive = $resultUpdateActive->active;

            echo json_encode($updatedActive);

}