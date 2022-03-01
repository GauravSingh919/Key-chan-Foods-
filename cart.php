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
    echo "<script>window.open('index.php','_parent')</script>";
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>Spizy | Cart</title>
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
                                <li><a href="contact.php">Contact</a></li>
                                <?php
                                    if($_SESSION['user_active'] == True)
                                    {
                                        echo "<li><a href='cart.php' class='act-link'>Cart</a></li>";
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
                    <div class="bg bg-parallax" style="background-image:url(images/bg/21.jpg)"
                        data-top-bottom="transform: translateY(300px);"
                        data-bottom-top="transform: translateY(-300px);"></div>
                    <div class="overlay"></div>
                    <div class="container">
                        <h2>Your cart</h2>
                        <h3>Ordering Online is Easy</h3>
                    </div>
                </section>
                <section>
                    <div class="triangle-decor"></div>
                    <div class="container">
                        <!-- CHECKOUT TABLE -->
                        <div class="row">
                            <div class="ajax_response" style="padding:0px;"></div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-sm-5">
                                <div class="cart-totals">
                                    <h4>Cart Totals</h4>
                                    <table class="table table-border checkout-table">
                                        <tbody>
                                            <tr>
                                                <th class="order-quantity">Cart Subtotal:</th>
                                                <td class="order-quantity cart_subtotal"></td>
                                            </tr>
                                            <tr>
                                                <th class="order-quantity">Shipping Total:</th>
                                                <td class="order-quantity cart_shipping"></td>
                                            </tr>
                                            <tr>
                                                <th class="order-quantity">Total:</th>
                                                <td class="order-quantity cart_grand_total"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn custom-button-sm" onclick= 'dine_in_call()' style="margin-right:5px;">Dine-In</button>
                                        <button type="button" class="btn custom-button-sm" onclick='door_bell_call()' style="margin-left:5px;">Get It Delivered</button>
                                </div>
                            </div>
                        </div>
                        <!-- /CART TOTALS  -->
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
    function ajax_cart_call() {
        var ajax_request = true;
        var get_cart_details = true;
        $.ajax({
            url: 'ajax_files/cart_operations/cart_main_page.php',
            type: 'POST',
            data: {
                ajax_request: ajax_request,
                get_cart_details: get_cart_details
            },
            beforeSend: function () {
                ajax_start();
            },
            complete: function () {
                ajax_complete();
            },
            success: function (response) {
                $('.ajax_response').html(response);
                var subtotal = $('.hidden_total_amount').val();
                $('.cart_subtotal').html('&#8377;'+subtotal);
                var dummy = parseInt(subtotal);
                if (dummy < 1){
                    $('.cart_shipping').html('&#8377;'+0);
                    $('.cart_grand_total').html('&#8377;'+0);
                }else{
                var dummy = parseInt(subtotal)
                var grand_total = dummy + 50;
                $('.cart_shipping').html('&#8377;'+50);
                $('.cart_grand_total').html('&#8377;'+grand_total);
                }
            }
        })
    }

    function remove_dish(cart_id){
        var ajax_request = true;
        var remove_dish = true;
        var cart_id = cart_id;
        $.ajax({
            url: 'ajax_files/cart_operations/cart_main_page.php',
            type: 'POST',
            data: {
                ajax_request: ajax_request,
                remove_dish: remove_dish,
                cart_id : cart_id
            },
            beforeSend: function () {
                ajax_start();
            },
            complete: function () {
                ajax_complete();
            },
            success: function (response) {
                $('#main').append(response)
                ajax_cart_call();
                var subtotal = $('.hidden_total_amount').val();
                $('.cart_subtotal').html('&#8377;'+subtotal);
                var dummy = parseInt(subtotal);
                if (dummy < 1){
                    $('.cart_shipping').html('&#8377;'+0);
                    $('.cart_grand_total').html('&#8377;'+0);
                }else{
                var dummy = parseInt(subtotal)
                var grand_total = dummy + 50;
                $('.cart_shipping').html('&#8377;'+50);
                $('.cart_grand_total').html('&#8377;'+grand_total);
                }
            }
        })
    }

    function delivery_submit(){
        var dish_id_array = [];
        $('.hidden_dish_id').each(function() { 
            dish_id_array.push($(this).val());
        });
        var dish_quantity_array = [];
        $('.hidden_dish_quantity').each(function() { 
            dish_quantity_array.push($(this).val());
        });
        var dish_id_array_proper = JSON.stringify(dish_id_array);
        var dish_quantity_array_proper = JSON.stringify(dish_quantity_array);
        var ajax_request = true;
        var generate_order = true;
        var total_amount = $('.hidden_total_amount').val();
        $.ajax({
            url: 'ajax_files/cart_operations/cart_main_page.php',
            type: 'POST',
            data: {
                ajax_request: ajax_request,
                generate_order: generate_order,
                total_amount : total_amount,
                dish_id_array_proper: dish_id_array_proper,
                dish_quantity_array_proper : dish_quantity_array_proper
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
    }

    function dine_in_submit(){
        var dish_id_array = [];
        $('.hidden_dish_id').each(function() { 
            dish_id_array.push($(this).val());
        });
        var dish_quantity_array = [];
        $('.hidden_dish_quantity').each(function() { 
            dish_quantity_array.push($(this).val());
        });
        var dish_id_array_proper = JSON.stringify(dish_id_array);
        var dish_quantity_array_proper = JSON.stringify(dish_quantity_array);
        var ajax_request = true;
        var generate_order_dinein = true;
        var total_amount = $('.hidden_total_amount').val();
        $.ajax({
            url: 'ajax_files/cart_operations/cart_main_page.php',
            type: 'POST',
            data: {
                ajax_request: ajax_request,
                generate_order_dinein : generate_order_dinein,
                total_amount : total_amount,
                dish_id_array_proper: dish_id_array_proper,
                dish_quantity_array_proper : dish_quantity_array_proper
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
    }

    function dine_in_call(){
        var subtotal = $('.hidden_total_amount').val();
            if(subtotal > 0)
                {
                    dine_in_submit();
                }
            else
                {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Cart is Empty',
                        position: 'top-end',
                        toast: true,
                        padding: '0.3em',
                        showConfirmButton: false,
                        timer: 3000,
                        background: 'rgba(255, 255, 255, 1)'
                    });
                }
    }

    function  door_bell_call(){
        var subtotal = $('.hidden_total_amount').val();
            if(subtotal > 0)
                {
                    delivery_submit();
                }
            else
                {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Cart is Empty',
                        position: 'top-end',
                        toast: true,
                        padding: '0.3em',
                        showConfirmButton: false,
                        timer: 3000,
                        background: 'rgba(255, 255, 255, 1)'
                    });
                }
    }


    $('document').ready(function () {
        ajax_cart_call();
    })

</script>

</html>