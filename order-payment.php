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
$total_amount = $query_array['total_amount'];
$grand_amount = $total_amount + 50;
if(isset($_GET['order_id']) && $_SESSION['user_active'] == True && $query_array > 0){
$order_id = $_GET['order_id'];
?>
<!DOCTYPE HTML>
<html lang="en">


<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>Spizy | Order Payment</title>
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
        <!--=============== wrapper ===============-->
        <div id="wrapper">
            <div class="content d-flex justify-content-center flex-column" style="min-height:100vh !important;">
                <!--=============== reservation ===============-->
                <section style="padding:40px 0px">
                    <div class="triangle-decor"></div>
                    <div class="container shadow rounded-3">
                        <div class="row" style="padding:50px 0px; min-height:70vh">
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="col-md-10">
                                    <div id="reservation-form">
                                        <div class="row">
                                            <div class="center-block">
                                                <h3 style="text-align:center;">Payment Details</h3>
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label class="custome-form-label" for="">First Name</label>
                                                        <input type="text" id="fname" class="fname"
                                                            placeholder="First Name" onClick="this.select()">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label class="custome-form-label" for="">Last Name</label>
                                                        <input type="text" id="lname" class="lname"
                                                            placeholder="Last Name" onClick="this.select()">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        <label class="custome-form-label" for="">Card Number</label>
                                                        <input type="number" class="c-num" placeholder="Card Number" onClick="this.select()">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 form-group">
                                                        <label class="custome-form-label" for="">CVV</label>
                                                        <input type="number" class="cvv"
                                                            placeholder="CVV" onClick="this.select()">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label class="custome-form-label" for="">Month</label>
                                                        <select id="numperson" class="mon form-control">
                                                            <option value="0" selected>Month</option>
                                                            <option value="">Jan</option>
                                                            <option value="">Feb</option>
                                                            <option value="">Mar</option>
                                                            <option value="">Apr</option>
                                                            <option value="">May</option>
                                                            <option value="">Jun</option>
                                                            <option value="">Jul</option>
                                                            <option value="">Aug</option>
                                                            <option value="">Sep</option>
                                                            <option value="">Oct</option>
                                                            <option value="">Nov</option>
                                                            <option value="">Dec</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label class="custome-form-label" for="">Year</label>
                                                        <select id="numperson" class="year form-control">
                                                            <option value="0" selected>Year</option>
                                                            <option value="">2021</option>
                                                            <option value="">2022</option>
                                                            <option value="">2023</option>
                                                            <option value="">2024</option>
                                                            <option value="">2025</option>
                                                            <option value="">2026</option>
                                                            <option value="">2027</option>
                                                            <option value="">2028</option>
                                                            <option value="">2029</option>
                                                            <option value="">2030</option>
                                                            <option value="">2031</option>
                                                            <option value="">2032</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-4 d-flex justify-content-center">
                                <div style="margin:0px 30px" class="col-md-8">
                                    <div class="section-title" style="margin-bottom:10px;">
                                        <h4 class="p-0">Order information</h4>
                                    </div>
                                    <section style="padding:20px 0px;">
                                        <div class="container w-auto p-1">
                                            <!-- CHECKOUT TABLE -->
                                            <div class="row">
                                                <table class="table table-border checkout-table">
                                                    <tbody>
                                                        <tr>
                                                            <th class="order-quantity">Cart Subtotal:</th>
                                                            <td class="order-quantity cart_subtotal">₹<?php echo $total_amount;?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="order-quantity">Shipping Total:</th>
                                                            <td class="order-quantity cart_shipping">₹50</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="order-quantity">Total:</th>
                                                            <td class="order-quantity cart_grand_total">₹<?php echo $grand_amount;?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <button class="w-auto m-auto payment_submit btn custom-button" style="margin-top:20px;">Confirm Order</button>
                        </div>
                    </div>
                </section>
                <!--section end-->
            </div>
            <!--content end-->
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

        $('.payment_submit').on('click',function(){
            var fname = $('.fname').val();
            var lname = $('.lname').val();
            var cnum = $('.c-num').val();
            var cvv = $('.cvv').val();
            var cvvlen = cvv.length;
            var mon = $('.mon').val();
            var year = $('.year').val();
            var ajax_request = true;
            var order_id = <?php echo $order_id?>;
            var total = <?php echo $grand_amount?>;
            var payment_success = true;
            if(fname != '' && lname != '' && cnum !='' && cvvlen == 3 && cvv !='' && mon == '' && year == ''){
                $.ajax({
                    url: 'ajax_files/order_payments/operations.php',
                    type: 'POST',
                    data: {
                        ajax_request: ajax_request,
                        payment_success: payment_success,
                        fname: fname,
                        lname: lname,
                        cnum: cnum,
                        total : total,
                        order_id: order_id
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
    })
</script>

</html>
<?php
}
else{
    echo "<script>window.open('index.php','_parent');</script>";
}?>