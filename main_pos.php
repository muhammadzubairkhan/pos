<?php

include("include/dbconnect.php");
include_once "include/session.php";

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Point of Sales</title>

        <link rel="icon" type="image/png" href="icons/mobile-dashboard-icon.png">

        <!-- Material Design Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- jQUERY -->
        <script src="js/jquery.min.js"></script>


<style type="text/css">
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}


/* Basic reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;

  /* Better text styling */
  font: bold 14px Arial, sans-serif;
}

/* Finally adding some IE9 fallbacks for gradients to finish things up */

/* A nice BG gradient */
html {
  height: 100%;
  background: white;
  background: radial-gradient(circle, #fff 20%, #ccc);
  background-size: cover;
}

/* Using box shadows to create 3D effects */
#calculator {
  width: auto;
  height: auto;


  padding: 20px 20px 9px;

/*  background: #9dd2ea;*/
  background: #949391;
  border-radius: 3px;
}

/* Top portion */
.top span.clear {
  float: left;
}

/* Inset shadow on the screen to create indent */
.top .screen {
  height: 40px;
  width: 212px;

  float: right;

  padding: 0 10px;

  background: rgba(0, 0, 0, 0.2);
  border-radius: 3px;
  box-shadow: inset 0px 4px rgba(0, 0, 0, 0.2);

  /* Typography */
  font-size: 17px;
  line-height: 40px;
  color: white;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
  text-align: right;
  letter-spacing: 1px;
}

/* Clear floats */
.keys, .top {overflow: hidden;}

/* Applying same to the keys */
.keys span, .top span.clear {
  float: left;
  position: relative;
  top: 0;

  cursor: pointer;

  width: 66px;
  height: 36px;

  background: white;
  border-radius: 3px;
  box-shadow: 0px 4px rgba(0, 0, 0, 0.2);

  margin: 0 7px 11px 0;

  color: #888;
  line-height: 36px;
  text-align: center;

  /* prevent selection of text inside keys */
  user-select: none;

  /* Smoothing out hover and active states using css3 transitions */
  transition: all 0.2s ease;
}

/* Remove right margins from operator keys */
/* style different type of keys (operators/evaluate/clear) differently */
.keys span.operator {
  background: #d2d3d7;
  margin-right: 0;
}

.keys span.eval {
  background: #f7ae43;
  color: #888e5f;
}


.top span.clear {
  background: #ff9fa8;
  box-shadow: 0px 4px #ff7c87;
  color: white;
}

/* Some hover effects */
.keys span:hover {
  background: #9c89f6;
  box-shadow: 0px 4px #6b54d3;
  color: white;
}

.keys span.eval:hover {
  background: #abb850;
  box-shadow: 0px 4px #717a33;
  color: #ffffff;
}

.top span.clear:hover {
  background: #f68991;
  box-shadow: 0px 4px #d3545d;
  color: white;
}

/* Simulating "pressed" effect on active state of the keys by removing the box-shadow and moving the keys down a bit */
.keys span:active {
  box-shadow: 0px 0px #6b54d3;
  top: 4px;
}

.keys span.eval:active {
  box-shadow: 0px 0px #717a33;
  top: 4px;
}

.top span.clear:active {
  top: 4px;
  box-shadow: 0px 0px #d3545d;
}


        </style>




