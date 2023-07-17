(function ($) {
    "use strict";

    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);


        /**********Dohvatanje svih automobila i postavljanje u LS*************/
        ajaxCallback("logic/getAll.php","get",{table: "vehicle"},function (res){localStorage.setItem("cars",JSON.stringify(res))});

        localStorage.setItem("chatID",$('#chatUserID').val());

        setTimeout(function (){
            let hasChatClass = $('#chatBox').hasClass('chat');
            if(!hasChatClass){
                $('#chatPopup').show();
            }
            else {
                $('#chatPopup').hide()

            }
        },2000)
    });


    // Date and time picker
    $('.date').datetimepicker({
        format: 'L'
    });
    $('.time').datetimepicker({
        format: 'LT'
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Team carousel
    $(".team-carousel, .related-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 30,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        margin: 30,
        dots: true,
        loop: true,
        center: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        margin: 30,
        dots: true,
        loop: true,
        center: true,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });

})(jQuery);

/********* MOJ JS ************/
let path = window.location.pathname;

/*Contact inputs*/
let name = document.getElementById("name");
let email = document.getElementById("email");
let subject = document.getElementById("subject")
let msg = document.getElementById("message");
let btnSubmit = document.getElementById("submitMess");

/*Register inputs*/
let nameRegister = document.getElementById("nameReg");
let emailRegister = document.getElementById("emailReg");
let lastnameReg = document.getElementById("lNameReg");
let phoneReg = document.getElementById("phoneReg");
let driverL = document.getElementById("driverL");
let passwordReg = document.getElementById("passReg");
let dateBirth = document.getElementById("dateBirth");

