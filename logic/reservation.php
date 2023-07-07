<?php
session_start();
include "functions.php";
include "../config/connection.php";
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $startDate = $_POST["startDate"];
    $startTime = $_POST["startTime"];
    $endDate = $_POST["endDate"];
    $endTime = $_POST["endTime"];
    $message = $_POST["message"];
    $vehicleID = $_POST["vehicleID"];
    $userID = $_SESSION["user"]->customer_id;

    $attack = 0;
    $errors = 0;
    $tmpErr = 0;
    $reMessage = '/^([A-Z]\'?|[a-z]\'?|[0-9]){1,30}(\s([A-Z]\'?|[a-z]\'?|[0-9]){1,})*$/';

    $tmpStartTime = explode(" ",$startTime)[0];
    $tmpEndTime = explode(" ",$endTime)[0];


    $startTime = dateCheck($startTime,$tmpStartTime);
    $endTime = dateCheck($endTime,$tmpEndTime);


    if(!preg_match($reMessage,$message) && $message != ""){
        $errors++;
    }
    if($endDate < $startDate){
        $errors++;
    }
    if(!is_numeric($vehicleID)){
        $attack++;
    }

    if($attack != 0){
        echo json_encode(404);
        die;
    }


    else if(!$errors){
        $res = checkReservation($vehicleID,$startDate,$endDate);
        if (!$res){
            $startDate = $startDate ." ". $startTime;
            $endDate = $endDate ." ". $endTime;

            $insertRes = insertReservation($userID,$startDate,$endDate,$vehicleID);
            echo json_encode(1);
        }
        else {
            echo json_encode(0);
        }

    }
    else {
        echo json_encode("Server error.Please try again!");
    }

}
else {
    echo json_encode(404);
}
