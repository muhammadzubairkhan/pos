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

        <title>Home - Point of Sales</title>
        
        <link rel="icon" type="icons/png" href="icons/mobile-dashboard-icon.png">
        
        <!-- jQUERY -->
        <script src="js/jquery.min.js"></script>

        <!-- SLIDE DOWN EFFECT ON PRODUCTS, CATEGORIES, ORDERS  -->
        <script type="text/javascript">
            $(function () {
                $(this).find('.panel-footer').show();
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

            // Document Ready Function to start showing notification on page
            $(document).ready(function(){
                waitForMsg();
            });
        
        </script>
        
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
        
        <div class="container-fluid">
            
            <div class="jumbotron text-center">
              <h1 class="page-header"><center><h1>POINT OF SALES</h1></center></h1>
            </div>
            
            <div class="row">
            
            <div class="col-md-4 col-sm-12 col-xs-12">
                
            
                
                
                    <a class="links" href="main_pos.php">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="icons/posicon1.png" width="100" height="100">
                                <h3>POS </h3>
                                <p>Click here to view all sales</p>
                            </div>
                            <div class="panel-footer">Total Sales 
                                <a href="tables.php">
<!--
                                    <span class="badge">  
                                    
                     
                                        
                                    </span>
-->
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            
            <div class="col-md-4 col-sm-12 col-xs-12">
                    <a class="links" href="inventory.php">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="icons/inventoryicon.png" width="100" height="100">
                                <h3>INVENTORY </h3>
                                <p>Click here to view all inventory items</p>
                            </div>
                            <div class="panel-footer">Total Inventory Items 
                                <a href="inventory.php">
<!--
                                    <span class="badge">
                                        
                                    50
                                        
                                    </span>
-->
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            
            
            <div class="col-md-4 col-sm-12 col-xs-12">
                    <a class="links" href="xreport.php">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="icons/reporticon.png" width="100" height="100">
                                <h3>REPORTS </h3>
                                <p>Click here to view all reports</p>
                            </div>
                            <div class="panel-footer">Total Reports 
                                <a href="#">
<!--
                                    <span class="badge">
                                        
                                    50
                                        
                                    </span>
-->
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
            
            <div class="row">
            
            <div class="col-md-4 col-sm-12 col-xs-12">
                    <a class="links" href="table.php">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="icons/manageicon.png" width="100" height="100">
                                <h3>MANAGE </h3>
                                <p>Click here to view all details</p>
                            </div>
                            <div class="panel-footer">Total Waiters & Tables 
                                <a href="table.php">
<!--
                                    <span class="badge">
                                        
                                    50
                                        
                                    </span>
-->
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            
<!--
            <div class="col-md-4 col-sm-12 col-xs-12">
                    <a class="links" href="tickets.php">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="icons/ticketicon.png" width="100" height="100">
                                <h3>TICKETS </h3>
                                <p>Click here to view all tickets</p>
                            </div>
                            <div class="panel-footer">Total Tickets 
                                <a href="tickets.php">
                                    <span class="badge">
                                        
                                    50
                                        
                                    </span>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
-->
            
            <div class="col-md-4 col-sm-12 col-xs-12">
                    <a class="links" href="items.php">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="icons/menuicon.png" width="100" height="100">
                                <h3>ITEMS </h3>
                                <p>Click here to view all items</p>
                            </div>
                            <div class="panel-footer">Total Items 
                                <a href="menu.php">
<!--
                                    <span class="badge">
                                        
                                    50
                                        
                                    </span>
-->
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
            
            
            
            <!-- ... Your content goes here ... -->
        </div>
        
        
        <div class="container">
            <div class="row">
                
                
                
                
                
                
                  
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
    
        <!-- This is what you need -->
        <script src="js/sweetalert.min.js"></script>
        <link rel="stylesheet" href="css/sweetalert.css">
        <!--.......................-->
    
    <script type="text/javascript">
    
     
        $(document).ready(function(){
            
            swal({
              title: "Are you sure?",
              text: "You will not be able to recover this imaginary file!",
              type: "warning"
              //closeOnCancel: false
            });
            
        });
        
   
    
    
    </script>
        

</body>
</html>
<?php

include("checkquantity.php");

?>