/*Regex*/
let reName = /^[A-Z][a-z]{2,15}(\s[A-Z][a-z]{2,15})*$/;
let reEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
let reSubject = /^([A-Z]|[a-z]|[0-9]){1,30}(\s([A-Z]|[a-z]|[0-9]){1,30})*$/;
let reMsg = /^(([a-z]|[A-Z]|[0-9])+(\s|\.|\,|\'))?([a-z]|[A-Z]|[0-9]|(\s|\.|\,|\'))*$/;
let rePhone = /^(\([0-9]{3}\)|[0-9]{3}-)[0-9]{3}-[0-9]{4}$/;
let reDriverL = /^[0-9]{8}$/;
let rePassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
let reDate =  /^(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])\-(19|20)\d{2}$/;

if (path.includes("index") || path.includes("contact")){
name.addEventListener("blur",() => {
    checkForm(name,reName,"Incorrect name!");
})
email.addEventListener("blur",() => {
    checkForm(email,reEmail,"Incorrect email!");
})

subject.addEventListener("blur",() => {
    if(subject.value == ""){
        checkForm(subject,reSubject,"Subject is required!");
    }
    else {
        checkForm(subject,reSubject,"Incorrect subject!");
    }
})

msg.addEventListener("blur", () => {
    if(msg.value == ""){
        //checkForm(msg,reMsg,"Message is required!");
        $(msg).next().css('display','block');
        $(msg).next().html("Message is required!");
    }
    else {
        checkForm(msg,reMsg,"Incorrect message!");
    }
})

btnSubmit.addEventListener("click",(e) =>  {
    contactFormCheck();
})

}

if (path.includes("register")){
    /*Info driver license*/
    $('#infoDriver').hover(function (){
        $('#popUpDriver').removeClass("d-none");
    },function (){
        $('#popUpDriver').addClass("d-none");
    })
    /*****End*****/

    /****Check register form*****/
    $('#nameReg').blur(() => {
        checkForm(nameRegister,reName,"Incorrect name!");
    })
    $('#emailReg').blur(() => {
        checkForm(emailRegister,reEmail,"Incorrect email!");
    })
    $('#lNameReg').blur(() => {
        checkForm(lastnameReg,reName,"Incorrect last name !");
    })
    $('#phoneReg').blur(() => {
        checkForm(phoneReg,rePhone,"Incorrect phone xxx-xxx-xxxx.");
    })
    $('#driverL').blur(() => {
        checkForm(driverL,reDriverL,"Incorrect driver license.");
    })
    $('#passReg').blur(() => {
        checkForm(passwordReg,rePassword,"Minimum eight characters, <br>at least one letter and one number.");
    })
    $('#dateBirth').blur(() => {

        checkDateOfBirth();

    })

    $('#submit').click(function (e){
        e.preventDefault();
        checkRegister();
    });

}

if (path.includes("login")){
    $('#loginUser').click(function (e){
        e.preventDefault();
        checkLogin();
    })

}

if (path.includes("booking")){
    $('#reserveBtn').click(function (){
        reserveCar();
    })
}

function reserveCar(){
    let sepcialReq = $('#specilaReq').val();
    /****Current date****/
    let today = new Date();
    let currentMonth = today.getMonth()+1;
    let currentDay = today.getDate();
    let currentYear = today.getFullYear();
    let currentHour = today.getHours();
    let currentMin = today.getMinutes();


    /****User pickupDate***/
    let pickUpDate = $('#pickUpDate').val();
    let date = new Date(pickUpDate);
    let userMonth = date.getMonth()+1;
    let userDay = date.getDate();
    let userYear = date.getFullYear();

    let pickupTime = $('#pickUpTime').val();

    /****User dorpDate***/
    let dropDate = $('#dropDate').val();
    let userDropDate = new Date(dropDate);
    let userDropMonth = userDropDate.getMonth()+1;
    let userDropDay = userDropDate.getDate();
    let userDropYear = userDropDate.getFullYear();

    let dropTime = $('#dropTime').val();

    /***Error***/
    let pickUpDateErr = true;
    let pickupTimeErr = true;
    let dropDateErr = true;
    let dropTimeErr = true;
    let requestErr = true;
    let reservationErr = true;

    if (!pickUpDate){
        pickUpDateErr = checkDate($('#pickUpDate'),"Pickup date is required",true);
    }
    else {
        if(userMonth < currentMonth || (userDay < currentDay && userMonth <= currentMonth)){
            pickUpDateErr = checkDate($('#pickUpDate'),"Invalid date",true);

        }
        else if(userYear != currentYear || userMonth > currentMonth + 3){
            pickUpDateErr = checkDate($('#pickUpDate'),"You can book at most 3 months in advance",true);
        }
        else {
            pickUpDateErr = checkDate($('#pickUpDate'),"",false);

        }
    }

    if(!pickupTime){
        pickupTimeErr = checkDate($('#pickUpTime'),"Pickup time is required",true);
    }
    else {
        let userTime = pickupTime.split(":");
        let userHour = parseInt(userTime[0]);
        let userMin = parseInt(userTime[1].split(" ")[0]);
        let AM$PM = userTime[1].split(" ")[1];

            //&& (currentHour > 0 && currentHour < 13) && pickUpDateErr
            //currentHour = 20;
            if (AM$PM == "AM" && currentDay == userDay){
                if (userHour <= currentHour && pickUpDateErr){
                    pickupTimeErr = checkDate($('#pickUpTime'),"Incorrect time",true);

                }
            }
            //12-23/00
            //01 = 13
            else if (AM$PM == "PM" && currentDay == userDay){
                userHour += 12;
                if (userHour <= currentHour && pickUpDateErr){
                    pickupTimeErr = checkDate($('#pickUpTime'),"Incorrect time",true);
                }

            }
            if (pickupTimeErr){
                pickupTimeErr = checkDate($('#pickUpTime'),"",false);
            }

        }

    if (!dropDate){
        dropDateErr = checkDate($('#dropDate'),"Drop date is required",true);
    }
    else {
        if ((userDropDay <= userDay && userMonth == userDropMonth) || userDropMonth < userMonth){
            dropDateErr = checkDate($('#dropDate'),"Invalid date",true);
        }
        else if(userDropMonth > currentMonth + 3 || userDropYear != currentYear){
            dropDateErr = checkDate($('#dropDate'),"You can book at most 3 months",true);
        }
        else {
            dropDateErr = checkDate($('#dropDate'),"",false);
        }

    }

    if (!dropTime){
        dropTimeErr = checkDate($('#dropTime'),"Drop time is required",true);
    }
    else {
        dropTimeErr = checkDate($('#dropTime'),"",false);
    }

    if (sepcialReq != ""){
        if (!reMsg.test(sepcialReq)){
            requestErr = checkDate($('#specilaReq'),"Incorrect request",true)
        }
        else {
            requestErr = checkDate($('#specilaReq'),"",false)
        }
    }
    else {
        requestErr = checkDate($('#specilaReq'),"",false)
    }

    ajaxCallback("logic/getAll.php","get",{table: "reservation"},function (res){localStorage.setItem("reservation",JSON.stringify(res))});


    let allReservation = JSON.parse(localStorage.getItem("reservation"));
    let vehicleID = $('#vehicleID').val();

    if (pickUpDateErr && pickupTimeErr && dropDateErr && dropTimeErr && requestErr){

        let vehicleReservation = allReservation.filter(x => x.vehicle_id == vehicleID);

        for (let v of vehicleReservation){
            let vehiclePickup = v.start_date;
            let vehicleDrop = v.end_date;
            let pickupDate = new Date(vehiclePickup);
            let dropDate = new Date(vehicleDrop);

            let vehicleStartDay = pickupDate.getDate();
            let vehicleEndDay = dropDate.getDate();
            let vehicleMonth = pickupDate.getMonth()+1;

            //Vehiclste start - 1/03
            //Vehicle end - 16/03

            //User start - 15/03
            //User end - 01/04

                /*
                (vehicleMonth == userMonth || vehicleMonth == userDropMonth) &&
                (userDay <= vehicleStartDay && userDropDay <= vehicleEndDay)
                || (userDay >= vehicleStartDay && userDropDay <= vehicleEndDay ) || (userDay <= vehicleEndDay)
                */
            if ((userDay <= vehicleEndDay && userDay >= vehicleStartDay && userMonth == vehicleMonth))
            {
                $('#resevrationError').removeClass("ia-error");
                $('#resevrationError').html("The car is already reserved for the selected dates");
                reservationErr = false;
                break;
            }
            else {
                $('#resevrationError').addClass("ia-error");
                $('#resevrationError').html("");
                reservationErr = true;
            }

        }
    }
    else {
        $('#resevrationError').addClass("ia-error");
        $('#resevrationError').html("");
        reservationErr = false;
    }


    if (reservationErr){
        let userStartDate = userYear + "-" + userMonth + "-" + userDay;
        let userEndDate = userDropYear + "-" + userDropMonth + "-" + userDropDay
        let dataToSend = {
            startDate : userStartDate,//date.getTime()
            startTime : $('#pickUpTime').val(),
            endDate : userEndDate,//userDropDate.getTime()
            endTime : $('#dropTime').val(),
            message : sepcialReq,
            vehicleID : vehicleID
        }
        ajaxCallback("logic/reservation.php","post",dataToSend,function (res){
            switch (res){
                case 404:
                    location.replace("404.php");
                    break;
                case 0 :
                    $('#resevrationError').removeClass("ia-error");
                    $('#resevrationError').html("The car is already reserved for the selected dates");
                    break;
                case 1 :
                    $('#reservationSuccess').removeClass("ia-error");
                    $('#reservationSuccess').html("The car has been successfully booked");
                    break;
                default:
                    $('#resevrationError').removeClass("ia-error");
                    $('#resevrationError').html(res);
                    break;
            }
        })
    }


    function checkDate(input,msg,check){
        if(check){
            $(input).next().removeClass("ia-error");
            $(input).next().html(msg);
            return false;
        }
        else {
            $(input).next().addClass("ia-error");
            $(input).next().html("");
            return true;
        }

    }

}

function checkRegister(){
    let btn = $('#submit').val();
    let firstNameErr;
    let lastNameErr;
    let emailErr;
    let passErr;
    let phoneErr;
    let driverErr;
    let dateErr;

    if(nameRegister.value == ""){
        firstNameErr = checkForm(nameRegister,reName,"Name is required!");
    }
    else {
        firstNameErr = checkForm(nameRegister,reName,"Incorrect name!");
    }
    if(lastnameReg.value == ""){
        lastNameErr = checkForm(lastnameReg,reName,"Last name is required");
    }
    else {
        lastNameErr = checkForm(lastnameReg,reName,"Incorrect last name !");
    }
    if (emailRegister.value == ""){
        emailErr = checkForm(emailRegister,reEmail,"Email is required");
    }
    else {
        emailErr = checkForm(emailRegister,reEmail,"Incorrect email !");
    }
    if(passwordReg.value == ""){
        passErr = checkForm(passwordReg,rePassword,"Password is required");
    }
    else {
        passErr = checkForm(passwordReg,rePassword,"Minimum eight characters, <br>at least one letter and one number.");
    }
    if (phoneReg.value == ""){
        phoneErr = checkForm(phoneReg,rePhone,"Password is required");
    }
    else {
        phoneErr = checkForm(phoneReg,rePhone,"Incorrect phone: xxx-xxx-xxxx.");
    }
    if (driverL.value == ""){
        driverErr = checkForm(driverL,reDriverL,"Driver license is required");
    }
    else {
        driverErr = checkForm(driverL,reDriverL,"Incorrect driver license.");
    }
    if (dateBirth.value == ""){
        dateErr = false;
        $('#dateBirth').next().css('display','block');
        $('#dateBirth').next().html("Date of birth is required");
    }
    else {
       dateErr = checkDateOfBirth();
    }
    //01/25/2003
    let tmpB = dateBirth.value.split("/");
    let yearB = tmpB[2];
    let monthB = tmpB[0];
    let dayB = tmpB[1];
    let birthSend = yearB + "-" + monthB + "-" + dayB;
    console.log(birthSend);
    if(firstNameErr && lastNameErr && emailErr && passErr && phoneErr && driverErr && dateErr){
        let tmpB = dateBirth.value.split("/");
        let yearB = tmpB[2];
        let monthB = tmpB[0];
        let dayB = tmpB[1];
        let birthSend = yearB + "-" + monthB + "-" + dayB;
        let dataToSend = {
            firstName : nameRegister.value,
            lastName : lastnameReg.value,
            email : emailRegister.value,
            password : passwordReg.value,
            phone : phoneReg.value,
            driverLicense : driverL.value,
            dateBirth : birthSend,
            btnRegister : btn

        };
        ajaxCallback(
            "logic/registerUser.php",
            "post",
            dataToSend,
            function result(res){
                switch (res){
                    case "emailErr":
                        $('#emailReg').next().css('display','block');
                        $('#emailReg').next().html("The email is already in use <br><a href='login.php' class='text-primary'>Login</a>");
                        break;
                    case "phoneErr" :
                        $('#phoneReg').next().css('display','block');
                        $('#phoneReg').next().html("The phone is already in use");
                        break;
                    case "driverErr" :
                        $('#driverL').next().css('display','block');
                        $('#driverL').next().html("Driver license is already in use");
                        break;
                    case "success" :
                        location.replace("login.php?success=1");
                        break;
                    default :
                        $('#regLogin').next().css('display','block');
                        $('#regLogin').next().html("Server error.Please try again");
                }

            }
        )
    }

}

function checkLogin(){
    let emailLogin = document.getElementById("loginEmail");
    let passLogin = document.getElementById("loginPassword");
    let emailErr;
    let passErr;

    if (emailLogin.value == ""){
        emailErr = checkForm(emailLogin,reEmail,"Email is required");
    }
    else {
        emailErr = checkForm(emailLogin,reEmail,"Incorrect email !");
    }
    if (passLogin.value == ""){
        passErr = checkForm(passLogin,rePassword,"Password is required");
    }
    else {
        passErr = checkForm(passLogin,rePassword,"Minimum eight characters, <br>at least one letter and one number.");
    }

    if (passErr && emailErr){
        dataToSend = {
            email : emailLogin.value,
            password : passLogin.value
        };
        ajaxCallback(
            "logic/loginUser.php",
            "post",
            dataToSend,
            function (res){
                console.log(res);
                switch (res){
                    case "emailErr":
                        $('#loginEmail').next().css('display','block');
                        $('#loginEmail').next().html("Email doesn't exist");
                        break;
                    case "passErr":
                        $('#loginPassword').next().css('display','block');
                        $('#loginPassword').next().html("Incorrect password");
                        break;
                    default :

                        location.replace("index.php");
                        break;
                }
            }
        )
    }
}

function checkForm(input,regex,msg){
        let value = input.value;
        if(!regex.test(value)){
            $(input).next().css('display','block');
            $(input).next().html(msg);
            return  false;
        }
        else {
            $(input).next().css('display','none');
            $(input).next().html("");
            return true;
        }
}

function contactFormCheck(){
    let errorName = "";
    let errorEmail;
    let errorSubject;
    let errorMsg;
    errorName = checkForm(name,reName,"Incorrect name!");
    errorEmail = checkForm(email,reEmail,"Incorrect email!");
    if(subject.value == ""){
        errorSubject = checkForm(subject,reSubject,"Subject is required!");
    }
    else {
        errorSubject = checkForm(subject,reSubject,"Incorrect subject!");
    }
    if(msg.value == ""){
        errorMsg = false;
        $(msg).next().css('display','block');
        $(msg).next().html("Message is required!");
        //errorMsg = checkForm(msg,reMsg,"Message is required!");
    }
    else {
        errorMsg = checkForm(msg,reMsg,"Incorrect message!");
    }
    if(errorName && errorEmail && errorSubject && errorMsg){
        btnSubmit.nextElementSibling.classList.remove('ia-error');
        return true;
    }
    else {
        btnSubmit.nextElementSibling.classList.add('ia-error');
        return false;
    }
}

function checkDateOfBirth(){
    let today = new Date();
    let currentYear = today.getFullYear();
    let currentMonth = today.getMonth()+1;
    let currentDay = today.getDate();

    let dateBirthObj = new Date(dateBirth.value);
    let userBirthYear = dateBirthObj.getFullYear();
    let userBirthMonth = dateBirthObj.getMonth()+1;
    let userBirthDay = dateBirthObj.getDate();

    let age = currentYear - userBirthYear
    let month = currentMonth - userBirthMonth;

    if(userBirthYear >= currentYear){
        $('#dateBirth').next().css('display','block');
        $('#dateBirth').next().html("Incorrect date");
        return false;
    }
    else if (age < 18 && (month < 0 || (month == 0 && currentDay < userBirthDay)) || (currentMonth == userBirthMonth && currentDay < userBirthDay)){
        $('#dateBirth').next().css('display','block');
        $('#dateBirth').next().html("You must be over 18 years old");
        return false;
    }
    else {
        $('#dateBirth').next().css('display','none');
        $('#dateBirth').next().html("");
        return true;
    }
}

function ajaxCallback(file,method,data,result){
    $.ajax({
        url: file,
        method: method,
        data : data,
        success: result,
        error: function (xhr){
            alert("Ajax Error");
            console.log(xhr);
        }
    })
}

$('#closeModal').click(function (){
    $('#modal').hide();
})

$(document).on("click",'.aboutLoginPrice',function (){
    let id = $(this).data('carid');
    let Allcars = JSON.parse(localStorage.getItem("cars"));
    let car;
    for (let c of Allcars){
        if (c.vehicle_id == id){
            car = c;
        }
    }
    let html = `<div class="modal" id="modal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title text-black-50">${car.vehicle_name}</h4>
                    <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="alert alert-danger">You must be logged in to make a reservation</p>
                    <a href="login.php" class="alert h3 text-dark">Login</a>
                  </div>
                </div>
              </div>
            </div>`;
    $('#modalLogin').html(html);
    $('#closeModal').click(function (){
        $('#modal').hide();
    })
})

function check(){

    let models = $('.rbModels');
    let cheked = null;
    for (let c of models){
        if(c.checked){
            cheked = c;
        }
    }
    let id = cheked.id;
    if(!isNaN(id)){
        ajaxCallback("logic/filterVehicle.php","GET",{id : id},function (res){
            printVehicle(res);
        })
    }
}
/********* CHAT ********/
let tmpLS = localStorage.getItem("chatID");
let chatUserID;
if(tmpLS){
    chatUserID = tmpLS;
}
else {
    chatUserID = $('#chatUserID').val();
}

Pusher.logToConsole = false;

let pusher = new Pusher('d53e5e5280a3ec950d5e', {
    cluster: 'eu'
});

let channel = pusher.subscribe('chatApp');
channel.bind('response', function(data) {
    let user = $('#checkUser').val();
    let message = data.message;
    let id = data.id;
    let admin = data.admin;
    if(id == chatUserID ){ //user == "admin" ||
        let text = `<p>${admin == false ? "You" : admin}: ${message}</p>`;
        $('#chatMessages').append(text);
        const element = document.getElementById('chatMessages');
        if(element.scrollHeight > element.clientHeight){
            element.style.overflowY = "scroll";
            $('#closeChat').css('right',"5%")
        }
        else {
            element.style.overflowY = "hidden";
            $('#closeChat').css('right',"0%")
        }
        (function (){
            element.scrollTop = element.scrollHeight;
        })()
    }

});


//Chat Box

$('#chatBox').click(function (){
    let hasChatClass = $(this).hasClass('chat');
    if(!hasChatClass){
        $(this).addClass('chat')
        $('#chatPopup').hide();
    }
})

$(document).on("click","#closeChat",function (){
    $('#chatBox').removeClass('chat');
})

$('#sendButton').click(function (e){
    e.preventDefault();
    let message = $('#userChatField').val();
    $('#userChatField').val("");
    $.post('logic/chat.php',{chatMessage: message,userID: chatUserID},function (response){
    })
})










