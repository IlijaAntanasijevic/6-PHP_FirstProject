<?php
include "includes/header.php";
?>
<div id="register" >
    <div id="registerRegion" >
        <form id="form" class="d-flex flex-column align-items-center mt-5">
            <label for="loginEmail">Email: </label>
            <div>
                <input type="text" id="loginEmail" name="loginEmail"/>
                <p class="text-danger ia-error"></p>
            </div>
            <label for="loginPassword">Password: </label>
            <div>
                <input type="password" id="loginPassword" name="loginPassword"/>
                <p class="text-danger ia-error"></p>
            </div>
            <div class="d-flex" id="btnsReg">
                <input type="button" id="loginUser" value="Login" name="btnLogin">
                <a href="register.php" id="regLogin">Register</a>
                <?php if(isset($_GET["success"])){
                    echo "<p class='alert alert-primary mt-3 text-dark'>Successfuly registered</p>";
                } ?>
            </div>
        </form>
    </div>
</div>

<?php
include "includes/footer.php";
?>
