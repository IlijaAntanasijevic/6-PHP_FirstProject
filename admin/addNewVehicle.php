<?php
include_once "header.php";
include_once "sidebar.php";
$allModelTypes = selectAll('model');
if(isset($_POST["addBtn"])){
    $vehicleName = $_POST["AddVehicleName"];
    $consumption = $_POST["addConsumption"];
    $licensePlate = $_POST["AddLPlate"];
    $price = $_POST["addPrice"];
    $description = $_POST["AddDescription"];
    $modelType = $_POST["ddlModelType"];
    $gearShift = $_POST["AddGearShift"];
    $year = $_POST["AddModelYear"];
    $imageAdd = $_FILES["AddVehicleImage"];

    $errors = [];
    $success = "";

    $reNameV = '/^([0-9]|[A-Z]|[a-z]{3,})((\s?|\-)([0-9]|[A-Z]|[a-z]))*$/';
    $rePlate = '/^[0-9]{1,10}$/';
    $reDescription = '/^([A-Z]\'?|[a-z]\'?|[0-9]){1,30}(\s([A-Z]\'?|[a-z]\'?|[0-9]){1,})*$/';
    $reCons = '/^[0-9]{1,3}$/';

    if(!$vehicleName){
         $errors["vNameErr"] = "Vehicle name is required";
    }
    else if(!preg_match($reNameV,$vehicleName)) {
          $errors["vNameErr"] = "Incorrect vehicle name";
    }
    if(!$consumption){
        $errors["consErr"] = "Consumption is required";
    }
    else if(!preg_match($reCons,$consumption)){
        $errors["consErr"] = "Incorrect consumption type";
    }
    if(!$licensePlate){
        $errors["lPlateErr"] = "License plate is required";
    }
    else if(!preg_match($rePlate,$licensePlate)){
        $errors["lPlateErr"] = "Incorrect license plate";
    }
    else {
        global $conn;
        $queryLicensePlate = "SELECT vehicle_id FROM vehicle WHERE licencse_plate = :lPlate";
        $selectLP = $conn->prepare($queryLicensePlate);
        $selectLP->bindParam("lPlate",$licensePlate);
        $selectLP->execute();
        $resultLP = $selectLP->rowCount();
        if($resultLP){
            $errors["lPlateErr"] = "License plate already exist";
        }
    }
    if(!$price){
        $errors["priceErr"] = "Price is required";
    }
    else if(!is_numeric($price)){
        $errors["priceErr"] = "Incorrect price type";
    }
    if(!$description){
        $errors["descErr"] = "Description is required";
    }
    else if(!preg_match($reDescription,$description)){
        $errors["descErr"] = "Incorrect description";
    }
    if($modelType == 0){
        $errors["modelErr"] = "Model is required";
    }
    elseif (!is_numeric($modelType)){
         $errors["modelErr"] = "Incorrect model type";
    }
    if($gearShift == 0){
        $errors["gearSErr"] = "Gearshift is required";
    }
    else if ($gearShift != "Automatic" && $gearShift != "Manual"){
        $errors["gearSErr"] = "Incorrect gearshift. Only 'Automatic' OR 'Manual'";
    }
    if($year == 0){
        $errors["yearErr"] = "Year is required";
    }
    else if (!is_numeric($year)){
          $errors["yearErr"] = "Incorrect year";
    }

    $imgName = $imageAdd["name"];
    if(!$imgName){
        $errors["imgErr"] = "Image is required";
    }
    else{
        $checkImage = checkImage($imageAdd,"../img/");
        if($checkImage["err"]){
            $errors["imgErr"] = $checkImage;
        }
        else {
            $fileName = $checkImage["fileName"];
        }
    }

      if(!count($errors)){
        global $fileName;
        global $conn;
         $imgId = insertImage($fileName,$vehicleName);
        $existPrice = checkPriceIfExists($price);

        if(!$existPrice) {
            $priceId = insertPrice($price);
        }
        else {
            $priceId = floatval($existPrice->price_id);
        }

        $licensePlate = (int)$licensePlate;
        $yearToAdd = date("Y-m-d",strtotime($year ."-". 01 ."-". 01));

        $query = "SELECT model_id FROM model WHERE model_id = :idModel";
        $select = $conn->prepare($query);
        $select->bindParam(":idModel",$modelType);
        $select->execute();
        $modelResult = $select->fetch();
        $modelId = $modelResult->model_id;

        $insertQuery = "INSERT INTO vehicle(vehicle_name,model_year,gearshift,description,consuption,licencse_plate,img_id,model_id,price_id)
                        VALUES(:carName,:year,:gearshift,:description,:cons,:lPlate,:imgID,:modelID,:priceID)";
        $insert = $conn->prepare($insertQuery);
          $insert->bindParam(":carName",$vehicleName);
          $insert->bindParam(":year",$yearToAdd);
          $insert->bindParam(":gearshift",$gearShift);
          $insert->bindParam(":description",$description);
          $insert->bindParam(":cons",$consumption);
          $insert->bindParam(":lPlate",$licensePlate);
          $insert->bindParam(":imgID",$imgId);
          $insert->bindParam(":modelID",$modelId);
          $insert->bindParam(":priceID",$priceId);

          $insertResult = $insert->execute();

          if($insertResult){
              header("Location: vehicles.php?insertSucc=1");
          }
          else {
              $errors["insertErr"] = "Server error.";
          }

     }



}

