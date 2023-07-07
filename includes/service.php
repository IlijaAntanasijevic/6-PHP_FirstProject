<?php
include "config/conf.php";
global $servicesName;
global $iconsArr;
$number = 1;
?>

<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">02</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Our Services</h1>
            <div class="row">
                <?php $i = 0;  foreach ($servicesName as $key => $val): ?>
                    <div class="col-lg-4 col-md-6 mb-2">
                        <div class="service-item <?php $class = ''; $i == 1 ? $class = 'active' : $class; echo $class?> d-flex flex-column justify-content-center px-4 mb-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center justify-content-center bg-primary ml-n4" style="width: 80px; height: 80px;">
                                    <i class="fa fa-2x <?= $iconsArr[$i]; ?> text-secondary"></i>
                                </div>
                                <h1 class="display-2 text-white mt-n2 m-0">0<?= $number; ?></h1>
                            </div>
                            <h4 class="text-uppercase mb-3"><?= $key ?></h4>
                            <p class="m-0"><?= $val ?></p>
                        </div>
                    </div>
                <?php $number++; $i++; endforeach; ?>
            </div>
        </div>
</div>