<?php
include "functions.php";
include "../config/connection.php";
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    global $conn;
    try {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $phone = $_POST["phone"];
        $driverL = $_POST["driverLicense"];
        $dateB = $_POST["dateBirth"];

        $dateTMS = strtotime($dateB);

        $errors = 0;
        $reName = '/^[A-Z][a-z]{2,15}(\s[A-Z][a-z]{2,15})*$/';
        $rePhone = '/^(\([0-9]{3}\)|[0-9]{3}-)[0-9]{3}-[0-9]{4}$/';
        $reDriverL = '/^[0-9]{8}$/';
        $rePassword = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';

        $emailErr = "";
        $phoneErr = "";
        $driverErr = "";
        $dateErr = "";

        if(!preg_match($reName,$firstName)){
            $errors++;
        }
        if(!preg_match($reName,$lastName)){
            $errors++;
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors++;
        }
        else {
            $result = checkUserInformation($email,"email");
            if($result->nmbr > 0){
                $emailErr = "The email is already in use ";
            }
        }
        if(!preg_match($rePassword,$password)){
            $errors++;
        }
        if(!preg_match($rePhone,$phone)){
            $errors++;
        }
        else {
            $resultPhone = checkUserInformation($phone,"phone");
            if($resultPhone->nmbr > 0){
                $phoneErr = "The phone is already in use";
            }
        }
        if(!preg_match($reDriverL,$driverL)){
            $errors++;
        }
        else {
            $resultDriver = checkUserInformation($driverL,"driver_license");
            if($resultDriver->nmbr > 0){
                $driverErr = "Driver license is already in use ";
            }
        }
        if(time() - $dateTMS < 18 * 31536000){
            $dateErr = "You must be over 18 years old";
        }
        if($emailErr){
            echo json_encode("emailErr");
            http_response_code(201);
            die;
        }
        if($phoneErr){
            echo json_encode("phoneErr");
            http_response_code(201);
            die;
        }
        if($driverErr){
            echo json_encode("driverErr");
            http_response_code(201);
            die;
        }
        if($dateErr){
            echo json_encode("dateErr");
            http_response_code(201);
            die;
        }
        else if(!$errors){
            //Upis u bazu
            $firstName_s = addslashes($firstName);
            $lastName_s = addslashes($lastName);
            $email_s = addslashes($email);
            //$phone_s = addslashes($phone);
            $driverL_s = addslashes($driverL);
            //$dateB_s = addslashes($dateB);
            $hashPassword = md5($password);
            $hashPassword .= 'psw';

            $result = registerUser($firstName_s,$lastName_s,$email_s,$hashPassword,$phone,$driverL_s,$dateB);

            if($result) {
                echo json_encode("success");
                http_response_code(200);
            }
        }
        else {
            echo json_encode("Error");
        }
    }
    catch (PDOException $ex){
        echo $ex->getMessage();
        http_response_code(500);
    }

}
else {

    //header("Location: ../404.php");
    http_response_code(404);
}

/*
 $errors = [];
    $reName = '/^[A-Z][a-z]{2,15}(\s[A-Z][a-z]{2,15})*$/';
    $rePhone = '/^(\([0-9]{3}\)|[0-9]{3}-)[0-9]{3}-[0-9]{4}$/';
    $reDriverL = '/^[0-9]{8}$/';
    $rePassword = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
    $reDate = '/^(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])\-(19|20)\d{2}$/';


    if(!$firstName){
        $errors["fName"] = "Name is required";
    }
    else if(!preg_match($reName,$firstName)){
        $errors["fName"] = "Incorrect name!";
    }
    if(!$lastName){
        $errors["lName"] = "Last name is required!";
    }
    else if(!preg_match($reName,$lastName)){
        $errors["lName"] = "Incorrect last name!";
    }
    if(!$email){
        $errors["email"] = "Email is required !";
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors["email"] = "Incorrect email";
    }
    if(!$password){
        $errors["pass"] = "Password is required";
    }
    else if(!preg_match($rePassword,$password)){
        $errors["pass"] = "Incorrect password!";
    }
    if(!$phone){
        $errors["phone"] = "Phone is required";
    }
    else if(!preg_match($rePhone,$phone)){
        $errors["phone"] = "Incorrect phone: xxx-xxx-xxxx.";
    }
    if(!$driverL){
        $errors["driverL"] = "Driver license is required";
    }
    else if(!preg_match($reDriverL,$driverL)){
        $errors["driverL"] = "Incorrect driver license";
    }
    if(!$dateB){
        $errors["dateB"] = "Date of birth is required";
    }
    else if(!preg_match($reDate,$dateB)){
        $errors["dateB"] = "Incorrect date of birth";
    }


*/



