<?php
require_once("includes/header.php");

?>
<div id="register" >
    <div id="registerRegion" >
        <form id="form">
            <div id="regsiterForm">
            <div>
                <label for="nameReg">First name: </label>
                <div>
                    <input type="text" id="nameReg" name="fName"/>
                    <p class="text-danger ia-error"></p>
                </div>
                <label for="emailReg">Email: </label>
                <div>
                    <input type="text" id="emailReg" name="emailReg"/>
                    <p class="text-danger ia-error"></p>
                </div>
                <div>
                    <label for="phoneReg">Phone: </label>
                    <div>
                        <input type="text" id="phoneReg" name="phone" placeholder="xxx-xxx-xxxx"/>
                        <p class="text-danger ia-error"></p>
                    </div>
                    <label for="dateBirth">Date of birth: </label>
                    <div class="date" id="dateBirth1" data-target-input="nearest">
                        <input type="text" class="form-control p-4 datetimepicker-input"
                               data-target="#dateBirth1" data-toggle="datetimepicker" id="dateBirth" name="dateBirth"/>
                        <p class="text-danger ia-error"></p>
                    </div>
                </div>
            </div>
            <div>
                <label for="lNameReg">Last name: </label>
                <div>
                    <input type="text" id="lNameReg" name="lName">
                    <p class="text-danger ia-error"></p>
                </div>
                <label for="passReg">Password: </label>
                <div>
                    <input type="password" id="passReg" name="password">
                    <p class="text-danger ia-error"></p>
                </div>
                <div>
                    <label for="driverL" class="position-relative">Driver license:
                        <i class="fa fa-info-circle" aria-hidden="true" id="infoDriver">
                            <div class="popup-text d-none" id="popUpDriver"> 8 numbers on the driver's license</div>
                        </i>
                    </label>
                    <div>
                        <input type="number" id="driverL" name="driverLicense"/>
                        <p class="text-danger ia-error"></p>
                    </div>

                </div>
            </div>

            </div>
            <div class="d-flex" id="btnsReg">
                <button  type="submit" id="submit" name="btnRegister" value="register">Register</button>
                <a href="login.php" id="regLogin">Login</a>
                <p class="text-danger alert alert-danger ia-error"></p>
            </div>

        </form>
    </div>
</div>

<?php
require_once("includes/footer.php");
?>