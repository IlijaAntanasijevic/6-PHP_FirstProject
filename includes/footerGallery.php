<?php
$galleryImages = galleryImages();
?>

<div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Car Gallery</h4>
                <div class="row mx-n1">
                   <?php foreach ($galleryImages as $img): ?>
                       <div class="col-4 px-1 mb-2">
                           <a href=""><img class="w-100" src="img/<?=$img->img_src?>" alt="<?=$img->alt?>"></a>
                       </div>
                    <?php endforeach; ?>
                </div>
            </div>