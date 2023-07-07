
<?php
$cars = rentACar("ORDER BY v.date_add DESC LIMIT 6");
?>

<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">03</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Find Your Car</h1>
            <div class="row">
<?php
foreach ($cars as $car): ?>
    <div class="col-lg-4 col-md-6 mb-2">
        <div class="rent-item mb-4">
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
<div class="conatiner">
    <div class="row justify-content-center">
            <a href="car.php" class="btn btn-primary py-3 my-5 mx-auto" id="otherCars">View more</a>
    </div>
</div>