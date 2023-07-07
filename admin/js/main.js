(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });


    // Progress Bar
    $('.pg-bar').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, {offset: '80%'});


    // Calender
    $('#calender').datetimepicker({
        inline: true,
        format: 'L'
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: true,
        loop: true,
        nav : false
    });


    // Chart Global Color
    Chart.defaults.color = "#6C7293";
    Chart.defaults.borderColor = "#000000";


    
})(jQuery);

/****MOJ JS****/
$.ajax({
    url: "../logic/getAll.php",
    method: "get",
    data : {table: "vehicle"},
    success: function (res){
        localStorage.setItem("cars",JSON.stringify(res))
    },
    error: function (xhr){
        alert("Ajax Error");
        console.log(xhr);
    }
})

$('#sortDate').change(() => {
    let id = $('#sortDate').val();
    if (id != 0){
       if (id == "date-asc"){
          ajaxCallback("logic/getAllOrder.php","ASC", "GET",printRecentSales);
       }
       else if (id == "date-desc"){
           ajaxCallback("logic/getAllOrder.php","DESC", "GET",printRecentSales);
       }
    }
})

$('#sortVehicle').change(() => {
    let id = $('#sortVehicle').val();
    let reTest = /^[\d]$/;
    if (reTest.test(id)){
        ajaxCallback("logic/orderVehicleName.php",id, "GET",printRecentSales);
    }
})

function printRecentSales(result){
    let html = "";
    for(let r of result){
        let startDate = r.start_date.split(" ");
        let dateS = startDate[0].split("-");
        let startDateFormat = dateS[2] + "-" + dateS[1] + "-" + dateS[0];

        let endDate = r.end_date.split(" ");
        let dateE = endDate[0].split("-");
        let endDateFormat = dateE[2] + "-" + dateE[1] + "-" + dateE[0];
        html += `<tr class="text-center">
            <td>${r.vehicle_name}</td>
            <td>${startDateFormat}</td>
            <td>${endDateFormat}</td>
            <td>${r.first_name + " " + r.last_name}</td>
            <td>${r.total_price}$</td>
            <td>${r.price}$</td>
            <td><a class="btn btn-sm btn-primary" href="reservation.php?id=${r.reservation_id}">Detail</a></td>
        </tr>`;
    }
    $('#tableBody').html(html);
}

$('.btnDeleteVehicle').click(function () {
    let id = $(this)[0].id;
    let Allcars = JSON.parse(localStorage.getItem("cars"));
    let car = Allcars.filter(x => x.vehicle_id == id);
    let carName = car[0].vehicle_name;

    printModal(carName,"Are you sure you want to delete.");

    $('#confirm').click(() => {
        $('#modalDelete').css('display','none');
        $.ajax({
            url : "logic/deleteVehicle.php",
            method: "POST",
            data: { id: id },
            success: function(res) {
                $("#row-" + id).remove()
            },
            error : function (xhr){
                console.log(xhr);
            }
        })
    })
})

$('.btnDeleteModel').click(function (e){
    e.preventDefault();
    let id = $(this)[0].id;
    printModal("Model delete","Are you sure you want to delete.")

    $('#confirm').click(() => {
        $('#modal').css('display','none');
        $.ajax({
            url : "logic/deleteModel.php",
            method : "POST",
            data: { id: id },
            success: function(res) {
                console.log(res);
                if (res == 404){
                    location.replace("../404.php");
                }
                else {
                    if (res.includes("use")){
                        basicModelPrint("","The model is in use.Cannot delete!");
                    }
                    else if (res.includes("success")){
                        basicModelPrint("","Deleted successfully");
                        $("#row-" + id).remove();
                    }
                    else {
                        basicModelPrint("","Server error. Please try again later");
                    }
                }

            },
            error : function (xhr){
                console.log(xhr);
            }
        })
    })

})

$('.btnCloseDelete').click(() => {
    $('#modal').css('display','none');
})

$('#ddlSortMessage').change(function (){
    let value = $(this).val();
    if (value == 0){
        ajaxCallback("logic/sortMessage.php",value, "GET",printMessages);
    }
    if (value == "date-asc"){
        ajaxCallback("logic/sortMessage.php","ASC", "GET",printMessages);
    }
    if (value == "date-desc"){
        ajaxCallback("logic/sortMessage.php","DESC", "GET",printMessages);
    }

})

$(document).on('click','.hideReview',function (){
    let id = $(this)[0].id;
    hideShowReview(id);

})

function hideShowReview(id){
    $.ajax({
        url : "hideReviews.php",
        data : {id : id},
        method : "post",
        dataType: "json",
        success : function (res){
            console.log(res);
            if (res == 1){
                let string = `<p class="btn btn-success hideReview" id = "${id}">Show</p>`;
                $('#actionRev-'+ id).html(string);
                $('#limit').addClass('ia-error');
            }
            else if (res == 0) {
                let string = `<p class="btn btn-danger hideReview" id = "${id}">Hide</p>`;
                $('#actionRev-'+ id).html(string);
                $('#limit').addClass('ia-error');
            }
            else {
                $('#limit').removeClass('ia-error');
            }
        },
        error : function (xhr){
            alert("GRESKA");
            console.log(xhr)
        }
    })
}


function ajaxCallback(url,type,method,result){
    $.ajax({
        url: url,//logic/getAllOrder.php
        data : {
            type : type,
        },
        method : method,
        dataType : "json",
        success: function (res){
            result(res);
        },
        error : function (xhr){
            alert("AJAX ERR");
            console.log(xhr);
        }

    })
}

function printModal(title,text){
    let string = `<div id="modal" class="modal" tabindex="-1">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-dark">${title}</h5>
                        <button type="button" class="btn-close btnCloseDelete" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p class="text-dark h3">${text}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnCloseDelete" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="confirm"  class="btn btn-primary">Yes</button>
                      </div>
                    </div>
                  </div>
                </div>`;
    $('#modalDelete').html(string);

    $('.btnCloseDelete').click(() => {
        $('#modal').css('display','none');
    })
}

function basicModelPrint(title,text){
    let string = `<div id="modal" class="modal" tabindex="-1">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-body">
                        <button type="button" id="updateModal" class="btn-close btnCloseDelete mb-3" data-bs-dismiss="modal" aria-label="Close"></button>
                        <p class="text-dark h3 mt-5">${text}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary btnCloseDelete" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>`;
    $('#modalDelete').html(string);

    $('.btnCloseDelete').click(() => {
        $('#modal').css('display','none');
    })
}

function printMessages(messages){
    let string = "";

    for (let m of messages){
        string += `
    <div class="my-3 pt-4 border-top ">
        <div class="row h4">
            <div class="col-4">
                <p class="text-center text-light">Name</p>
                <p class="text-center">${m.name}</p>
            </div>
            <div class="col-4">
                <p class="text-center text-light">Email</p>
                <p class="text-center">${m.email}</>
            </div>
            <div class="col-4">
                <p class="text-center text-light">Date</p>`;

                    let date = m.date.split(" ");
                    date = date[0].split("-");
                    date = date[0] + "-" + date[1] + "-" + date[2];
                string += `<p class="text-center">${date}</p>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12">
                <p class="text-center h4">Subject</p>
                <p class="text-white text-center pt-0 px-3 pb-3">${m.subject}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-center h4" ">Message</p>
                <p class="text-white p-3 border border-light m-2">${m.text}</p>
            </div>
        </div>
    </div>`;
    }
    $('#mess').html(string);
}

