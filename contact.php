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
if($_SESSION['user_active'] == True){
?>
<!DOCTYPE HTML>
<html lang="en">



<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>Spizy | Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
                                <li><a href="contact.php" class="act-link">Contact</a></li>
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
                <section class="parallax-section header-section">
                    <div class="bg bg-parallax" style="background-image:url(images/bg/32.jpg)" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
                    <div class="overlay"></div>
                    <div class="container">
                        <h2>Our contacts</h2>
                        <h3>Were to find us</h3>
                    </div>
                </section>
                <section>
                    <div class="triangle-decor"></div>
                    <div class="container" style="margin-bottom:80px">
                        <div class="row">
                            <div class="col-md-4 contact-details">
                                <h4>Spizy | Borivali(East)</h4>
                                <ul>
                                    <li><a href="#">27th Plaza, Main Road</a></li>
                                    <li><a href="#">+911234567890</a></li>
                                    <li><a href="#">spizy@hotel.com</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 contact-details">
                                <h4>Spizy | Andheri(West)</h4>
                                <ul>
                                    <li><a href="#">Circuit Town, Opp Cineplex</a></li>
                                    <li><a href="#">+911234567890</a></li>
                                    <li><a href="#">spizy@hotel.com</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4 contact-details">
                                <h4>Spizy | Bandra(East)</h4>
                                <ul>
                                    <li><a href="#">Dream Park, Open Street</a></li>
                                    <li><a href="#">+911234567890</a></li>
                                    <li><a href="#">spizy@hotel.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="bold-separator">
                            <span></span>
                        </div>
                </section>
                <section style="padding-top: 10px;">
                    <div class="triangle-decor"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h3>Get in Touch</h3>
                                    <h4 class="decor-title">Write us</h4>
                                    <div class="separator color-separator"></div>
                                </div>
                                <div class="contact-form-holder">
                                    <div id="contact-form">
                                        <div id="message2"></div>
                                        <div id="contactform">
                                            <input  type="text" class="name" onClick="this.select()" placeholder="Name">
                                            <input  type="text" class="email" onClick="this.select()" placeholder="E-mail">
                                            <input  type="tel" class="phone" onClick="this.select()" placeholder="Phone">
                                            <textarea class="comments" onClick="this.select()" placeholder="Message"></textarea>
                                            <button type="button" id="submit">Send </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
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
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
<script>
    $('document').ready(function(){
        setTimeout(() => {
            pload();
        }, 2000);
    })

    $('#submit').on('click',function(){
        var name = $('.name').val();
        var email = $('.email').val();
        var phone = $('.phone').val();
        var comments = $('.comments').val();
        var submit_contact = true;
        var ajax_request = true;
        var user_active_id = <?php echo $user_active_id?>;
        if(name != '' && email != '' && phone !='' && comments !=''){
            $.ajax({
                url: 'ajax_files/contact/operations.php',
                type: 'POST',
                data: {
                    ajax_request: ajax_request,
                    submit_contact: submit_contact,
                    name: name,
                    email: email,
                    phone: phone,
                    comments: comments,
                    user_active_id: user_active_id
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
                icon: 'error',
                title: 'Incorrect Details',
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