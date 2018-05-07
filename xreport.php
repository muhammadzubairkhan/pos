<?php

include("include/dbconnect.php");
include_once "include/session.php";

if(isset($_SESSION['user_name']) && isset($_SESSION['user_password']) && isset($_SESSION['user_name']) && isset($_SESSION['user_password']) && $_SESSION['user_name'] === "admin" && $_SESSION['user_password'] === "admin123")
{

if(isset($_POST['inventory_name']) && isset($_POST['inventory_quan']))
{
    $name = $_POST['inventory_name'];
    $quan = $_POST['inventory_quan'];
    $sql = "INSERT INTO inventory(name,quantity,status) VALUES('$name','$quan','')";

    if ($conn->query($sql) === TRUE) 
    {
       echo "<script>alert('Inventory added Successfully')</script>";
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Point of Sales - X Report</title>
        
        <link rel="icon" type="icons/png" href="icons/mobile-dashboard-icon.png">
        
        <!-- jQUERY -->
        <script src="js/jquery.min.js"></script>

        <!-- SLIDE DOWN EFFECT ON PRODUCTS, CATEGORIES, ORDERS  -->
        <script type="text/javascript">
            $(function () {
                $(this).find('.panel-footer').show();
                
                $(".takeaway_table").hide();
                $(".dinein_table").hide();
                $(".damage_table").hide();
                
            });
        </script>

        <!-- NOTIFICATIONS CODE AND CSS -->
        <style type="text/css">
            
            #notification_count
            {
                padding: 1px 9px 1px 9px;
                background: #cc0000;
                color: #ffffff;
                font-weight: bold;
                margin-left: 77px;
                text-align: center;
                border-radius: 15px;
                -moz-border-radius: 15px;
                -webkit-border-radius: 15px;
                position: absolute;
                margin-top: -12px;
                font-size: 16px;
            }
            
            #notification_count_for_notify
            {
                padding: 1px 9px 1px 9px;
                background: #cc0000;
                color: #ffffff;
                font-weight: bold;
                margin-left: 77px;
                text-align: center;
                border-radius: 15px;
                -moz-border-radius: 15px;
                -webkit-border-radius: 15px;
                position: absolute;
                margin-top: -12px;
                font-size: 16px;
            }
            
            .links:hover
            {
                text-decoration:none;
            }
            
        </style>
        
        <script type="text/javascript" charset="utf-8">

            var xreport_takeaway, xreport_orders, xreport_damage, report_type, total_amount = 0;
            
            function getxreportsfordinein()
            {
                $("#reports_dine_in").text("");
                report_type = "x-report-dine-in";
                
                $.ajax({ type : 'POST',
                          data : { report_type:report_type},
                          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                          success: function ( data ) 
                          {
                            xreport_orders = JSON.parse(data);
                            var json = JSON.parse(data);
              
                            if(json.length < 1)
                            {
                                $("#reports_dine_in").append("<tr><td colspan='3' class='alert alert-danger text-center'>There were no records found for this work-period.</td></tr>");
                            }

                            for(var i =0;i<json.length;i++)
                            {      
                                $("#reports_dine_in").append("<tr><td>"+json[i].p_name+"</td> <td>"+json[i].quantity+"</td><td>"+json[i].totalprice+"</td></tr>");
                                total_amount = parseInt(total_amount) + parseInt(json[i].totalprice);
                            }
                              
                            $("#reports_dine_in").append("<tr><td colspan='2'><b>TOTAL AMOUNT</b></td><td id='dinein_amount'><b>"+total_amount+" Rs</b></td></tr>");
                              
                            total_amount = 0;

                            // <=== VALUE RETURNED FROM FUNCTION.
                          },
                          error: function ( xhr ) 
                          {
                            //alert( "error" );
                          }
                       });

            }

            function getxreportsfortakeaway()
            {
                $("#reports_takeaway").text("");
                report_type = "x-report-takeaway";
                $.ajax({ type : 'POST',
                          data : { report_type:report_type},
                          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                          success: function ( data ) 
                          { 
                            xreport_takeaway = JSON.parse(data);
                            var json = JSON.parse(data);
              
                            if(json.length < 1)
                            {
                                $("#reports_takeaway").append("<tr><td colspan='3' class='alert alert-danger text-center'>There were no records found for this work-period.</td></tr>");
                            }

                            for(var i =0; i<json.length; i++)
                            {      
                                $("#reports_takeaway").append("<tr><td>"+json[i].p_name+"</td> <td>"+json[i].quantity+"</td><td>"+json[i].totalprice+"</td></tr>");   
                                total_amount = parseInt(total_amount) + parseInt(json[i].totalprice);
                            }
                            
                            $("#reports_takeaway").append("<tr><td colspan='2'><b>TOTAL AMOUNT</b></td><td id='takeaway_amount'><b>"+total_amount+" Rs</b></td></tr>");
                            
                            total_amount = 0;
                              
                            // <=== VALUE RETURNED FROM FUNCTION.
                          },
                          error: function ( xhr ) 
                          {
                            //alert( "error" );
                          }
                       });     
            }

            function getxreportsfordamage()
            {
                $("#reports_dine_in").text("");
                report_type = "x-report-damage";
                
                $.ajax({ type : 'POST',
                          data : { report_type:report_type},
                          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                          success: function ( data ) 
                          {
                            xreport_damage = JSON.parse(data);
                            var json = JSON.parse(data);
              
                            if(json.length < 1)
                            {
                                $("#reports_damage").append("<tr><td colspan='3' class='alert alert-danger text-center'>There were no records found for this work-period.</td></tr>");
                            }

                            for(var i =0; i<json.length; i++)
                            {      
                                $("#reports_damage").append("<tr><td>"+json[i].p_name+"</td> <td>"+json[i].no_of_damages+"</td><td>"+json[i].totalprice+"</td> </tr>");   
                                total_amount = parseInt(total_amount) + parseInt(json[i].totalprice);
                            }

                            $("#reports_damage").append("<tr><td colspan='2'><b>TOTAL AMOUNT</b></td><td id='damage_amount'><b>"+total_amount+" Rs</b></td></tr>");
                              
                            total_amount = 0;
                              
                            // <=== VALUE RETURNED FROM FUNCTION.
                          },
                          error: function ( xhr ) 
                          {
                            //alert( "error" );
                          }
                       });     
            }
            
            function getxreportsfordiscount()
            {
               
                //alert("executed x report function for dsicount");
                report_type = "x-report-discount";
                //alert(report_type);
                $.ajax({ type : 'POST',
                          data : { report_type:report_type},
                          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                          success: function ( data ) 
                          {
                            console.log(data);
                            var json = JSON.parse(data);
                             
                            var total = 0;
                            for(var i =0; i<json.length; i++)
                            {      
                                total += parseInt(json[i].discount_price);
                            }
                            
                            $("#reports_discount").html(total); 

                            // <=== VALUE RETURNED FROM FUNCTION.
                          },
                          error: function ( xhr ) 
                          {
                            //alert( "error" );
                          }
                       });     
            }
            
            function printxreport(type)
            {
                var takeaway_total_amount = 0, dinein_total_amount = 0, damage_total_amount = 0;
                
                if(type == "takeaway")
                {
                    takeaway_total_amount = $("#takeaway_amount").text();
                    report_type = "x-report";
                    $.ajax({ type : 'POST',
                        data : { data:JSON.stringify(xreport_takeaway), type:type, report_type:report_type,takeaway_total_amount:takeaway_total_amount},
                        url  : 'escpos-php-master/example/interface/xreport_sales.php',              // <=== CALL THE PHP FUNCTION HERE.
                        success: function(data) 
                        {
                            //$(".generate_pdf_ta").removeClass("disabled");
                           //alert(data);
                           // <=== VALUE RETURNED FROM FUNCTION.
                        },
                        error: function (xhr) 
                        {
                           //////( "error  "+xhr );
                        }
                    });
                }
                else if(type == "order")
                {
                    dinein_total_amount = $("#dinein_amount").text();
                    report_type = "x-report";
                    $.ajax({ type : 'POST',
                        data : { data:JSON.stringify(xreport_orders), type:type, report_type:report_type,dinein_total_amount:dinein_total_amount},
                        url  : 'escpos-php-master/example/interface/xreport_sales.php',              // <=== CALL THE PHP FUNCTION HERE.
                        success: function(data) 
                        {
                            //$(".generate_pdf_di").removeClass("disabled");
                           //alert(data);
                           // <=== VALUE RETURNED FROM FUNCTION.
                        },
                        error: function (xhr) 
                        {
                           //////( "error  "+xhr );
                        }
                    });
                }
                else if(type == "damage")
                {
                    damage_total_amount = $("#damage_amount").text();
                    report_type = "x-report";
                    $.ajax({ type : 'POST',
                        data : { data:JSON.stringify(xreport_damage), type:type, report_type:report_type,damage_total_amount:damage_total_amount},
                        url  : 'escpos-php-master/example/interface/xreport_sales.php',              // <=== CALL THE PHP FUNCTION HERE.
                        success: function(data) 
                        {
                            //$(".generate_pdf_dam").removeClass("disabled");
                           //alert(data);
                           // <=== VALUE RETURNED FROM FUNCTION.
                        },
                        error: function (xhr) 
                        {
                           //////( "error  "+xhr );
                        }
                    });
                }
             }

            getxreportsfortakeaway();
            getxreportsfordinein();
            getxreportsfordamage();
            getxreportsfordiscount();

        </script>
        
        <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css"/>
        
    </head>
    
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        
        <?php include("include/header.php"); ?>
        <?php include("include/sidebar.php"); ?>
        
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">

        <!-- Page Content -->
     
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                  <h1 class="page-header"><center><h1>X REPORT</h1></center></h1>
                </div>
                
                <ul class="nav nav-tabs">
<!--                    <li class="active"><a data-toggle="tab" href="#takeaway">TAKE-AWAY</a></li>-->
                    <li class="active"><a data-toggle="tab" href="#dinein">ORDERS</a></li>
<!--                    <li><a data-toggle="tab" href="#damage">DAMAGE</a></li>-->
                    <li><a data-toggle="tab" href="#discount">DISCOUNT</a></li>
                </ul>
                
                <div class="tab-content">
                    <div id="takeaway" class="tab-pane fade">
                        <!-- TAKE AWAY REPORT TABLE -->
                        <div class="col-md-12">

                            <h2>TAKE AWAY ORDER REPORT</h2>
                            <div>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT NAME</th>
                                            <th>QUANTITY</th>
                                            <th>PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody id="reports_takeaway">


                                    </tbody>
                                </table>
                                <div class="pull-right">
                                    <a class="btn btn-success generate_pdf_ta" href="" onclick="printxreport('takeaway'); return false;"> PRINT REPORT</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="dinein" class="tab-pane fade in active">
                        <!-- DINE-IN REPORT TABLE -->
                        <div class="col-md-12">

                            <h2>ORDER REPORT</h2>
                            <div>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT NAME</th>
                                            <th>QUANTITY</th>
                                            <th>PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody id="reports_dine_in">


                                    </tbody>
                                </table>
                                <div class="pull-right">
                                    <a class="btn btn-success generate_pdf_di" href="" onclick="printxreport('order'); return false;"> PRINT REPORT</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="damage" class="tab-pane fade">
                        <!-- DAMAGE ITEMS REPORT TABLE -->
                        <div class="col-md-12">

                            <h2>DAMAGE ITEMS ORDER REPORT</h2>
                            <div>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT NAME</th>
                                            <th>NO OF DAMAGES</th>
                                            <th>PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody id="reports_damage">


                                    </tbody>
                                </table>
                                <div class="pull-right">
                                    <a class="btn btn-success generate_pdf_dam" href="" onclick="printxreport('damage'); return false;"> PRINT REPORT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    <div id="discount" class="tab-pane fade">
                        <!-- DISCOUNTS ITEMS REPORT TABLE -->
                        <div class="col-md-12">

                            <h2>TOTAL DISCOUNT REPORT</h2>
                            <div>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>TOTAL DISCOUNT</th>
                                             <td id="reports_discount">0</td>
                                        </tr>
                                    </thead>

                                </table>
<!--
                                <div class="pull-right">
                                    <a id="generate_pdf" class="btn btn-success" href=""> GENERATE PDF</a>
                                </div>
-->
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                </div>

            </div>  

            
            </div>  

        </div>

    </div>

</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Inventory Name</label>
        <input type="text" class="form-control" id="inventory_name" placeholder="Inventory Name...">
        <br>  
            <label>Inventory Quantity</label>
        <input type="text" class="form-control" id="inventory_quan" placeholder="Inventory Quantity...">
    
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="sumit_btn" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    
    <div class="modal fade" id="confirmmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
 <div class="modal-body">
        <label>Are you sure you want to delete this inventory ?</label>
    
       
      </div>
      <div class="modal-footer">
        <button type="button" id="delete_btn_yes" class="btn btn-secondary" >YES</button>
        <button type="button" id="sumit_btn" data-dismiss="modal" class="btn btn-primary">NO</button>
      </div>
    </div>
  </div>
</div>
    
            
<div class="footer"><center>Powered By Echelon Tech Lab</center></div>

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
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="custom-css/style.css" type="text/css">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
        <script type="text/javascript">
            $('.form_datetime').datetimepicker({
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 0
            });
            $('.form_date').datetimepicker({
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
            
    </script>
    
</body>
</html>

<?php
}
else
{
    header("Location: login.php");
}
?>
