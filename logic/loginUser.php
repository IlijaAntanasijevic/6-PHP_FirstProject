<?php
session_start();
include "functions.php";
include "../config/connection.php";
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        global $conn;
        $email = $_POST["email"];
        $password = $_POST["password"];

        $emailError = "";
        $passwordError = "";

        $rePassword = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
        $errors = 0;

        $hashPass = md5($password);
        $hashPass .= "psw";

        if(!preg_match($rePassword,$password)){
            $errors++;
        }
        else {
            $query = "SELECT password FROM customer WHERE password = '$hashPass'";
            $passRes = $conn->query($query)->fetch();
            if(!$passRes){
                $passwordError = "Incorrect password";
            }
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors++;
        }
        else {
            $emailQuery = "SELECT email FROM customer WHERE email = '$email'";
            $emailRes = $conn->query($emailQuery)->fetch();
            if(!$emailRes){
                $emailError = "Email doesn't exist";
            }
        }
        if($emailError){
            echo json_encode("emailErr");
            http_response_code(201);
            die;
        }
        if($passwordError){
            echo json_encode("passErr");
            http_response_code(201);
            die;
        }

        if(!$errors){
            $user = loginUser($email,$hashPass);
            if($user){
                $_SESSION['user'] = $user;
                echo json_encode(1);
                http_response_code(200);
            }
            else{
                echo json_encode(0);
            }

        }
        else {
            http_response_code(500);
        }
    }
    catch (PDOException $ex){
        echo $ex->getMessage();
        http_response_code(500);
    }
}
else {
    http_response_code(404);
}