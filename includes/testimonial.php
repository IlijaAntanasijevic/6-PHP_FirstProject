<?php
$clients = selectReviews();
?>

<div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="display-1 text-primary text-center">05</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Our Client's Say</h1>
            <div class="owl-carousel testimonial-carousel">

<?php foreach ($clients as $client): ?>
    <div class="testimonial-item d-flex flex-column justify-content-center px-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <img class="img-fluid ml-n4" src="img/<?=$client->avatar_src?>" alt="<?=$client->avatar_src?>">
            <h1 class="display-2 text-white m-0 fa fa-quote-right"></h1>
        </div>
        <h4 class="text-uppercase mb-2"><?=$client->first_name." ".$client->last_name?></h4>
        <p class="m-0"><?=$client->comment?></p>
    </div>

                
<?php endforeach; ?>

</div>
        </div>
    </div>