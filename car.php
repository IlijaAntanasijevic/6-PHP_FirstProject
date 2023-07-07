    <?php 
        require_once("includes/header.php");
    $cars = rentACar();
    $allModels = selectAll('model');
    $user = @$_SESSION['user']->first_name;
    ?>
    <!-- Search End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Car Listing</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="index.php">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Car Listing</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- Rent A Car Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">03</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Find Your Car</h1>
            <form class="boxed">
               <div class="row mb-5">
                   <div class="col-3">
                       <div class="form-group">
                           <input type="radio" id="0" name="rbModels" class="rbModels" onclick="check()">
                           <label for="0" class="form-label"  >All</label>
                       </div>
                   </div>
                   <?php foreach ($allModels as $model): ?>
                       <div class="col-3">
                           <div class="form-group">
                               <input type="radio" id="<?= $model->model_id ?>" name="rbModels" onclick="check()"  class="rbModels">
                               <label for="<?= $model->model_id ?>" class="form-label"><?= $model->model_name ?></label>
                           </div>
                       </div>
                   <?php endforeach; ?>

               </div>
            </form>
            <div class="row" id="vehicles" id="vehicles">
                <?php
                foreach ($cars as $car): ?>
                    <div class="col-lg-4 col-md-6 mb-2" >
                        <div class="rent-item mb-4" >
                            <img class='img-fluid mb-4' src='img/<?=$car->img_src?>' alt='<?=$car->vehicle_name?>'/>
                            <h4 class="text-uppercase mb-4"><?=$car->vehicle_name?></h4>
                            <div class="d-flex justify-content-center mb-4">
                                <div class="px-2">
                                    <i class="fa fa-car text-primary mr-1"></i>
                                    <span><?=date('Y',strtotime($car->model_year) )?></span>
                                </div>
                                <div class="px-2 border-left border-right">
                                    <i class="fa fa-cogs text-primary mr-1"></i>
                                    <span><?=$car->gearshift?></span>
                                </div>
                                <div class="px-2">
                                    <i class="fa fa-road text-primary mr-1"></i>
                                    <span><?=$car->consuption?>L</span>
                                </div>
                            </div>
                            <?php if(isset($_SESSION["user"])): ?>
                                <a class="btn btn-primary px-3" href="booking.php?id=<?=$car->vehicle_id?>" target="_blank" data-carid="<?=$car->vehicle_id?>">$<?=$car->price?>/Day</a>
                            <?php else: ?>
                                <p class="btn btn-primary px-3 aboutLoginPrice" data-carid="<?=$car->vehicle_id?>">$<?=$car->price?>/Day</p>
                                <input type="hidden" name="getCars" id="getCars">
                                <div id="modalLogin"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>
    <!-- Rent A Car End -->




<script>
    function printVehicle(allVehicles){
        let user = '<?= $user; ?>';
        console.log(user)
        let string = "";
        if(!allVehicles.length){
            // language=HTML
            string += `<p class="alert alert-danger w-75 h3 text-center mx-auto py-3">We currently do not have this model available</p>`;
        }
        else {
            for (let v of allVehicles){
                string += `<div class="col-lg-4 col-md-6 mb-2" >
                            <div class="rent-item mb-4">
                                <img class='img-fluid mb-4' src='img/${v.img_src}' alt='${v.vehicle_name}'/>
                                <h4 class="text-uppercase mb-4">${v.vehicle_name}</h4>
                            <div class="d-flex justify-content-center mb-4">
                                <div class="px-2">
                                    <i class="fa fa-car text-primary mr-1"></i>`
                                  let date = v.model_year.split("-")[0];

                               string += `<span>${date}</span></div>
                                <div class="px-2 border-left border-right">
                                    <i class="fa fa-cogs text-primary mr-1"></i>
                                    <span>${v.gearshift}</span>
                                </div>
                                <div class="px-2">
                                    <i class="fa fa-road text-primary mr-1"></i>
                                    <span>${v.consuption}L</span>
                                </div>
                            </div>`;
                        if(user  != "" ){
                            string += `<a class="btn btn-primary px-3" href="booking.php?id=${v.vehicle_id}" target="_blank" data-carid="${v.vehicle_id}">$${v.price}/Day</a>`;
                        }
                        else {
                            string += `<p class="btn btn-primary px-3 aboutLoginPrice" data-carid="${v.vehicle_id}">$${v.price}/Day</p>
                            <input type="hidden" name="getCars" id="getCars">
                                <div id="modalLogin"></div>`
                        }
                string += ` </div> </div>`;
            }
        }
        document.getElementById('vehicles').innerHTML = string;
    }
</script>

    <!-- Vendor Start -->
    <?php 
        include("includes/seller.php")
    ?>
    <!-- Vendor End -->


    <!-- Footer Start -->
    <?php 
        require_once("includes/footer.php")
    ?>