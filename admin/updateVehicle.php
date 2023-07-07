<?php
include_once "header.php";
include "sidebar.php";
global $conn;

if(isset($_GET["id"])){
    global $conn;
    $id = $_GET["id"];

    if(!is_numeric($id)){
        header("Location: ../404.php");
        exit;
    }
    $errors = [];
    $succcess = "";



    if(isset($_POST["submitValue"])){
        $carName = $_POST["vehicleName"];
        $description = $_POST["description"];
        $licensePlate = $_POST["lPlate"];
        $price = $_POST["price"];
        $image = $_FILES["vehicleImage"];
        $rePlate = '/^[0-9]{1,10}$/';

        if($image["name"] != ""){
            $fileType = $image["type"];
            $fileSize = $image["size"];
            $extension = explode(".", $image["name"])[1];
            $fileName = uniqid() . "." . $extension;
            $folder = "../img/" . $fileName;
            $tmpPath = $image["tmp_name"];



            if($fileType != "image/jpeg" && $fileType != "image/png"){
                $errors["imgErr"] = "Invalid file type. Only .jpg/.jpeg/.png";
            }
            if($fileSize > 1024*1024*2){
                $errors["imgErr"] = "Image must be at most 2mb!";
            }
            if(!move_uploaded_file($tmpPath,$folder)){
                $errors["imgErr"] = "Upload error";
            }
            else {
                /*
                $queryImage = "INSERT INTO images(img_src,alt) VALUES('$fileName','$carName')";
                $insertImage = $conn->query($queryImage);

                $queryImgId = "SELECT img_id FROM images ORDER BY img_id DESC";
                $selectImgID = $conn->query($queryImgId);
                $selectImgID->execute();
                $imgId = $selectImgID->fetch();
                $imgId = $imgId->img_id;
                */
                $imgId = insertImage($fileName,$carName);
            }
        }
        else {
            $query = "SELECT img_id FROM images WHERE img_id = (SELECT img_id FROM vehicle WHERE vehicle_id = $id)";
            $selectIMG = $conn->query($query);
            $selectIMG->execute();
            $imgId = $selectIMG->fetch();
            $imgId = $imgId->img_id;
        }


        if(!$carName){
            $errors["vehicleErr"] = "Vehicle name is required";
        }
        if(!$description){
            $errors["descErr"] = "Description is required";
        }
        if(!preg_match($rePlate,$licensePlate)){
            $errors["lPlateErr"] = "Invalid license plate";
        }
        if(!is_numeric($price)){
            $errors["priceErr"] = "Invalid price type.";
        }


        if(!count($errors)){
            $priceResult = checkPriceIfExists($price);
            if(!$priceResult){
                $priceID = insertPrice($price);
            }
            else {
                $priceID = floatval($priceResult->price_id);
            }


            $licensePlate = (int)$licensePlate;
            global $imgId;
            $queryUpdateVehicle = "UPDATE vehicle 
                                   SET vehicle_name = :carName, description = :desc, licencse_plate = :lPlate, img_id  = $imgId, price_id  = $priceID 
                                   WHERE vehicle_id = $id";

            $updateVehicle = $conn->prepare($queryUpdateVehicle);
            $updateVehicle->bindParam(":carName",$carName);
            $updateVehicle->bindParam(":desc",$description);
            $updateVehicle->bindParam(":lPlate",$licensePlate);
            $updateResult = $updateVehicle->execute();
            if($updateResult){
                $succcess = "Successfully";
            }
            else {
                $errors["updateErr"] = "Update error.Please try again";
            }


        }
    }

}
else {
    header("Location: ../404.php");
    exit;
}

$query = "SELECT * FROM vehicle v INNER JOIN images i ON i.img_id = v.img_id INNER JOIN price p ON p.price_id = v.price_id WHERE v.vehicle_id = :id";
$select = $conn->prepare($query);
$select->bindParam(":id",$id);
$car = $select->execute();
$car = $select->fetch();
if(!$car){
    header("Location: ../admin.php");
    exit;
}


?>


<div class="content">
    <!-- Navbar Start -->
    <?php include "navbar.php"; ?>
    <?php if($succcess != ""): ?>
        <div id="modal" class="modal" tabindex="-1">
            <div class="modal-dialog ">
                <div class="modal-content">
                        <button type="button" class="btn-close btnCloseDelete float-end " id="updateModal" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body mt-5">
                        <p class="alert alert-success h3">Successfully</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnCloseDelete" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(isset($errors["updateErr"])): ?>
    <p class="alert alert-danger"><?= $errors["updateErr"] ?></p>
    <?php endif; ?>
    <div class="col-sm-12 col-12 p-3">
        <div class="bg-secondary rounded h-100 p-4 ">
           <div class="container">
               <form action="<?= $_SERVER['PHP_SELF'] . "?id=" . $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
                   <div class="row text-center">
                   <div class="col-3">
                       <div class="d-flex flex-column">
                           <label for="" class="form-label">Vehicle Name</label>
                           <input type="text" value="<?=$car->vehicle_name?>" class="form-text  text-dark border-0 p-2" name="vehicleName"/>
                           <?php if(isset($errors["vehicleErr"])): ?>
                            <p class="text-danger"><?= $errors["vehicleErr"] ?></p>
                           <?php endif; ?>
                       </div>
                   </div>
                   <div class="col-7">
                       <div class="d-flex flex-column">
                           <label for="" class="form-label">Description</label>
                           <textarea type="text" rows="3" class="form-text  text-dark border-0 p-2" name="description"><?=$car->description?></textarea>
                           <?php if(isset($errors["descErr"])): ?>
                               <p class="text-danger"><?= $errors["descErr"] ?></p>
                           <?php endif; ?>
                       </div>
                   </div>
                   <div class="col-2">
                       <div class="d-flex flex-column">
                           <label for="" class="form-label">License Plate</label>
                           <input type="number" value="<?=$car->licencse_plate?>" class="form-text  text-dark border-0 p-2" name="lPlate"/>
                           <?php if(isset($errors["lPlateErr"])): ?>
                               <p class="text-danger"><?= $errors["lPlateErr"] ?></p>
                           <?php endif; ?>
                       </div>
                   </div>
               </div>
                   <div class="row align-items-center mt-5 flex-column">
                       <img src="../img/<?= $car->img_src ?>" alt="<?= $car->vehicle_name?>" class="w-50 mb-4">
                       <input type="file" class="w-25 mb-5" name="vehicleImage"/>
                       <?php if(isset($errors["imgErr"])): ?>
                           <p class="text-danger"><?= $errors["imgErr"] ?></p>
                       <?php endif; ?>
                   </div>
                   <div class="row justify-content-center">
                       <div class="col-5">
                           <div class="d-flex flex-column">
                               <label for="" class="form-label fs-3 mt-5 text-center">Price($)</label>
                               <input type="text" value="<?=$car->price?>" class="form-text fs-2 text-dark border-0 p-2" name="price">
                               <?php if(isset($errors["priceErr"])): ?>
                                   <p class="text-danger"><?= $errors["priceErr"] ?></p>
                               <?php endif; ?>
                           </div>
                       </div>
                   </div>
                   <div class="row justify-content-center">
                       <div class="col-6">
                           <div class="d-flex justify-content-around">
                               <a href="vehicles.php" class="btn btn-danger mt-5">Cancel</a>
                               <input type="submit" class="btn btn-success mt-5 px-5" value="Submit" name="submitValue">
                           </div>
                       </div>
                   </div>
               </form>
           </div>
        </div>
    </div>





    <?php include "footer.php";?>

