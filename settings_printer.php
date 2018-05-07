<?php

include("include/dbconnect.php");
include_once "include/session.php";

if(isset($_SESSION['user_name']) && isset($_SESSION['user_password']) && isset($_SESSION['user_name']) && isset($_SESSION['user_password']) && $_SESSION['user_name'] === "admin" && $_SESSION['user_password'] === "admin123")
{

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Configuration For Printer - Point of Sales</title>

        <link rel="icon" type="icons/png" href="icons/mobile-dashboard-icon.png">

        <!-- jQUERY -->
        <script src="js/jquery.min.js"></script>
        
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
            
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Enter Printer Information</label>
                </div>
            
                <label>Printer Name</label>
                        
                <input type="text" id="printer_name" class="form-control" name="printer_name" placeholder="Printer Name..." required>
                <br>
                <label>Printer IP</label>
                <input type="text" id="printer_ip" class="form-control" name="printer_ip" placeholder="Printer IP..." required>
                <br>
                <label>Printer Port</label>
                <input type="text" id="printer_port" class="form-control" name="printer_port" placeholder="Printer Port..." required>
                <br>
                <button type="reset" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> Reset</button>
                <button type="submit" name="update_btn" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Update Printer Information</button>
            </form>    
            
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
    
    <?php

    
    error_reporting(E_ALL);
    
    if(isset($_POST['update_btn']))
    {    
        $printer_name = $_POST['printer_name'];
        $printer_ip = $_POST['printer_ip'];
        $printer_port = $_POST['printer_port'];
        
        $sql = "UPDATE pos_printer SET printer_name = '$printer_name', printer_ip = '$printer_ip', printer_port = '$printer_port', last_updated = NOW() WHERE id = '1'";
        //echo $sql;

        if ($conn->query($sql) === TRUE) 
        {
            ?>

            <script type="text/javascript">
                alert('Printer information updated successfully!');
            </script>

            <?php
        }    
    }

}
else
{
    header("Location: login.php");
}
    
    ?>
