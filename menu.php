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
$non_veg_query = mysqli_query($spizy_db_con,'SELECT * FROM menu_data WHERE category = "Non-Veg" ORDER BY RAND() LIMIT 8');
$veg_query = mysqli_query($spizy_db_con,'SELECT * FROM menu_data WHERE category = "Veg" ORDER BY RAND() LIMIT 8');
$dessert_query = mysqli_query($spizy_db_con,'SELECT * FROM menu_data WHERE category = "Dessert" ORDER BY RAND() LIMIT 8');
$drink_query = mysqli_query($spizy_db_con,'SELECT * FROM menu_data WHERE category = "Drinks" ORDER BY RAND() LIMIT 8');
$hot_dishes_query = mysqli_query($spizy_db_con,'SELECT * FROM menu_data WHERE category = "Hot-Dishes" ORDER BY RAND()');
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>Spizy | Menu</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    <?php
        if($_SESSION['user_active'] == True){
            echo "<script>  
            Swal.fire({
                icon: 'success',
                title: 'Session Active',
                position: 'top-end',
                toast: true,
                padding: '0.3em',
                showConfirmButton: false,
                timer: 3000,
                background: 'rgba(255, 255, 255, 1)'
                });
            </script>";
        }
    ?>
    <div class="modal fade" id="get_plate_details_ajax_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal-border">
                <div class="modal-header custom_modal_text_head">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <div type="button" class="close">
                        <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
                    </div>
                </div>
                <div class="modal-body get_plate_details_ajax_response">

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn custom-button-sm confirm_dish_detail">Confirm</button>
                    <button type="button" class="btn custom-button-sm" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="user_login_register_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal-border">
                <div class="modal-header custom_modal_text_head">
                    <h5 class="modal-title" id="staticBackdropLabel">Let us Know About Yourself !!!</h5>
                    <div type="button" class="close">
                        <i class="far fa-times-circle" data-dismiss="modal" aria-label="Close"></i>
                    </div>
                </div>
                <div class="modal-body get_plate_details_ajax_response">
                    <ul class="nav justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" style="margin:0 20px" ; role="presentation">
                            <a class="nav-link active btn custom-button-sm" id="pills-login-tab" data-toggle="pill"
                                href="#pills-login" role="tab" aria-controls="pills-login"
                                aria-selected="true">Login</a>
                        </li>
                        <li class="nav-item" style="margin:0 20px" ; role="presentation">
                            <a class="nav-link btn custom-button-sm" id="pills-register-tab" data-toggle="pill"
                                href="#pills-register" role="tab" aria-controls="pills-register"
                                aria-selected="false">Register</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-0" style="display:block !important" ; id="pills-tabContent">
                        <div class="tab-pane fade register_tab" id="pills-register" role="tabpanel"
                            aria-labelledby="pills-register-tab">
                            <div class="login_register-form-holder">
                                <div class="mt-4" id="login_register-form">
                                    <input type="text" class="register_name" placeholder="Name">
                                    <input type="text" class="register_email" placeholder="E-mail">
                                    <input type="password" class="register_password" placeholder="Password">
                                    <textarea type="text" class="register_address" placeholder="Address"></textarea>
                                    <button type="button" id="register_button"
                                        class="btn custom-button-sm">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active login_tab" id="pills-login" role="tabpanel"
                            aria-labelledby="pills-login-tab">
                            <div class="login_register-form-holder">
                                <div class="mt-4" id="login_register-form">
                                    <input type="text" class="login_email" placeholder="E-mail">
                                    <input type="password" class="login_password" placeholder="Password" value=''>
                                    <button type="button" id="login_button" class="btn custom-button-sm">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="loader">
        <?php include('loader.php');?>
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
                                <li><a href="menu.php" class="act-link">Menu</a>
                                    <!-- Menu Drop Down -->
                                    <ul>
                                        <li><a href="veg-menu.php">Veg</a></li>
                                        <li><a href="non-veg-menu.php">Non-Veg</a></li>
                                        <li><a href="desert-menu.php">Desert</a></li>
                                        <li><a href="drinks-menu.php">Drinks</a></li>
                                    </ul>
                                </li>
                                <!-- <li><a href="gallery.php">Gallery</a></li> -->
                                <!-- <li><a href="dine-in.php">Dine-In</a></li>
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
                <section class="parallax-section header-section">
                    <div class="bg bg-parallax" style="background-image:url(images/bg/14.jpg)"
                        data-top-bottom="transform: translateY(300px);"
                        data-bottom-top="transform: translateY(-300px);"></div>
                    <div class="overlay"></div>
                    <div class="container">
                        <h2>Hot dishes</h2>
                        <h3></h3>
                    </div>
                </section>
                <section>
                    <div class="triangle-decor"></div>
                    <div class="menu-bg lbd" style="background-image:url(images/menu/1.png)"
                        data-top-bottom="transform: translateX(200px);"
                        data-bottom-top="transform: translateX(-200px);">
                    </div>
                    <div class="container">
                        <div class="separator color-separator"></div>
                        <div class="menu-holder">
                            <div class="row">
                                <?php
                                if($hot_dishes_query){
                                    while ($hot_dishes_query_array = mysqli_fetch_array($hot_dishes_query)){
                                        echo '<div class="col-md-6 mb-2">
                                                <div class="menu-item menu-item-border">
                                                    <div class="menu-item-details">
                                                        <div class="menu-item-desc">'.$hot_dishes_query_array['name'].'</div>
                                                        <div class="handle-menu-allign">
                                                        <div class="menu-item-prices">
                                                            <div class="menu-item-price">&#8377;'.$hot_dishes_query_array['price'].'</div>
                                                        </div>
                                                        <button class="add-to-cart-button-sm" onclick="add_to_cart('.$hot_dishes_query_array['id'].')"><i class="fas fa-plus-square"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="bold-separator">
                            <span></span>
                        </div>
                    </div>
                </section>
                <section class="parallax-section">
                    <div class="bg bg-parallax" style="background-image:url(images/bg/8.jpg)"
                        data-top-bottom="transform: translateY(300px);"
                        data-bottom-top="transform: translateY(-300px);"></div>
                    <div class="overlay"></div>
                    <div class="container">
                        <h2>Non Veg</h2>
                        <h3></h3>
                    </div>
                </section>
                <section>
                    <div class="triangle-decor"></div>
                    <div class="menu-bg rbd" style="background-image:url(images/menu/1.png)"
                        data-top-bottom="transform: translateX(-200px);"
                        data-bottom-top="transform: translateX(200px);">
                    </div>
                    <div class="container">
                        <div class="separator color-separator"></div>
                        <div class="menu-holder">
                            <div class="row">
                                <?php
                                if($non_veg_query){
                                    while ($non_veg_query_array = mysqli_fetch_array($non_veg_query)){
                                        echo '<div class="col-md-6 mb-2">
                                                <div class="menu-item">
                                                    <div class="menu-item-details menu-item-border">
                                                        <div class="menu-item-desc">'.$non_veg_query_array['name'].'</div>
                                                        <div class="handle-menu-allign">
                                                        <div class="menu-item-prices">
                                                            <div class="menu-item-price">&#8377;'.$non_veg_query_array['price'].'</div>
                                                        </div>
                                                        <button class="add-to-cart-button-sm" onclick="add_to_cart('.$non_veg_query_array['id'].')"><i class="fas fa-plus-square"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="bold-separator">
                            <span></span>
                        </div>
                    </div>
                    <a href="non-veg-menu.php"><button class="custom-button">Explore</button></a>
                </section>
                <section class="parallax-section">
                    <div class="bg bg-parallax" style="background-image:url(images/bg/4.jpg)"
                        data-top-bottom="transform: translateY(300px);"
                        data-bottom-top="transform: translateY(-300px);"></div>
                    <div class="overlay"></div>
                    <div class="container">
                        <h2>Veg Dishes</h2>
                        <h3></h3>
                    </div>
                </section>
                <section>
                    <div class="triangle-decor"></div>
                    <div class="menu-bg lbd" style="background-image:url(images/menu/1.png)"
                        data-top-bottom="transform: translateX(200px);"
                        data-bottom-top="transform: translateX(-200px);">
                    </div>
                    <div class="container">
                        <div class="separator color-separator"></div>
                        <div class="menu-holder">
                            <div class="row">
                                <?php
                                if($veg_query){
                                    while ($veg_query_array = mysqli_fetch_array($veg_query)){
                                        echo '<div class="col-md-6 mb-2">
                                                <div class="menu-item menu-item-border">
                                                    <div class="menu-item-details">
                                                        <div class="menu-item-desc">'.$veg_query_array['name'].'</div>
                                                        <div class="handle-menu-allign">
                                                        <div class="menu-item-prices">
                                                            <div class="menu-item-price">&#8377;'.$veg_query_array['price'].'</div>
                                                        </div>
                                                        <button class="add-to-cart-button-sm" onclick="add_to_cart('.$veg_query_array['id'].')"><i class="fas fa-plus-square"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="bold-separator">
                            <span></span>
                        </div>
                    </div>
                    <a href="veg-menu.php"><button class="custom-button">Explore</button></a>
                </section>
                <section class="parallax-section">
                    <div class="bg bg-parallax" style="background-image:url(images/bg/11.jpg)"
                        data-top-bottom="transform: translateY(300px);"
                        data-bottom-top="transform: translateY(-300px);"></div>
                    <div class="overlay"></div>
                    <div class="container">
                        <h2>Dessert</h2>
                        <h3></h3>
                        <div class="bold-separator">
                            <span></span>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="triangle-decor"></div>
                    <div class="menu-bg rbd" style="background-image:url(images/menu/2.png)"
                        data-top-bottom="transform: translateX(-200px);"
                        data-bottom-top="transform: translateX(200px);"></div>
                    <div class="container">
                        <div class="separator color-separator"></div>
                        <div class="menu-holder">
                            <div class="row">
                                <?php
                                if($dessert_query){
                                    while ($dessert_query_array = mysqli_fetch_array($dessert_query)){
                                        echo '<div class="col-md-6 mb-2">
                                                <div class="menu-item menu-item-border">
                                                    <div class="menu-item-details">
                                                        <div class="menu-item-desc">'.$dessert_query_array['name'].'</div>
                                                        <div class="handle-menu-allign">
                                                        <div class="menu-item-prices">
                                                            <div class="menu-item-price">&#8377;'.$dessert_query_array['price'].'</div>
                                                        </div>
                                                        <button class="add-to-cart-button-sm" onclick="add_to_cart('.$dessert_query_array['id'].')"><i class="fas fa-plus-square"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="bold-separator">
                            <span></span>
                        </div>
                    </div>
                    <a href="desert-menu.php"><button class="custom-button">Explore</button></a>
                </section>
                <section class="parallax-section">
                    <div class="bg bg-parallax"
                        style="background-image:url(images/bg/20.jpg)"
                        data-top-bottom="transform: translateY(300px);"
                        data-bottom-top="transform: translateY(-300px);"></div>
                    <div class="overlay"></div>
                    <div class="container">
                        <h2>Drinks </h2>
                        <h3></h3>
                        <div class="bold-separator">
                            <span></span>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="triangle-decor"></div>
                    <div class="menu-bg lbd"
                        style="background-image:url(images/menu/2.png)"
                        data-top-bottom="transform: translateX(200px);"
                        data-bottom-top="transform: translateX(-200px);">
                    </div>
                    <div class="container">
                        <div class="separator color-separator"></div>
                        <div class="menu-holder">
                            <div class="row">
                                <?php
                                if($drink_query){
                                    while ($drink_query_array = mysqli_fetch_array($drink_query)){
                                        echo '<div class="col-md-6 mb-2">
                                                <div class="menu-item menu-item-border">
                                                    <div class="menu-item-details">
                                                        <div class="menu-item-desc">'.$drink_query_array['name'].'</div>
                                                        <div class="handle-menu-allign">
                                                            <div class="menu-item-prices">
                                                                <div class="menu-item-price">&#8377;'.$drink_query_array['price'].'</div>
                                                            </div>
                                                            <button type="button" class="add-to-cart-button-sm" onclick="add_to_cart('.$drink_query_array['id'].')"><i class="fas fa-plus-square"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="bold-separator">
                            <span></span>
                        </div>
                    </div>
                    <a href="drinks-menu.php"><button class="custom-button">Explore</button></a>
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

        $('#register_button').on("click", function () {
            var register_name = $('.register_name').val();
            var register_email = $('.register_email').val();
            var register_password = $('.register_password').val();
            var register_address = $('.register_address').val();
            if (register_name != '' && register_email != '' && register_address != '' && register_password != '') {
                var atposition = register_email.indexOf("@");
                var dotposition = register_email.lastIndexOf(".");
                if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= register_email.length) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Incorrect Email',
                        position: 'top-end',
                        toast: true,
                        padding: '0.3em',
                        showConfirmButton: false,
                        timer: 3000,
                        background: 'rgba(255, 255, 255, 1)'
                    });
                } else if (register_password.length < 8) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Less than 8 Characters',
                        position: 'top-end',
                        toast: true,
                        padding: '0.3em',
                        showConfirmButton: false,
                        timer: 3000,
                        background: 'rgba(255, 255, 255, 1)'
                    });
                } else {
                    var ajax_request = true;
                    var register_user = true;
                    $.ajax({
                        url: 'ajax_files/login-register/operations.php',
                        type: 'POST',
                        data: {
                            ajax_request: ajax_request,
                            register_user: register_user,
                            register_name: register_name,
                            register_email: register_email,
                            register_password: register_password,
                            register_address: register_address
                        },
                        beforeSend: function () {
                            $('#user_login_register_modal').css("opacity", 0);
                            ajax_start();
                        },
                        complete: function () {
                            ajax_complete();
                        },
                        success: function (response) {
                            $("#user_login_register_modal").modal("hide");
                            $('#user_login_register_modal').css("opacity", 1);
                            $('#main').append(response);
                        }
                    })
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect Parameter',
                    position: 'top-end',
                    toast: true,
                    padding: '0.3em',
                    showConfirmButton: false,
                    timer: 3000,
                    background: 'rgba(255, 255, 255, 1)'
                });
            }
        })

        $('#login_button').on("click", function () {
            var login_email = $('.login_email').val();
            var login_password = $('.login_password').val();
            if (login_email != '' && login_password != '') {
                var ajax_request = true;
                var login_user = true;
                $.ajax({
                    url: 'ajax_files/login-register/operations.php',
                    type: 'POST',
                    data: {
                        ajax_request: ajax_request,
                        login_user: login_user,
                        login_email: login_email,
                        login_password: login_password,
                    },
                    beforeSend: function () {
                        $('#user_login_register_modal').css("opacity", 0);
                        ajax_start();
                    },
                    complete: function () {
                        ajax_complete();
                    },
                    success: function (response) {
                        $("#user_login_register_modal").modal("hide");
                        $('#main').append(response);
                        window.open('index.php', '_parent');
                    }
                })
            }
        })

        $('.confirm_dish_detail').on("click",function(){
            var ajax_dish_id = $('#active_dish_id').val();
            var ajax_dish_quantity = $('#active_dish_quantity').val();
            var ajax_dish_amount = $('#active_dish_price_hidden').val();
            var ajax_request = true;
            var confirm_dish_details = true;
            $.ajax({
                url: 'ajax_files/menu_operations/main_page_opr.php',
                type: 'POST',
                data: {
                    ajax_request: ajax_request,
                    confirm_dish_details : confirm_dish_details,
                    ajax_dish_id: ajax_dish_id,
                    ajax_dish_quantity: ajax_dish_quantity,
                    ajax_dish_amount : ajax_dish_amount
                },
                beforeSend: function () {
                    ajax_start();
                },
                complete: function () {
                    ajax_complete();
                },
                success: function (response) {
                    $('#main').append(response);
                    $('#get_plate_details_ajax_modal').css("opacity", 0);
                    setTimeout(() => {
                        $('#get_plate_details_ajax_modal').modal('hide');
                        $('#get_plate_details_ajax_modal').css("opacity", 1);
                    }, 1500);
                }
            })
        })
    })
