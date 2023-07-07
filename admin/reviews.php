<?php
include_once "header.php";
include_once "sidebar.php";
global $conn;
$query = "SELECT r.*,c.first_name,c.last_name,v.vehicle_name
          FROM reviews r INNER JOIN customer c ON r.customer_id = c.customer_id INNER JOIN vehicle v ON r.vehicle_id=v.vehicle_id";
$select = $conn->query($query);
$allReviews =  $select->fetchAll();
?>

    <div class="content">
    <!-- Navbar Start -->
    <?php include "navbar.php"; ?>

    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="bg-secondary rounded p-4">
                <h6 class="mb-4">Messages</h6>
                <h6 class="alert-danger w-50 mx-auto text-center py-2 ia-error" id="limit">You can display at least 3 comments</h6>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Vehicle</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $nmbr = 1; foreach ($allReviews as $r): ?>
                        <tr>
                            <th scope="row"><?= $nmbr ?></th>
                            <td><?= $r->first_name ." ".$r->last_name ?></td>
                            <td class="text-white"><?=$r->vehicle_name ?></td>
                            <td><?= $r->comment ?></td>
                            <td><img src="../img/<?= $r->avatar_src ?>" alt="<?= $r->first_name?>-avatar"></td>
                            <td id="actionRev-<?= $r->reviews_id ?>">
                                <?php if($r->active): ?>
                                    <p class="btn btn-success hideReview" id = "<?= $r->reviews_id ?>">Show</p>
                                <?php else: ?>
                                    <p class="btn btn-danger hideReview" id = "<?= $r->reviews_id ?>">Hide</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $nmbr++; endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php include "footer.php"; ?>