?>

    <div class="content">
    <!-- Navbar Start -->
    <?php include "navbar.php";?>
    <div class="col-sm-12 col-12 p-3">
        <div class="bg-secondary rounded h-100 p-4 ">
            <div class="container">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Vehicle Name</label>
                                <input type="text" class="form-text  text-dark border-0 p-2" name="AddVehicleName"/>
                                <?php if(isset($errors["vNameErr"])): ?>
                                    <p class="text-danger"><?= $errors["vNameErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Consumption</label>
                                <input type="text" class="form-text  text-dark border-0 p-2" name="addConsumption"/>
                                <?php if(isset($errors["consErr"])): ?>
                                    <p class="text-danger"><?= $errors["consErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">License Plate</label>
                                <input type="number" class="form-text  text-dark border-0 p-2" name="AddLPlate"/>
                                <?php if(isset($errors["lPlateErr"])): ?>
                                    <p class="text-danger"><?= $errors["lPlateErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Price($)</label>
                                <input type="number" class="form-text  text-dark border-0 p-2" name="addPrice"/>
                                <?php if(isset($errors["priceErr"])): ?>
                                    <p class="text-danger"><?= $errors["priceErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center my-5">
                        <div class="col-12">
                            <label for="" class="form-label">Description</label>
                            <textarea type="text" rows="3" class="form-text w-100 text-dark border-0 p-2" name="AddDescription"></textarea>
                            <?php if(isset($errors["descErr"])): ?>
                                <p class="text-danger"><?= $errors["descErr"] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-3">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Model</label>
                                <select name="ddlModelType"class="form-control">
                                    <option value="0">Choose...</option>
                                    <?php foreach($allModelTypes as $model): ?>
                                    <option class="text-dark" value="<?= $model->model_id ?>"><?= $model->model_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if(isset($errors["modelErr"])): ?>
                                    <p class="text-danger"><?= $errors["modelErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Gearshift</label>
                                <select name="AddGearShift" class="form-control">
                                    <option value="0">Choose...</option>
                                    <option value="Automatic">Automatic</option>
                                    <option value="Manual">Manual</option>
                                </select>
                                <?php if(isset($errors["gearSErr"])): ?>
                                    <p class="text-danger"><?= $errors["gearSErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Year</label>
                                <select name="AddModelYear" class="form-control">
                                    <option value="0">Choose...</option>
                                     <?php
                                         $date = date("Y");
                                         $date = (int)$date;
                                         for($i = $date;$i >= 2000;$i--):
                                     ?>
                                     <option value="<?= $i ?>"><?= $i ?></option>
                                      <?php endfor; ?>
                                </select>
                                <?php if(isset($errors["yearErr"])): ?>
                                    <p class="text-danger"><?= $errors["yearErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label">Choose Image</label>
                            <input type="file" name="AddVehicleImage" class="form-control"/>
                            <?php if(isset($errors["imgErr"])): ?>
                                <p class="text-danger"><?= $errors["imgErr"] ?></p>
                            <?php endif; ?>
                        </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-6">
                            <div class="d-flex justify-content-around">
                                <input type="submit" class="btn btn-success mt-5 w-100" value="Submit" name="addBtn">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





<?php include "footer.php"; ?>