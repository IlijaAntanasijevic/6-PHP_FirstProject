<!-- Footer Start -->
<?php
include "config/conf.php";
global $links;
global $usefullLinks;
global $infoCompany;
?>
<div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5">
    <div class="row pt-5">
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Get In Touch</h4>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i><?= $infoCompany["address"] ?></p>
            <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i><?= $infoCompany["phone"] ?></p>
            <p><i class="fa fa-envelope text-white mr-3"></i><?= $infoCompany["email"] ?></p>
            <h6 class="text-uppercase text-white py-2">Follow Us</h6>
            <div class="d-flex justify-content-start">
                <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="<?= $links['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="<?= $links['facebook']; ?>"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="<?= $links['linkedin']; ?>"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-lg btn-dark btn-lg-square" href="<?= $links['instagram']; ?>"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Usefull Links</h4>
            <div class="d-flex flex-column justify-content-start">
                <?php foreach ($usefullLinks as $key => $val): ?>
                    <a class="text-body my-1" href="<?= $val ?>"><i class="fa fa-angle-right text-white mr-2"></i><?= $key ?></a>
                <?php endforeach; ?>
            </div>
        </div>
       <?php
        include_once("footerGallery.php")
       ?>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Newsletter</h4>
            <p class="mb-4">Volup amet magna clita tempor. Tempor sea eos vero ipsum. Lorem lorem sit sed elitr sed
                kasd et</p>

            <i>Lorem sit sed elitr sed kasd et</i>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
    <p class="mb-2 text-center text-body">&copy; <a href="author.php">Ilija 48/21</a>. All Rights Reserved.</p>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<!--jQuery-->

<!-- Template Javascript -->
<script src="js/main.js"></script>

</body>

</html>
