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

        <title>Configuration For Company - Point of Sales</title>

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
                    <label>Enter Company Information</label>
                </div>
            
                <label>Company Name</label>
                        
                <input type="text" id="company_name" class="form-control" name="company_name" placeholder="Company Name..." required>
                <br>
                <label>Company Logo</label>
                <input type="file" id="company_logo" name="company_logo" required>
                <br>
                <button type="reset" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> Reset</button>
                <button type="submit" name="update_btn" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Update Information</button>
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
        // this assumes that the upload form calls the form file field "myupload"
        $company_name = $_POST['company_name'];

        $name  = $_FILES['company_logo']['name'];
        $type  = $_FILES['company_logo']['type'];
        $size  = $_FILES['company_logo']['size'];
        $tmp   = $_FILES['company_logo']['tmp_name'];
        $error = $_FILES['company_logo']['error'];
        
        $savepath_logo = 'icons/';
        $savepath_pdf = 'reports/';
        
        $filelocation_logo = $savepath_logo."pos_logo.png";
        $filelocation_pdf = $savepath_pdf."logo.png";        

        // This won't upload if there was an error or if the file exists, hence the check    
        if (file_exists($filelocation_logo) && $error == 0) 
        {
            chmod($filelocation_logo, 0755); //Change the file permissions if allowed
            unlink($filelocation_logo); //remove the file

            move_uploaded_file($tmp, $filelocation_logo);
            
            ?>
    
            <script type="text/javascript">
                alert('Logo for POS updated successfully!');
            </script>
    
            <?php
            
            
            if(file_exists($filelocation_pdf) && $error == 0)
            {
                chmod($filelocation_pdf, 0755); //Change the file permissions if allowed
                unlink($filelocation_pdf); //remove the file
                copy($filelocation_logo, $filelocation_pdf);
                
                ?>
    
                <script type="text/javascript">
                    alert('Logo for PDF documents updated successfully!');
                </script>
    
                <?php
                
            }
            else
            {
                copy($filelocation_logo, $filelocation_pdf);
                
                ?>
    
                <script type="text/javascript">
                    alert('Logo for PDF documents uploaded successfully!');
                </script>
    
                <?php
                
            }         
        }
        else
        {
            move_uploaded_file($tmp, $filelocation_logo);
            
            ?>
    
            <script type="text/javascript">
                alert('Logo for POS uploaded successfully!');
            </script>
    
            <?php
        }
        
        $sql = "UPDATE pos_config SET company_name = '$company_name', company_image = '$filelocation_logo', company_pdf_image = '$filelocation_pdf', last_updated = NOW() WHERE id = '1'";
        //echo $sql;

        if ($conn->query($sql) === TRUE) 
        {
            ?>

            <script type="text/javascript">
                alert('Company information updated successfully!');
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
