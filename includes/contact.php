<?php
if(isset($_POST['submitMess'])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $errors = [];
    $succMsg = "";
    $errMsg = "";

    $reName = '/^[A-Z][a-z]{2,15}(\s[A-Z][a-z]{2,15})*$/';
    $reSubject = '/^([A-Z]|[a-z]){1,30}(\s([A-Z]|[a-z]|[0-9]){1,30})*$/';
    $reMessage = '/^(([a-z]|[A-Z]|[0-9])*(\s|\.|\,|\'))?([a-z]|[A-Z]|[0-9]|(\s|\.|\,|\'))*$/';

    if(!$name) {
        $errors['nameErr'] = "Name is required";
    }
    else if (!preg_match($reName,$name)){
        $errors['nameErr'] = "Incorect name!";
    }
    if(!$email){
        $errors['emailErr'] = "Email is required";
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['emailErr'] = "Incorect email!";
    }

    if(!$subject){
        $errors['subjectErr'] = "Subject is required";
    }
    else if (!preg_match($reSubject,$subject)){
        $errors['subjectErr'] = "Incorect subject";
    }

    if (!$message){
        $errors['msgErr'] = "Message is required";
    }
    else if (!preg_match($reMessage,$message)){
        $errors['msgErr'] = "Incorect message";
    }

    if(!count($errors)){
        $result = sendMessage($name,$email,$subject,$message);
        if($result){
            $succMsg = "Message sent successfully";
            modal($succMsg,"success");

        }
        else{
            $errMsg = "Message sent successfully";
            modal($errMsg,"danger");
        }

    }
}


?>


<div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-1 text-primary text-center">06</h1>
            <h1 class="display-4 text-uppercase text-center mb-5">Contact Us</h1>
            <div class="row">
                <div class="col-lg-7 mb-2">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                        <!-- logic/sendMessage.php-->
                        <form action="<?= $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return contactFormCheck()">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <input type="text" class="form-control p-4" placeholder="Your Name"
                                        name="name" id="name" >
                                        <div class="alert alert-danger ia-error">
                                            <?php if(isset($errors["nameErr"])){
                                                echo $errors["nameErr"];
                                            }?>
                                        </div>

                                </div>
                                <div class="col-6 form-group">
                                    <input type="text" class="form-control p-4" placeholder="Your Email"
                                         name="email" id="email">
                                        <div class="alert alert-danger ia-error">
                                            <?php if(isset($errors["emailErr"])){
                                                echo $errors["emailErr"];
                                            }?>
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control p-4" placeholder="Subject"  name="subject" id="subject">
                                <div class="alert alert-danger ia-error">
                                    <?php if(isset($errors["subjectErr"])){
                                        echo $errors["subjectErr"];
                                    }?>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control py-3 px-4" rows="5" placeholder="Message"
                                     name="message" id="message"></textarea>
                                    <div class="alert alert-danger ia-error">
                                        <?php if(isset($errors["msgErr"])){
                                            echo $errors["msgErr"];
                                        }?>
                                    </div>
                            </div>
                            <div>
                                <button class="btn btn-primary py-3 px-5" type="submit" id="submitMess" name="submitMess">Send Message</button>
                                <div class="alert alert-success ia-error">Message sent successfully</div>
                            </div>
                            <?php
                                if(isset($succMsg)){
                                    echo '<div class="alert alert-success">'.$succMsg.'</div>';
                                }
                                else if(isset($errMsg)) {
                                    echo '<div class="alert alert-danger">'.$errMsg.'</div>';
                                }
                            ?>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 mb-2">
                    <div class="bg-secondary d-flex flex-column justify-content-center px-5 mb-4"
                        style="height: 435px;">
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Head Office</h5>
                                <p>123 Street, New York, USA</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Branch Office</h5>
                                <p>123 Street, New York, USA</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Customer Service</h5>
                                <p>customer@example.com</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Return & Refund</h5>
                                <p class="m-0">refund@example.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>