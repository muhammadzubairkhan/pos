<?php

include("include/dbconnect.php");
include_once "include/session.php";

if(isset($_GET['name']) && isset($_GET['id'])){
 
    
    
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

        <title>Point of Sales</title>
        
        <link rel="icon" type="image/png" href="icons/mobile-dashboard-icon.png">
        
        <!-- jQUERY -->
        <script src="js/jquery.min.js"></script>
        
        <!-- SLIDE DOWN EFFECT ON PRODUCTS, CATEGORIES, ORDERS  -->
        <script type="text/javascript">
            $(function () {
                $(this).find('.panel-footer').show();
            });
        </script>
        
        <style type="text/css">
        
        
            
            
        .table_reserved
            {
                padding: 15px;
                background-color: lightgreen;
                color: white;
                text-decoration: none;
            }
            
              .table_free
            {
                padding: 15px;
                background-color: lightgreen;
                color: white;
                text-decoration: none;
            }          
            
        </style>
        
        
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
            
            <!-- ... Your content goes here ... -->
            <div class="container-fluid">
                
<!--
                <div class="col-md-4">
                    <div class="well">Waiter 1 <span class="badge pull-right">Active</span></div>
                    <div class="well">Waiter 2 <span class="badge pull-right">Active</span></div>
                    <div class="well">Waiter 3 <span class="badge pull-right">Active</span></div>
                    <div class="well">Waiter 4 <span class="badge pull-right">Active</span></div>
                    <div class="well">Waiter 5 <span class="badge pull-right">Active</span></div>
                    <div class="well">Waiter 6 <span class="badge pull-right">Active</span></div>
                    <div class="well">Waiter 7 <span class="badge pull-right">Active</span></div>
                    <div class="well">Waiter 8 <span class="badge pull-right">Active</span></div>
                    <div class="well">Waiter 9 <span class="badge pull-right">Active</span></div>
                </div>
-->
                
                <div class="col-md-12">
                    
                    <div class="row">
                        
                        <?php
                        
                           $getData = "SELECT * FROM restaurant_tables";
                                $qur = $conn->query($getData);
                                
                                while($r = mysqli_fetch_assoc($qur)){
                                   
                                    $status = "";
                                    $class = "";
                                    if($r['status'] == '0'){
                                        
                                        $status = "Free";
                                        $class = "alert alert-success";
                                    }else{
                                        
                                         $status = "Reserved";
                                        $class = "alert alert-danger";
                                        
                                    }
                                    
                                    
                                  ?>
                        
                           <div class="col-md-4 col-sm-12 col-xs-12">
                    
                                <div class="panel panel-default">
                                    <a class="links" href="order.php?name=<?php echo $r['name'];  ?>&id=<?php echo $r['id'];  ?>">
                                    <div class="panel-body">
                                        <img src="icons/restaurant_table.png" width="70" height="70">
                                        <h3><?php echo $r['name']; ?></h3>
                                    </div>
                                    </a>
                                    
                                    <div class="panel-footer">
                                        <a href="order.php?name=<?php echo $r['name'];  ?>&id=<?php echo $r['id'];  ?>">
                                            <span class="<?php echo $class; ?>">  
                                                <?php echo $status; ?>
                                            </span>
                                        </a>
                                    </div>
                                    
                                </div>
                                
                                
                                
                         
                        </div>
                        
                        
                        <?php
                                }
                        
                        
                        ?>
            
                     

                        
                    </div>
                        
                </div>
                
                
            </div>
                
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
        
        <script type="text/javascript">
            
        function showProducts(str) {
            if (str == "") {
                document.getElementById("txtProductHint").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("txtProductHint").innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET","getproduct.php?q="+str, true);
                xmlhttp.send();
            }
        }
            
        </script>
    
</body>
</html>