</script>
<script>
    function add_to_cart(dish_id) {
        var check_user_state = '<?php echo $user_active ?>';
        if (check_user_state == "True") {
            var ajax_request = true;
            var get_plate_details = true;
            var ajax_dish_id = dish_id;
            $.ajax({
                url: 'ajax_files/menu_operations/main_page_opr.php',
                type: 'POST',
                data: {
                    ajax_request: ajax_request,
                    ajax_dish_id: ajax_dish_id,
                    get_plate_details: get_plate_details
                },
                beforeSend: function () {
                    ajax_start();
                },
                complete: function () {
                    ajax_complete();
                },
                success: function (response) {
                    $('.get_plate_details_ajax_response').html(response);
                    setTimeout(() => {
                        $('#get_plate_details_ajax_modal').modal('show');
                    }, 1500);
                    function calculate(){
                        var new_quantity = parseInt($('#active_dish_quantity').val());
                        var initial_price = parseInt($('#active_dish_price_static').val());
                        var dummy = new_quantity * initial_price;
                        $('#active_dish_price').html("&#8377;"+dummy);
                        $('#active_dish_price_hidden').val(dummy)
                    }
                    function minus_dish() {
                        var quantity = $('#active_dish_quantity').val();
                        if(quantity <= 1){
                            Swal.fire({
                            icon: 'warning',
                            title: 'Minimum Value',
                            position: 'top-end',
                            toast: true,
                            padding: '0.3em',
                            showConfirmButton: false,
                            timer: 3000,
                            background: 'rgba(255, 255, 255, 1)'
                            });
                            $('#active_dish_quantity').val(1)
                        }else{
                            var dummy = parseInt(quantity) - 1
                            $('#active_dish_quantity').val(dummy)
                        }
                    }
                    function plus_dish() {
                        var quantity = $('#active_dish_quantity').val();
                        if(quantity >= 10){
                            Swal.fire({
                            icon: 'warning',
                            title: 'Maximum Value',
                            position: 'top-end',
                            toast: true,
                            padding: '0.3em',
                            showConfirmButton: false,
                            timer: 3000,
                            background: 'rgba(255, 255, 255, 1)'
                            });
                            $('#active_dish_quantity').val(10)
                        }else{
                            var dummy = parseInt(quantity) + 1
                            $('#active_dish_quantity').val(dummy)
                        }
                    }
                    $('#minus_dish').on("click", minus_dish)
                    $('#minus_dish').on("click", calculate)
                    $('#plus_dish').on("click", plus_dish)
                    $('#plus_dish').on("click", calculate)
                    $('#active_dish_quantity').keyup(function(){
                        var quantity = $('#active_dish_quantity').val();
                        if (quantity > 10){
                            Swal.fire({
                            icon: 'warning',
                            title: 'Maximum Value',
                            position: 'top-end',
                            toast: true,
                            padding: '0.3em',
                            showConfirmButton: false,
                            timer: 3000,
                            background: 'rgba(255, 255, 255, 1)'
                            });
                            $('#active_dish_quantity').val(10)
                        }else if(quantity < 1){
                            Swal.fire({
                            icon: 'warning',
                            title: 'Minimum Value',
                            position: 'top-end',
                            toast: true,
                            padding: '0.3em',
                            showConfirmButton: false,
                            timer: 3000,
                            background: 'rgba(255, 255, 255, 1)'
                            });
                            $('#active_dish_quantity').val(1)
                        }
                    })
                }
            })
        } else {
            $('#user_login_register_modal').modal('show');
        }
    }
</script>

</html>