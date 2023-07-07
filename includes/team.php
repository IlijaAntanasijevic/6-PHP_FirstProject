<?php
$team = selectAll("employee");

?>

<div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="display-1 text-primary text-center">04</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Meet Our Team</h1>
            <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">


<?php //for($i = 0; $i < 3; $i ++) {

foreach ($team as $item):

?>

  <div class="team-item">
                    <img class="img-fluid w-100" src="img/<?=$item->avatar_src?>" alt="<?=$item->first_name?>">
                    <div class="position-relative py-4">
                        <h4 class="text-uppercase"><?=$item->first_name ." ". $item->last_name?></h4>
                        <p class="m-0"><?=$item->job_type?></p>
                        <div
                            class="team-social position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                            <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="https://twitter.com/"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="https://www.facebook.com/"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="https://www.linkedin.com/"><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

<?php
//}
endforeach;
?>

</div>
        </div>
    </div>