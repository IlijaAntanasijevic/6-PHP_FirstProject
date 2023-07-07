<?php
include_once "header.php";
include_once "sidebar.php";

if(isset($_POST["addModelBtn"])){
    global $conn;
    $modelName = $_POST["modelName"];
    $modelImage = $_FILES["addModelImage"];

    $reModelName = '/^([0-9]|[A-Z]|[a-z]{3,})((\s?|\-)([0-9]|[A-Z]|[a-z]))*$/';
    $errors = [];
    $success = "";


    if(!$modelName){
        $errors["modelNameErr"] = "Model name is required";
    }
    else if(!preg_match($reModelName,$modelName)){
        $errors["modelNameErr"] = "Incorrect model name";
    }
    else {
        $query = "SELECT model_name FROM model WHERE model_name = :model";
        $selectModel = $conn->prepare($query);
        $selectModel->bindParam(":model",$modelName);
        $selectModel->execute();
        $modelResult = $selectModel->rowCount();
        if($modelResult != 0){
            $errors["modelNameErr"] = "Model already exist";
        }
    }

    if(!$modelImage["name"]){
        $errors["imgErr"] = "Image is required";
    }
    else {
        $checkImage = checkImage($modelImage,"../img/");
        if($checkImage["err"]){
            $errors["imgErr"] = $checkImage;
        }
        else {
            $fileName = $checkImage["fileName"];
        }
    }

    if(!count($errors)){
        global $fileName;
        $queryInsert = "INSERT INTO model(model_name,img_src) VALUES (:name,:src)";
        $insert = $conn->prepare($queryInsert);
        $insert->bindParam(":name",$modelName);
        $insert->bindParam(":src",$fileName);
        $result = $insert->execute();

        if($result){
            $success = "Successfully added";
        }

    }



}
?>

<div class="content">
    <!-- Navbar Start -->
    <?php include "navbar.php";?>
    <div class="col-sm-12 col-12 p-3">
        <div class="bg-secondary rounded p-4 " id="contenAddModel">
            <div class="container">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="row text-center justify-content-center">
                        <div class="col-6">
                            <div class="d-flex flex-column">
                                <label for="" class="form-label">Model Name</label>
                                <input type="text" class="form-text  text-dark border-0 p-2" name="modelName"/>
                                <?php if(isset($errors["modelNameErr"])): ?>
                                    <p class="text-danger"><?= $errors["modelNameErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row text-center justify-content-center mt-5">
                            <div class="col-6">
                                <label for="" class="form-label">Choose Image</label>
                                <input type="file" name="addModelImage" class="form-control"/>
                                <?php if(isset($errors["imgErr"])): ?>
                                    <p class="text-danger"><?= $errors["imgErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <div class="col-6">
                                <div class="d-flex justify-content-around">
                                    <input type="submit" class="btn btn-success mt-5 w-100" value="Submit" name="addModelBtn">

                                </div>
                            </div>
                        </div>
                </form>
                <?php if(@$success): ?>
                    <div class="col-6 mt-5">
                        <p class="alert alert-success">Successfully added</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>





    <?php include "footer.php"; ?>
