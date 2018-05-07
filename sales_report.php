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

        <title>Point of Sales - Sales Report</title>
        
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

            
             function showConfirmModal(id)
             {
                 $('#confirmmodal').modal('show');
                 $('#confirmmodal').find('#delete_btn_yes').click(function()
                 {
                   $.ajax({ type : 'POST',
                            data : { inventoryidfordelete:id},
                            url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                            success: function ( data ) {
                                //alert(data);
                                window.location.href = '';

                                // <=== VALUE RETURNED FROM FUNCTION.
                            },
                            error: function ( xhr ) {
                                //alert( "error" );
                            }
                        });

                 });
                
            }
            
            function getreports()
            {
                var date_from = $('#dtp_input1').val();
                var date_to = $('#dtp_input2').val();
                             
                $.ajax( { type : 'POST',
                          data : { datefrom_salesreport:date_from,dateto_salesreport:date_to},
                          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                          success: function ( data ) {
    
                                //alert(data);
                                var json = JSON.parse(data);
              
                                for(var i =0;i<json.length;i++)
                                {
                                    $("#reports").append("<tr><td>"+json[i].p_name+"</td> <td>"+json[i].price+"</td> <td>"+json[i].price+"</td><td>"+json[i].quantity+"</td></tr>");
                                }
              
                                $("#generate_pdf").attr("href","reports/sales_report.php?sales_date_from="+date_from+"&sales_date_to="+date_to);
                          
                                // <=== VALUE RETURNED FROM FUNCTION.
                          },
                          error: function ( xhr ) {
                            //alert( "error" );
                          }
                        });     
            }
            
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
                <div class="jumbotron text-center">
                    <h1 class="page-header"><center><h1>SALES REPORT</h1></center></h1>
                </div>
                
                <div class="col-md-12">
                    <form action="" class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="dtp_input1" class="col-md-2 control-label">From</label>
                                <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16" id="dtp_input1" type="text" value="" readonly>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                <input type="hidden" value="" /><br/>
                            </div>
                            <div class="form-group">
                                    <label for="dtp_input2" class="col-md-2 control-label">To</label>
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                        <input class="form-control" size="16" id="dtp_input2" type="text" value="" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" value="" /><br/>
                            </div>
                            <div class="form-group">
                                  <label class="col-md-2 control-label"></label>
                                    <button type="button" class="btn btn-primary btn-lg" onclick="getreports();" />Generate <i class="fa fa-print"></i>
                            </div>
                    </form>
                </div>
                
                <div class="col-md-12">

                    <h2>SALES BY ITEM</h2>
                    <div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>PRICE</th>
                                    <th>QUANTITY</th>
                                </tr>
                            </thead>
                            <tbody id="reports">
                                
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <a id="generate_pdf" class="btn btn-success" href=""> GENERATE PDF</a>
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