<style type="text/css">

            .hidden
            {
                display:none;
            }
            .disabledbutton {
                pointer-events: none;
                opacity: 0.4;
            }

             .active_service
             {
                 background-color:azure !important;
                 color: lightgray;
             }

             .free_service
             {
                 background-color:antiquewhite!important;

             }

             .waiting_service
             {
                 background-color:yellow !important;
             }

             .tender_service
             {
                 background-color:black !important;
                 color:white;
             }

             .hidethis
             {
                 display: none;
             }

             .table-header
             {

                 background-color: #4CAF50 !important;
                 color: white;
             }

             .table-header::-webkit-scrollbar {
                display: none;
             }

             .ordered-items:hover
             {
                 background-color: #f2f2f2 !important;
             }

             .border-right
             {
                 border-right: 1px solid gray;
             }

             .list-group-item-heading
             {
                 text-align: center !important;
             }

             .center-text
             {
                 text-align: center !important;
             }

             .price-right-align
             {
                 text-align: right !important;
             }

             /* Error Message CSS */

             /*#error_message
             {
                font-size: 12px;
                font-weight: normal;
                border: 1px solid red;
                border-radius: 2px;
                padding: 10px;
             }*/

            .overlay
            {
                background: black;
                opacity: .5;
                position:fixed;
                top:0px;
                bottom:0px;
                left:0px;
                right:0px;
                z-index:100;
            }

            .box
            {
                position:fixed;
                top:30%;
                left:30%;
                right:30%;
                background-color:#fff;
                color:#7F7F7F;
                padding:20px;
                border:2px solid #ccc;
                -moz-border-radius: 20px;
                -webkit-border-radius:20px;
                -khtml-border-radius:20px;
                -moz-box-shadow: 0 1px 5px #333;
                -webkit-box-shadow: 0 1px 5px #333;
                z-index:101;
            }

            a.boxclose
            {
                float:right;
                width:26px;
                height:26px;
                background:transparent url(http://tympanus.net/Tutorials/CSSOverlay/images/cancel.png) repeat top left;
                margin-top:-30px;
                margin-right:-30px;
                cursor:pointer;
            }

            .box h1
            {
                border-bottom: 1px dashed #7F7F7F;
                margin:-20px -20px 0px -20px;
                padding:10px;
                background-color:#FFEFEF;
                color:#EF7777;
                -moz-border-radius:20px 20px 0px 0px;
                -webkit-border-top-left-radius: 20px;
                -webkit-border-top-right-radius: 20px;
                -khtml-border-top-left-radius: 20px;
                -khtml-border-top-right-radius: 20px;
            }

            #error_message
            {
                padding: 20px 0px 0px 0px;
            }

            #activator
            {
                font-size: 8px;
                text-decoration: none;
                color: black;
            }

            .hide_error
            {
                display: none;
            }

            .display_error
            {
                display: block;
            }


        </style>

        <script type="text/javascript" src="scripts/pos_scripts.js"></script>

        <script type="text/javascript">

            $(document).on('keyup',function(evt)
            {
                try
                {

                    var status;

//                    if (evt.keyCode == 27)
//                    {
//                       $('#box').animate({'top':'-200px'},500,function()
//                       {
//                          $('#overlay').fadeOut('fast');
//                       });
//                    }
//
                    if (evt.keyCode == 112)
                    {
                       startPeriod();
                    }
//
                    if (evt.keyCode == 113)
                    {
                       endPeriod();
                    }
//
                    if (evt.keyCode == 114)
                    {
                       newOrder();
                    }
//
//                    if (evt.keyCode == 83)
//                    {
//                       submitorder();
//                    }
//
//                    if (evt.keyCode == 84)
//                    {
//                       tender();
//                    }
//
//                    if (evt.keyCode == 69)
//                    {
//                       showErrorMessageToUser();
//                    }
//
//                    if (evt.keyCode == 72)
//                    {
//                       hideErrorMessageFromUser();
//                    }
                }
                catch(err)
                {
                    document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
                    console.log("Error Trace: "+ err.stack);
                }
            });

        </script>


    </head>

<body>

<div id="wrapper">
<!-- Page Content -->

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

       <!-- HEADER SECTION -->
<div class="navbar-header">

</div>


<!-- Top Navigation: Left Menu -->

<ul class="nav navbar-nav navbar-left navbar-top-links">
    <li><a href="javascript:void(0);"><i class="fa fa-home fa-fw"></i> Home</a></li>
</ul>

        <button type="submit" id="start_btn" onclick="startPeriod();" class="btn btn-sm btn-success waves-effect waves-light">START WORK PERIOD</button>

        <button type="submit" id="end_btn" onclick="endPeriod();" class="btn btn-sm btn-danger waves-effect waves-light">END WORK PERIOD</button>

        <button type="submit" id="new_order_btn" onclick="newOrder();" class="btn btn-sm btn-info waves-effect waves-light">NEW ORDER (F3)</button>

<!-- Top Navigation: Right Menu -->

    </nav>

    <div class="container-fluid disabledbutton" id="main" style="margin-top:4%;">
        <div class="row">

            <div class="col-sm-2 hidethis">
                <div class="row">
                    <div class="panel panel-default">

                        <ul class="list-group scroll_waiters fakeScroll">

                            <li class="list-group-item row">

                              <div class="col-md-12">
                                  <h4 class="list-group-item-heading"><center>Waiters</center></h4>
                              </div>

                            </li>
                                <?php

                                $waiterDetails = array();

                                $getData = "SELECT * FROM waiters";
                                $qur = $conn->query($getData);

                                while($r = mysqli_fetch_assoc($qur))
                                {

                                    $waiterDetails[] = array('waiter_id'=>$r['id'],'name' => $r['name'],'numOfServices' =>  $r['status']);

                                ?>

<!--
                            <script>
                            var obj = {waiter_id:<?php //echo $r['id'] ?>,name:<?php //echo $r['name'] ?>,numOfServices:<?php //echo $r['status'] ?>};
                            waiterDetails.push(temp);
                            </script>
-->

                            <li class="list-group-item row waiters">

                              <div class="col-md-12">
                                  <h4 class="list-group-item-heading"><a href="#"><?php echo $r['name'] ?></a></h4>
                                  <span class="glyphicon glyphicon-chevron-right pull-right"></span>
                              </div>

                            </li>
                                          <?php


}

                                ?>




                      </ul>
                    </div>


                    <div class="panel panel-default">

                       <ul class="list-group scroll_waiters fakeScroll">

                           <li class="list-group-item row takeaway">

                             <div class="col-md-12">
                                 <h4 class="list-group-item-heading"><a href="#">TAKEAWAY</a></h4>
                                 <span class="glyphicon glyphicon-chevron-right pull-right"></span>
                             </div>

                           </li>
                       </ul>
               </div>




                </div>
            </div>

            <div class="col-md-2 services hidden" style="position: absolute; top: 14%; left: 17%; z-index: 100;">
                <div class="row">
                    <div class="panel panel-default">

                        <ul class="list-group scroll" id="services">




                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-8" id="sec_div">
                <div class="row">

                </div>
                <div class="row">
                    <div class="panel panel-default">

                        <ul class="list-group border-right">

                            <li class="list-group-item row table-header">

                              <div class="col-md-12">
                                  <h4 id="ordersHeading" class="list-group-item-heading">ITEMS ORDERED</h4>
                              </div>

                            </li>

                        </ul>

                        <form class="form-inline barcode-form" onsubmit="return false;">

                              <div class="form-group">
                                   <div class="col-md-3">
                                        <input type="text" class="form-control" id="barcode_product_search" placeholder="Scan Barcode or Type...">
                                   </div>
                              </div>

                              <button class="btn btn-default" onclick="add_product_to_order(1, 4);">Add</button>

                        </form>

                        <ul class="list-group">

                            <li class="list-group-item row table-header">

                              <div class="col-md-2">
                                  <h5 id="ordersHeading" class="list-group-item-heading">Name</h5>
                              </div>

                              <div class="col-md-2">
                                  <h5 id="ordersHeading" class="list-group-item-heading">Price</h5>
                              </div>

                              <div class="col-md-6">
                                  <h5 id="ordersHeading" class="list-group-item-heading">Qty / Delete Record</h5>
                              </div>

                              <div class="col-md-2">
                                  <h5 id="ordersHeading" class="list-group-item-heading">Discounted Amount</h5>
                              </div>
                        </ul>

                        <ul class="list-group scroll center-text" id="orders">

                        </ul>

                    </div>

                    <div class="panel panel-default">

                            <ul class="list-group scroll">

                                <li class="list-group-item row">

                                  <div class="col-md-6">
                                      <h4 class="list-group-item-heading">TOTAL DISCOUNTED AMOUNT</h4>
                                  </div>

                                  <div class="col-md-6 pull-right">
                                      <h4 class="list-group-item-heading"><center id="discounttxt">0</center></h4>
                                  </div>

                                </li>

                                <li class="list-group-item row">

                                  <div class="col-md-6">
                                      <h4 class="list-group-item-heading">TOTAL AMOUNT</h4>
                                  </div>

                                  <div class="col-md-6 pull-right">
                                      <h4 class="list-group-item-heading"><center id="totaltxt">0</center></h4>
                                  </div>

                                </li>


                            </ul>
                    </div>

                    <div class="row">

                        <div class="row" id="row1">

                            <div class="text-center">

                                <button type="submit" id="submit_btn" class="btn btn-info waves-effect waves-light btn-xlg" onclick="submitorder();">SUBMIT <span class="glyphicon glyphicon-plus"></span></button>

                            </div>

                        </div>

                        <div class="row" id="row2">

                            <div class="text-center">

                                 <button type="submit" id="bill_btn" class="btn btn-success waves-effect waves-light btn-xlg">BILL <span class="glyphicon glyphicon-print"></span></button>

                                <button type="submit" id="tender_btn" onclick="tender();" class="btn btn-warning waves-effect waves-light btn-xlg black" style="color:white;">TENDER <span class="glyphicon glyphicon-ok"></span></button>

                            </div>

                        </div>

                        <div class="row" id="row3" style="display:none;">

                            <div class="text-center">
                                 <button type="submit" id="bill_btn_takeaway" class="btn btn-success waves-effect waves-light btn-xlg">BILL <span class="glyphicon glyphicon-print"></span></button>

                            </div>

                        </div>

                    </div>


                </div>
            </div>

            <div class="col-md-2" id="third_div">
                <div class="row">
                    <div class="panel panel-default">

                        <ul class="list-group">

                            <li class="list-group-item row table-header border-right">

                              <div class="col-md-12">
                                  <h4 class="list-group-item-heading">CATEGORIES</h4>
                              </div>

                            </li>

                        </ul>

                        <ul class="list-group scroll_waiters">

                           <?php
                  $getData = "SELECT * FROM menu_categories";
                                $qur = $conn->query($getData);

                                while($r = mysqli_fetch_assoc($qur)){
                                    ?>
                            <li class="list-group-item row ordered-items" onclick="getProducts(<?php echo $r['category_id'] ?>);">

                              <div class="col-md-12">
                                    <h4 class="list-group-item-heading">
                                        <?php echo $r['cat_name'] ?>
                                        <span class="glyphicon glyphicon-chevron-right pull-right"></span>

                                    </h4>
                              </div>

                            </li>

                            <?php

                                }

                                    ?>

                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-2" id="fourth_div">
                <div class="row">

                    <div class="panel panel-default">

                        <ul class="list-group">

                            <li class="list-group-item row table-header">

                              <div class="col-md-12">
                                  <h4 class="list-group-item-heading">PRODUCTS</h4>
                              </div>

                            </li>

                        </ul>

                        <ul class="list-group scroll_waiters" id="products_tb">

<?php
                  $getData = "SELECT * FROM menu_products WHERE cat_id = 1";
                                $qur = $conn->query($getData);

                                while($r = mysqli_fetch_assoc($qur)){
                                    ?>

                            <li class="list-group-item row ordered-items">

                              <div class="col-md-10" onclick="appendOrders('<?php echo $r['p_name'] ?>', <?php echo $r['p_id'] ?>, <?php echo $r['p_price'] ?>, <?php echo $r['discount_percent'] ?>, 1, 4, <?php echo $r['cat_id'] ?>)">
                                    <h4 class="list-group-item-heading">
                                        <?php echo $r['p_name'] ?>
                                        <small class="list-group-item-text">
                                              <span class="badge pull-right"><?php echo $r['p_price']." Rs" ?></span>
                                        </small>
                                    </h4>
                              </div>

                            </li>

                            <?php
                                }

                                    ?>



                        </ul>

                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div>

</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>


    <div class="container">
        <div class="row">
            <div class="col-md-4">


                <div id="customer_info">
                    <h3 class="alert alert-info text-center">Customer Info</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="customer_name" placeholder="Customer Name...">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="customer_contact" placeholder="Customer Contact...">
                    </div>
                </div>


                <h3 class="alert alert-info text-center">Order Info</h3>

                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Products</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>D. Amount</th>
                      </tr>
                    </thead>
                    <tbody id="table_products">

                    </tbody>
                  </table>

                  <table class="table table-bordered">

                    <thead>

                      <tr>

                        <td>D. Amount</td>
                        <td id="modal-discounttxt">0</td>

                      </tr>

                      <tr>

                        <td>Total</td>
                        <td id="modal-total">0</td>

                      </tr>

                    </thead>

                  </table>
            </div>

            <div class="col-md-4">

                <h3 class="alert alert-info text-center">Price Calculator</h3>

                <div id="calculator">

                        <!-- Screen and clear key -->
                        <div class="top">
                            <span class="clear">C</span>
                            <div class="screen"></div>
                        </div>

                        <div class="keys">
                            <!-- operators and other keys -->
                            <span>1</span>
                            <span>2</span>
                            <span>3</span>

                            <span>4</span>
                            <span>5</span>
                            <span>6</span>

                            <span>7</span>
                            <span>8</span>
                            <span>9</span>





                            <span>0</span>

                            <span class="eval" style="width: 135px;">Done</span>
<!--                            <span class="eval">Discount</span>-->
                        </div>

                </div>
            </div>

        </div>


        </div>
    </div>
    </div>

<div id="myModal_damage" class="modal fade" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Modal Header</h4>
    </div>
    <div class="modal-body">


              <!--<div class="row">
                  <div class="panel panel-default">

                      <ul class="list-group scroll" id="damage-orders">

                          <li class="list-group-item row">

                            <div class="col-md-12">
                                <h4 class="list-group-item-heading"><center>Items Ordered</center></h4>
                            </div>

                          </li>

                             </ul>

                  </div>
               </div>-->
                      <table class="table table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th><center>Product Name</center></th>
                                  <th><center>Quantity</center></th>
                                  <th><center>Damage Quantity</center></th>

                              </tr>
                          </thead>
                          <tbody id="damage-orders">





                          </tbody>
                      </table>
    </div>
    <div class="modal-footer">
          <button type="button" onclick="checkdamagelist()" class="btn btn-default">Submit</button>
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

    </div>
  </div>

</div>
</div>


<!-- Enter Customer Details -->

<div id="modal_customer" class="modal fade" role="dialog">
<div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Enter Customer Details</h4>
    </div>
    <div class="modal-body">

    </div>
    <div class="modal-footer">
          <button type="button" onclick="checkdamagelist()" class="btn btn-default">Submit</button>
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

    </div>
  </div>

</div>
</div>

<!-- Enter Customer Details -->


<!-- Modal Popup For Non Tendered Orders -->
<div id="myModal_waiters" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal Content For Non Tendered Orders-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please tender this order to continue ending work period.</h4>
        </div>

        <div class="modal-body">
          <table class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th><center>Product Name</center></th>
                      <th><center>Quantity</center></th>
                      <th><center>Price</center></th>
                      <th><center>D. Amount</center></th>
                  </tr>
              </thead>

              <tbody id="nontender-waiters">
              </tbody>

          </table>
        </div>

      </div>
    </div>
</div>

<div class="overlay" id="overlay" style="display:none;"></div>

<div class="box hide_error" id="box">
     <a class="boxclose" id="boxclose"></a>
     <h1>Important message</h1>
     <p id="error_message">
      There are no errors found in POS.
     </p>
</div>

<script type="text/javascript" src="scripts/footer_scripts.js"></script>

<!-- ALL REFERENCE LINKS TO JS AND CSS -->

<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/startmin.js"></script>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="css/metisMenu.min.css" rel="stylesheet">

<!-- Timeline CSS -->
<link href="css/timeline.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/startmin.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="css/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- Custom CSS -->
<link rel="stylesheet" href="custom-css/style.css" type="text/css">
<link rel="stylesheet" href="custom-css/pos_style.css" type="text/css">

    <?php

       $sql = "SELECT * from work_periods WHERE status = 0";
       $result1 = $conn->query($sql);
       $array = array();

       while($r = mysqli_fetch_assoc($result1))
       {
           $array[] = $r;
       }

       $count = count($array);
       if($count > 0)
       {

   ?>

<script type="text/javascript">

$("#start_btn").html("RESUME WORK PERIOD (F1)");
$("#end_btn").html("END AND RESTART (F2)");

$("#main").addClass("disabledbutton");

isResume = true;
workperiod_id = "<?php echo $array[0]["workperiod_id"] ?>";

//alert("Is Resumed: "+isResume);
//alert("Work Period ID: "+workperiod_id);
//alert("Customer ID: "+cust_id);

</script>

            <?php

            $sql1 = "SELECT * from orders WHERE workperiod_id = ".$array[0]["workperiod_id"]." ORDER BY order_id DESC LIMIT 1";
            $result2 = $conn->query($sql1);
            $array1 = array();

            while($r1 = mysqli_fetch_assoc($result2))
            {
                //$array[] = $r;
                $array1[] = $r1;
            }

//            $sql_customer = "SELECT customers.customer_name, customers.customer_contact FROM customers INNER JOIN orders ON customers.customer_ord_id = orders.customer_id WHERE orders.workperiod_id = ".$array[0]["workperiod_id"]." AND orders.status = ".status." LIMIT 1";
//            $result_customer = $conn->query($sql_customer);
//            $array_customer = array();
//
//            while($r_customer = mysqli_fetch_assoc($result_customer))
//            {
//                //$array[] = $r;
//                $array_customer[] = $r_customer;
//            }


            $count1 = count($array1);

            if($count1 > 0)
            {

            ?>

            <script type="text/javascript">

                status = "<?php echo $array1[0]["status"] ?>";

                //alert(status);
                //alert(customer_name);

                if(status == 1)
                {
                    $("#customer_info").addClass("disabledbutton");

                    //$("#customer_name").val(customer_name);
                }

                //alert("Status: "+status);
                startOrder(status);

            </script>

            <?php

            }

        }

            ?>

</body>
</html>