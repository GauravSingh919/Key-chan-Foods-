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
                                <!-- <li><a href="gallery.php">Gallery</a></li> -->
                                <!-- <li><a href="dine-in.php" class="act-link">Dine-In</a></li>
                                <li><a href="door-bell.php">Door-Bell</a></li> -->
                                <!-- <li><a href="shop.php">Shop</a></li> -->
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
                        <h2>Ordering online is easy</h2>
                        <h3>Get It Delivered at Your Door Steps</h3>
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
                                    <h4>Order information</h4>
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
                                    <div class="reservation-form">
                                        <div id="message"></div>
                                        <div id="reservation-form">
                                            <div class="row">
                                                <div class="center-block col-md-6">
                                                        <h3 style="text-align:center;">Delivery Details</h3>
                                                        <div class="form-group">
                                                            <label class="custome-form-label" for="name">Name</label>
                                                            <input type="text" class="door-step-name" id="name" placeholder="Full Name" onClick="this.select()">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="custome-form-label" for="phone">Contact No.</label>
                                                            <input type="tel" class="door-step-phone" id="phone" onClick="this.select()" placeholder="Contact Number">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="custome-form-label" for="address">Delivery Address</label>
                                                            <textarea id="address" class="door-step-add" placeholder="Please Enter Correct Address for Faster & Efficient Delivery" rows="4" onClick="this.select()" style="height:auto"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="custome-form-label" for="comments">Message</label>
                                                            <textarea id="comments" class="door-step-message" placeholder="Delivery Message" rows="3" onClick="this.select()" style="height:auto"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            <button class="delivery_submit btn custom-button" style="margin-top:20px;">Confirm Order</button>
                                        </div>
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
                        <div class="video-container">
                            <video autoplay loop muted class="bgvid">
                                <source src="video/1.mp4" type="video/mp4">
                            </video>
                        </div>
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
                                        11:00<br> 22:00
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Saturday & Sunday</h3>
                                    <div class="hours">
                                        11:00<br> 24:00
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
        function check_params(type){
        if(type == 'name'){
            var dummy = $('.door-step-name').val();
            var dummy_len = dummy.length;
            if(dummy_len > 0){
                return true;
            }else{
                Swal.fire({
                icon: 'warning',
                title: 'Incorrect Data',
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
            var dummy = $('.door-step-phone').val();
            var dummy_len = dummy.length;
            if(dummy_len > 0){
                return true;
            }else{
                Swal.fire({
                icon: 'warning',
                title: 'Incorrect Data',
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
        else if(type == 'add'){
            var dummy = $('.door-step-add').val();
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
    }

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

    function delivery_submit(){
        if(check_params('name') && check_params('phone') && check_params('add')){
            var user_name = $('.door-step-name').val();
            var user_contact = $('.door-step-phone').val();
            var user_add = $('.door-step-add').val();
            var message = $('.door-step-message').val();
            var ajax_request = true;
            var order_id = <?php echo $order_id?>;
            var confirm_generate_order = true;
            $.ajax({
                    url: 'ajax_files/door-bell/operations.php',
                    type: 'POST',
                    data: {
                        ajax_request: ajax_request,
                        confirm_generate_order: confirm_generate_order,
                        user_name: user_name,
                        message : message,
                        user_contact: user_contact,
                        user_add: user_add,
                        order_id : order_id
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
    }

    $('.delivery_submit').on('click',function(){
        delivery_submit();
    })
    $('.door-step-name').keyup(function(){
        check_params('name');
    })
    $('.door-step-phone').keyup(function(){
        check_params('phone');
    })
    $('.door-step-phone').blur(function(){
        check_params('phone');
    })
    $('.door-step-add').keyup(function(){
        check_params('add');
    })  
</script>
<script>
    $('document').ready(function () {
        setTimeout(() => {
            pload();
        }, 2000);
        ajax_cart_call();
    })
</script>

</html>
<?php
}
else{
    echo "<script>window.open('index.php','_parent');</script>";
}?>