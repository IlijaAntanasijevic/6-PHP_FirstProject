<?php
    include "../config/connection.php";
    include "functions.php";
if(isset($_POST['submitMess'])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $errors = [];
    $succMsg = "";
    $errMsg = "";

    $reName = '/^[A-Z][a-z]{2,15}(\s[A-Z][a-z]{2,15})*$/';
    $reSubject = '/^([A-Z]|[a-z]){1,30}(\s([A-Z]|[a-z]|[0-9]){1,30})*$/';
    $reMessage = '/^(([a-z]|[A-Z]|[0-9])*(\s|\.|\,|\'))?([a-z]|[A-Z]|[0-9]|(\s|\.|\,|\'))*$/';

    if(!$name) {
        $errors['nameErr'] = "Name is required";
    }
    else if (!preg_match($reName,$name)){
        $errors['nameErr'] = "Incorect name!";
    }
    if(!$email){
        $errors['emailErr'] = "Email is required";
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['emailErr'] = "Incorect email!";
    }

    if(!$subject){
        $errors['subjectErr'] = "Subject is required";
    }
    else if (!preg_match($reSubject,$subject)){
        $errors['subjectErr'] = "Incorect subject";
    }

    if (!$message){
        $errors['msgErr'] = "Message is required";
    }
    else if (!preg_match($reMessage,$message)){
        $errors['msgErr'] = "Incorect message";
    }

    if(!count($errors)){
        global $conn;
        $query = "INSERT INTO messages(name,email,subject,text) VALUES (:name,:email,:subject,:text)";
        $insert = $conn->prepare($query);
        $insert->bindParam(":name",$name);
        $insert->bindParam(":email",$email);
        $insert->bindParam(":subject",$subject);
        $insert->bindParam(":text",$message);
        $result = $insert->execute();
        if($result){
            $succMsg = "Message sent successfully";
            modal($succMsg,"success");

        }
        else{
            $errMsg = "Message sent successfully";
            modal($errMsg,"danger");
        }

    }
}

?>
