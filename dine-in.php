<?php
error_reporting(0);
session_start();
if($_SESSION['user_active'] == True)
{
    $user_active = "True";
    $user_active_id = $_SESSION['user_active_id'];
}else
{
    $user_active = "False";
}
include('php/db_connect.php');
$order_id = $_GET['order_id'];
$query = mysqli_query($spizy_db_con,"SELECT * FROM order_data WHERE id = '$order_id'");
$query_array = mysqli_fetch_array($query);
if(isset($_GET['order_id']) && $_SESSION['user_active'] == True && $query_array > 0){
$order_id = $_GET['order_id'];
?>
<!DOCTYPE HTML>
<html lang="en">


<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>Spizy | Dine-In</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--=============== css  ===============-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment-with-locales.min.js"></script>
    <script src="https://getdatepicker.com/5-4/theme/js/tempusdominus-bootstrap-4.js"></script>
    <link rel="stylesheet" href="https://getdatepicker.com/5-4/theme/css/tempusdominus-bootstrap-4.css">
    <link type="text/css" rel="stylesheet" href="css/reset.css">
    <link type="text/css" rel="stylesheet" href="css/plugins.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/color.css">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="images/restaurant.png">
</head>

<body>
    <div class="loader">
        <?php include('loader.php')?>
    </div>
    <!--================= main start ================-->
    <div id="main">
        <!--=============== header ===============-->
        <header>
            <div class="header-inner">
                <div class="container">
                    <!-- navigation social links
                        <div class="nav-social">
                            <ul>
                                <li><a href="#" target="_blank" ><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" target="_blank" ><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#" target="_blank" ><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#" target="_blank" ><i class="fa fa-tumblr"></i></a></li>
                            </ul>
                        </div> -->
                    <!--logo-->
                    <div class="logo-holder">
                        <a href="index.php">
                            <img src="images/logo.jpg" class="respimg logo-vis" alt="">
                            <img src="images/logo2.jpg" class="respimg logo-notvis" alt="">
                        </a>
                    </div>
                    <!--Navigation -->
                    <div class="nav-holder" style="margin-top: 20px;">
                        <nav>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="menu.php">Menu</a>
                                    <!-- Menu Drop Down -->
                                    <ul>
                                        <li><a href="veg-menu.php">Veg</a></li>
                                        <li><a href="non-veg-menu.php">Non-Veg</a></li>
                                        <li><a href="desert-menu.php">Desert</a></li>
                                        <li><a href="drinks-menu.php">Drinks</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.php">Contact</a></li>
                                <?php
                                    if($_SESSION['user_active'] == True)
                                    {
                                        echo "<li><a href='cart.php'>Cart</a></li>";
                                        echo "<li><a href='logout.php'>Logout</a></li>";
                                    }
                                ?>
                                <!-- <li><a href="blog.php">Journal</a></li> -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!--header end-->
        <!--=============== wrapper ===============-->
        <div id="wrapper">
            <div class="content">
                <!--=============== parallax section  ===============-->
                <section class="parallax-section header-section">
                    <div class="bg bg-parallax" style="background-image:url(images/bg/33.jpg)"
                        data-top-bottom="transform: translateY(300px);"
                        data-bottom-top="transform: translateY(-300px);"></div>
                    <div class="overlay"></div>
                    <div class="container">
                        <h2>Make online reservation</h2>
                        <h3>Booking a table online is easy</h3>
                    </div>
                </section>
                <!--section end-->
                <!--=============== reservation ===============-->
                <section>
                    <div class="triangle-decor"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h4>Reservation Details</h4>
                                    <div class="separator color-separator"></div>
                                </div>
                                <section style="padding:20px 0px;">
                                    <div class="triangle-decor"></div>
                                    <div class="container w-auto p-1">
                                        <!-- CHECKOUT TABLE -->
                                        <div class="row">
                                            <div class="ajax_response" style="padding:0px;"></div>
                                        </div>
                                    </div>
                                </section>
                                <div class="bold-separator">
                                    <span></span>
                                </div>
                                <div class="reservation-form-holder">
                                    <div id="reservation-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3 style="float:auto; text-align:center;">Book a table</h3>
                                                <div class="form-group">
                                                    <label class="custome-form-label" 
                                                        for="datetimepicker4">Date</label>
                                                    <div class="input-group date" id="datetimepicker4"
                                                        data-target-input="nearest">
                                                        <input type="text" class="dine-in-date form-control datetimepicker-input"
                                                            style="width:auto" data-target="#datetimepicker4" />
                                                        <div class="input-group-append"
                                                            data-target="#datetimepicker4"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text" style="padding:11px;"><i
                                                                    class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                    $(function () {
                                                        $('#datetimepicker4').datetimepicker({
                                                            format: 'L',
                                                            enabledDates: [
                                                                moment("12/25/2013")
                                                            ]
                                                        });
                                                    });
                                                </script>
                                                <div class="form-group">
                                                    <label class="custome-form-label"
                                                        for="datetimepicker3">Time</label>
                                                    <div class="input-group date" id="datetimepicker3"
                                                        data-target-input="nearest">
                                                        <input type="text" class="dine-in-time form-control datetimepicker-input"
                                                            style="width:auto" data-target="#datetimepicker3" />
                                                        <div class="input-group-append"
                                                            data-target="#datetimepicker3"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text" style="padding:11px;"><i
                                                                    class="fa fa-clock-o"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                    $(function () {
                                                        $('#datetimepicker3').datetimepicker({
                                                            format: 'LT'
                                                        });
                                                    });
                                                </script>
                                                <!--restaurant-->
                                                <div class="form-group">
                                                    <label class="custome-form-label" for="resrest">Place</label>
                                                    <select class="form-control dine-in-place" id="resrest">
                                                        <option value="Spizy - Borivali(East)">Spizy - Borivali(East)
                                                        </option>
                                                        <option value="Spizy - Andheri(West)">Spizy - Andheri(West)
                                                        </option>
                                                        <option value="Spizy - Bandra(East)">Spizy - Bandra(East)
                                                        </option>
                                                    </select>
                                                </div>
                                                <!--person-->
                                                <div class="form-group">
                                                    <label class="custome-form-label" for="numperson">Person</label>
                                                    <select id="numperson" class="dine-in-person form-control">
                                                        <option value="1">1 Guest</option>
                                                        <option value="2">2 Guests</option>
                                                        <option value="3">3 Guests</option>
                                                        <option value="4">4 Guests</option>
                                                        <option value="5">5 Guests</option>
                                                        <option value="6">6 Guests</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h3 style="float:auto; text-align:center;">Contact Details</h3>
                                                <div class="form-group">
                                                    <label class="custome-form-label" for="name">Name</label>
                                                    <input type="text" class="dine-in-name" id="name" placeholder="Enter your Name" onClick="this.select()">
                                                </div>
                                                <div class="form-group">
                                                    <label class="custome-form-label" for="email">Email-id</label>
                                                    <input type="text" class="dine-in-email" id="email" placeholder="Enter your Email-id" onClick="this.select()" >
                                                </div>
                                                <div class="form-group">
                                                    <label class="custome-form-label" for="phone">Contact No.</label>
                                                    <input type="tel" class="dine-in-phone" id="phone" placeholder="Enter your Contact No" onClick="this.select()">
                                                </div>
                                                <div class="form-group">
                                                    <label class="custome-form-label" for="comments">Message</label>
                                                    <textarea id="comments" class="dine-in-message" rows="3" placeholder="Leave a Messaage for Us" onClick="this.select()" style="height:auto"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn custom-button confirm_reservation">Make a reservation</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--section end-->
                <!--=============== Opening Hours ===============-->
                <section class="parallax-section" id="sec2">
                    <div class="media-container video-parallax" data-top-bottom="transform: translateY(300px);"
                        data-bottom-top="transform: translateY(-300px);">
                        <div class="bg mob-bg" style="background-image: url(images/bg/22.jpg)"></div>
                    </div>
                    <div class="overlay"></div>
                    <div class="container">
                        <h2>Opening Hours</h2>
                        <h3>Call For Reservations</h3>
                        <div class="bold-separator">
                            <span></span>
                        </div>
                        <div class="work-time">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Monday To Friday</h3>
                                    <div class="hours">
                                        11:00 am<br> 10:00 pm
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Saturday & Sunday</h3>
                                    <div class="hours">
                                        11:00 am <br> 12:00 pm
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="big-number"><a href="#">+911234567890</a></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!--content end-->
            <!--=============== footer ===============-->
            <footer>
                <div class="footer-inner">
                    <div class="container">
                        <div class="row">
                            <div>
                                <div class="footer-social">
                                    <h3>Find us</h3>
                                    <ul>
                                        <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="bold-separator">
                            <span></span>
                        </div>
                        <!--footer contacts links -->
                        <ul class="footer-contacts">
                            <li><a href="#">Borivali | Andheri | Bandra</a></li>
                            <li><a href="#">+911234567890</a></li>
                            <li><a href="#">spizy@hotel.com</a></li>
                        </ul>
                    </div>
                </div>
                <!--to top / privacy policy-->
                <div class="to-top-holder">
                    <div class="container">
                        <p style="color:#C59D5F"> <span> &#169; Spizy. </span> All rights reserved.</p>
                        <div class="to-top"><span>Back To Top </span><i class="fa fa-angle-double-up"></i></div>
                    </div>
                </div>
            </footer>
            <!--footer end -->
        </div>
        <!-- wrapper end -->
    </div>
    <!-- Main end -->
    <!--=============== scripts  ===============-->

    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
<script>
    $('document').ready(function () {
        setTimeout(() => {
            pload();
        }, 2000);
    })
</script>
<script>
    function check_params(type){
        if(type == 'date'){
            var dummy = $('.dine-in-date').val();
            var dummy_len = dummy.length;
            if(dummy_len > 0){
                return true;
            }else{
                Swal.fire({
                icon: 'warning',
                title: 'Incorrect Date',
                position: 'top-end',
                toast: true,
                padding: '0.3em',
                showConfirmButton: false,
                timer: 3000,
                background: 'rgba(255, 255, 255, 1)'
                });
                return false;
            }
        }
        else if(type == 'time'){
            var dummy = $('.dine-in-time').val();
            var dummy_len = dummy.length;
            if(dummy_len > 0){
                return true;
            }else{
                Swal.fire({
                icon: 'warning',
                title: 'Incorrect Time',
                position: 'top-end',
                toast: true,
                padding: '0.3em',
                showConfirmButton: false,
                timer: 3000,
                background: 'rgba(255, 255, 255, 1)'
                });
                return false;
            }
        }
        else if(type == 'place'){
            var dummy = $('.dine-in-place').val();
            var dummy_len = dummy.length;
            if(dummy_len > 0){
                return true;
            }else{
                Swal.fire({
                icon: 'warning',
                title: 'Incorrect Place',
                position: 'top-end',
                toast: true,
                padding: '0.3em',
                showConfirmButton: false,
                timer: 3000,
                background: 'rgba(255, 255, 255, 1)'
                });
                return false;
            }
        }
        else if(type == 'person'){
            var dummy = $('.dine-in-person').val();
            var dummy_len = dummy.length;
            if(dummy_len > 0){
                return true;
            }else{
                Swal.fire({
                icon: 'warning',
                title: 'Incorrect Detail',
                position: 'top-end',
                toast: true,
                padding: '0.3em',
                showConfirmButton: false,
                timer: 3000,
                background: 'rgba(255, 255, 255, 1)'
                });
                return false;
            }
        }
        else if(type == 'name'){
            var dummy = $('.dine-in-name').val();
            var dummy_len = dummy.length;
            if(dummy_len > 0){
                return true;
            }else{
                Swal.fire({
                icon: 'warning',
                title: 'Incorrect Detail',
                position: 'top-end',
                toast: true,
                padding: '0.3em',
                showConfirmButton: false,
                timer: 3000,
                background: 'rgba(255, 255, 255, 1)'
                });
                return false;
            }
        }
        else if(type == 'email'){
            var dummy = $('.dine-in-email').val();
            var dummy_len = dummy.length;
            if(dummy_len > 0){
                return true;
            }else{
                Swal.fire({
                icon: 'warning',
                title: 'Incorrect Detail',
                position: 'top-end',
                toast: true,
                padding: '0.3em',
                showConfirmButton: false,
                timer: 3000,
                background: 'rgba(255, 255, 255, 1)'
                });
                return false;
            }
        }
        else if(type == 'phone'){
            var dummy = $('.dine-in-phone').val();
            var dummy_len = dummy.length;
            if(dummy_len > 0){
                return true;
            }else{
                Swal.fire({
                icon: 'warning',
                title: 'Incorrect Contact No',
                position: 'top-end',
                toast: true,
                padding: '0.3em',
                showConfirmButton: false,
                timer: 3000,
                background: 'rgba(255, 255, 255, 1)'
                });
                return false;
            }
        }
    }

    $('.dine-in-date').keyup(function(){
        check_params('date');
    })
    $('.dine-in-time').keyup(function(){
        check_params('time');
    })
    $('.dine-in-place').change(function(){
        check_params('place');
    })
    $('.dine-in-person').change(function(){
        check_params('person');
    })
    $('.dine-in-name').keyup(function(){
        check_params('name');
    })
    $('.dine-in-name').blur(function(){
        check_params('name');
    })
    $('.dine-in-email').keyup(function(){
        check_params('email');
    })
    $('.dine-in-email').blur(function(){
        check_params('email');
    })
    $('.dine-in-phone').keyup(function(){
        check_params('phone');
    })
    $('.dine-in-phone').blur(function(){
        check_params('phone');
    })

    
    function ajax_cart_call() {
        var ajax_request = true;
        var get_cart_details_method = true;
        var order_id = <?php echo $order_id?>;
        $.ajax({
            url: 'ajax_files/cart_operations/cart_main_page.php',
            type: 'POST',
            data: {
                ajax_request: ajax_request,
                get_cart_details_method: get_cart_details_method,
                order_id : order_id
            },
            beforeSend: function () {
                ajax_start();
            },
            complete: function () {
                ajax_complete();
            },
            success: function (response) {
                $('.ajax_response').html(response);
            }
        })
    }
    ajax_cart_call();

    $('.confirm_reservation').on('click',function(){
        if(check_params('date') && check_params('time') && check_params('place') && check_params('person') && check_params('name') && check_params('email') && check_params('phone')){
        var dine_in_date = $('.dine-in-date').val();
        var dine_in_time = $('.dine-in-time').val();
        var dine_in_place = $('.dine-in-place').val();
        var dine_in_name = $('.dine-in-name').val();
        var dine_in_person = $('.dine-in-person').val();
        var dine_in_email = $('.dine-in-email').val();
        var dine_in_phone = $('.dine-in-phone').val();
        var dine_in_message = $('.dine-in-message').val();
        var ajax_request = true;
        var order_id = <?php echo $order_id?>;
        var confirm_generate_order = true;
        $.ajax({
                url: 'ajax_files/dine-in/operations.php',
                type: 'POST',
                data: {
                    ajax_request: ajax_request,
                    confirm_generate_order: confirm_generate_order,
                    order_id : order_id,
                    dine_in_email : dine_in_email,
                    dine_in_phone : dine_in_phone,
                    dine_in_date : dine_in_date,
                    dine_in_time : dine_in_time,
                    dine_in_place : dine_in_place,
                    dine_in_name : dine_in_name,
                    dine_in_message : dine_in_message,
                    dine_in_person : dine_in_person
                },
                beforeSend: function () {
                    ajax_start();
                },
                complete: function () {
                    ajax_complete();
                },
                success: function (response) {
                    $('#main').append(response);
                }
            })
        }else{
            Swal.fire({
            icon: 'warning',
            title: 'Something went Wrong !!!',
            position: 'top-end',
            toast: true,
            padding: '0.3em',
            showConfirmButton: false,
            timer: 3000,
            background: 'rgba(255, 255, 255, 1)'
            });
        }
    })
</script>
</html>
<?php
}
else{
    echo "<script>window.open('index.php','_parent');</script>";
}?>