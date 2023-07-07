<?php
require_once("includes/header.php");
if(!isset($_SESSION["user"])){
    header("Location: 404.php");
    http_response_code(404);
    die;
}
else {
    global $conn;
    $ID = $_SESSION["user"]->customer_id;

    $vehicleQuery = "SELECT * FROM vehicle WHERE vehicle_id IN (SELECT vehicle_id FROM reservation WHERE customer_id = $ID) ";
    $selectVehicle= $conn->query($vehicleQuery);
    $selectVehicle->execute();
    $resultV = $selectVehicle->fetchAll();
}
if(isset($_POST["btnReview"])){
    $message = $_POST["reviewMessage"];
    $avatar = $_FILES["userAvatar"];
    $model = $_POST["ddlVehicleReview"];
    $errors = [];
    $success = "";

    if(!$message){
        $errors["msgErr"] = "Message is required";
    }

    $imgName = $avatar["name"];
    if(!$imgName){
        $errors["imgErr"] = "Your image is required";
    }
    else{
        $checkImgage = checkImage($avatar,"img/");
        if($checkImgage["err"]){
            $errors["imgErr"] = $checkImgage["err"];
        }
        else{
            $fileName = $checkImgage["fileName"];
        }
    }
    if(!is_numeric($model)){
        die;
    }
    else if($model == 0){
        $errors["vehicleErr"] = "Vehicle is required";
    }
    else {
        $model = (int)$model;
        $checkCarReview = "SELECT * FROM reviews WHERE customer_id = $ID AND vehicle_id = $model ";
        $selectCarReview = $conn->query($checkCarReview);
        $resultCarReview = $selectCarReview->execute();
        $resultCarReview = $selectCarReview->rowCount();
        if($resultCarReview > 0){
            $errors["alreadyRatedErr"] = "You have already left a comment for the car";
        }
    }
    if(!count($errors)){
        $checkInsert = "SELECT date FROM reviews WHERE customer_id = $ID AND vehicle_id = $model";
        $selectInsert = $conn->query($checkInsert);
        $selectInsert->execute();
        $resultCheck = $selectInsert->fetchAll();
        $errorDate = false;

        foreach ($resultCheck as $r){
            $date = strtotime($r->date);
            if((time() - $date) < 15 * 60 ){
                $errorDate = true;
                break;
            }
        }

        if(!$errorDate){
            global $fileName;
            $model = (int)$model;
            $queryInsert = "INSERT INTO reviews (customer_id,vehicle_id,comment,avatar_src) VALUES($ID,$model,:comm,:avatar)";
            $insertReview = $conn->prepare($queryInsert);
            $insertReview->bindParam(":comm",$message);
            $insertReview->bindParam("avatar",$fileName);
            $resultInsert = $insertReview->execute();

            if($resultInsert){
                $success = "Successfully";
            }
            else{
                $errors["serverErr"] = "Server error. Please try again later.";
            }
        }

    }


 }


?>

<?php
global $success;
if(isset($errors["serverErr"])){
    echo '<p class="alert alert-danger">'. $errors["serverErr"] .'</p>';
}
if(isset($errors["alreadyRatedErr"])){
    echo '<p class="alert alert-danger mt-4 text-center h2">'. $errors["alreadyRatedErr"] .'</p>';
}
if($success != ""){
    echo ' <p class="alert alert-success mt-4 text-center h1">'. $success .'</p>';
}

?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <form action="<?= $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="userName">User</label>
                <p class="border py-2 px-4"><?= $_SESSION["user"]->first_name;?> <?= $_SESSION["user"]->last_name ?></p>
            </div>
            <div class="form-group my-5">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3" name="reviewMessage"></textarea>
                <?php if(isset($errors["msgErr"])): ?>
                <p class="alert alert-danger"><?= $errors["msgErr"] ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="vehicleDDL">Choose vehicle</label>
                <select name="ddlVehicleReview" class="form-control" id="vehicleDDL">
                    <option value="0">Choose...</option>
                    <?php foreach ($resultV as $v): ?>
                        <option value="<?= $v->vehicle_id ?>"> <?= $v->vehicle_name ?> </option>
                    <?php endforeach; ?>
                </select>
                <?php if(isset($errors["vehicleErr"])): ?>
                    <p class="alert alert-danger"><?= $errors["vehicleErr"] ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group mt-3">
                <label for="userAvatar">Your image</label>
                <input type="file" class="form-control-file" id="userAvatar" name="userAvatar">
                <?php if(isset($errors["imgErr"])): ?>
                    <p class="alert alert-danger"><?= $errors["imgErr"] ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group mt-5">
                <button type="submit" class="btn btn-success w-100" name="btnReview">Send</button>

            </div>
        </form>
    </div>
</div>


<?php
require_once("includes/footer.php");
?>


