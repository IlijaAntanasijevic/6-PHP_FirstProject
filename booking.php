     <!-- Header -->
     <?php
     if(isset($_GET["id"])){
         include "config/connection.php";
         global $conn;
        $id = $_GET["id"];
        if(!is_numeric($id)){
            header("Location: 404.php");
            die;
        }
        $query = "SELECT vehicle_id,vehicle_name,model_year,gearshift,description,consuption,m.*,i.img_src,p.price
                  FROM vehicle v INNER JOIN model m ON v.model_id = m.model_id INNER JOIN images i ON v.img_id = i.img_id 
                  INNER JOIN price p ON v.price_id = p.price_id 
                  WHERE vehicle_id = :id";
        $select = $conn->prepare($query);
        $select->bindParam("id",$id);
        $select->execute();
        $car = $select->fetch();
     }
     else {
         header("Location: 404.php");
     }
    require_once("includes/header.php");

    ?>



    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Car Booking</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="index.php">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Car Booking</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- Detail Start -->
    <div class="container-fluid pt-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-4 text-uppercase mb-5"><?=$car->vehicle_name?></h1>
            <div class="row align-items-center pb-2">
                <div class="col-lg-6 mb-4">
                    <img class="img-fluid" src="img/<?=$car->img_src?>" alt="<?=$car->vehicle_name?>"/>
                </div>
                <div class="col-lg-6 mb-4">
                    <h4 class="mb-2">$<?=$car->price?>/Day</h4>
                    <!--RATING
                    <div class="d-flex mb-3">
                        <h6 class="mr-2">Rating:</h6>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star-half-alt text-primary mr-1"></small>
                            <small>(250)</small>
                        </div>
                    </div>
                    -->
                    <p><?= $car->description ?></p>
                    <div class="d-flex pt-1">
                        <h6>Share on:</h6>
                        <div class="d-inline-flex">
                            <a class="px-2" href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="px-2" href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="px-2" href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a class="px-2" href="https://www.pinterest.com" target="_blank"><i class="fab fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-n3 mt-lg-0 pb-4">
                <div class="col-md-3 col-6 mb-2">
                    <i class="fa fa-car text-primary mr-2"></i>
                    <span>Model: <?= date('Y',strtotime($car->model_year) ) ?></span>
                </div>
                <div class="col-md-3 col-6 mb-2">
                    <i class="fa fa-cogs text-primary mr-2"></i>
                    <span> <?= $car->gearshift ?> </span>
                </div>
                <div class="col-md-3 col-6 mb-2">
                    <i class="fa fa-road text-primary mr-2"></i>
                    <span><?= $car->consuption ?>km/liter</span>
                </div>
                <div class="col-md-3 col-6 mb-2">
                    <i class="fa fa-car text-primary mr-2"></i>
                    <span><?= $car->model_name ?></span>
                </div>

            </div>
        </div>
    </div>
    <!-- Detail End -->

    <!-- Car Booking Start -->
    <div class="container-fluid pb-5 mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <h2 class="mb-4">Booking Detail</h2>
                    <div class="mb-5">
                        <div class="row">
                            <div class="col-6 form-group">

                                <div class="date" id="datePickup" data-target-input="nearest">
                                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Date"
                                           data-target="#datePickup" data-toggle="datetimepicker" id="pickUpDate"/>
                                    <p class="alert alert-danger ia-error"></p>

                                </div>
                            </div>
                            <div class="col-6 form-group">

                                <div class="time" id="timePickup" data-target-input="nearest">
                                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Time"
                                           data-target="#timePickup" data-toggle="datetimepicker" id="pickUpTime"/>
                                    <p class="alert alert-danger ia-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <div class="date" id="date2" data-target-input="nearest">
                                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Drop Date"
                                        data-target="#date2" data-toggle="datetimepicker" id="dropDate"/>
                                    <p class="alert alert-danger ia-error"></p>
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="time" id="timeDrop" data-target-input="nearest">
                                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Pickup Time"
                                           data-target="#timeDrop" data-toggle="datetimepicker" id="dropTime"/>
                                    <p class="alert alert-danger ia-error"></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control py-3 px-4" rows="3" placeholder="Special Request" id="specilaReq"></textarea>
                            <p class="alert alert-danger ia-error"></p>
                            <p class="alert alert-danger ia-error" id="resevrationError"></p>
                            <p class="alert alert-success ia-error" id="reservationSuccess"></p>

                        </div>
                    </div>
                    <input type="hidden" value="<?=$car->vehicle_id?>" id="vehicleID"/>
                    <button class="btn btn-block btn-primary py-3 w-50 mx-auto" name="reserveBtn" id="reserveBtn">Reserve Now</button>

                </div>

            </div>
        </div>
    </div>
    <!-- Car Booking End -->


    <!-- Vendor Start -->
    <?php 
        include("includes/seller.php");
    ?>
    <!-- Vendor End -->


     <!-- Footer - HTML END -->
     <?php
    require_once("includes/footer.php");
    ?>