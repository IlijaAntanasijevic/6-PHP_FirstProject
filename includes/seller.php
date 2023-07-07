<?php
$models = selectAll("model");
$baseIMG = 'img/';
?>

<div class="container-fluid py-5"  style="margin-bottom: 90px">
        <div class="container py-5">
            <div class="owl-carousel vendor-carousel">

                <?php foreach ($models as $model): ?>
                    <div class="bg-light p-4">
                        <img src="<?=$baseIMG.$model->img_src?>" alt="<?=$model->model_name?>"/>
                    </div>
                <?php endforeach; ?>

        </div>
    </div>
</div>

