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
        
<script>

    

    
            function sendrequest(){
    
           
                $.ajax( { type : 'POST',
          data : { waitername:name},
          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
            alert( data );               // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            alert( "error" );
          }
        });
                   }
                

         

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
            <div class="form-group">
            <label>Waiter Name</label>
            <input type="text" id="waiter_name" class="form-control" placeholder="Waiter Name...">
            </div>
<!--
            <div class="form-group">
            <label>Status</label>
                <select class="form-control">
                    <option>Set</option>
                    <option>Unset</option>
                </select>
            </div>
-->
            <div class="form-group">
        
            <button type="button" onclick="sendrequest();" class="btn btn-primary">Add</button>
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

</body>
</html>
