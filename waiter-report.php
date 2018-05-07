<?php

include("include/dbconnect.php");

include_once "include/session.php";
include("include/sidebar.php");

if(isset($_POST['inventory_name']) && isset($_POST['inventory_quan'])){
    
    $name = $_POST['inventory_name'];
    $quan = $_POST['inventory_quan'];
    $sql = "INSERT INTO inventory(name,quantity,status) VALUES('$name','$quan','')";

        if ($conn->query($sql) === TRUE) 
        {
            
      

      

           echo "<script>//alert('Inventory added Successfully')</script>";
                    
                    

                //location.replace("category.php");

 

      
            
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
        
        <script type="text/javascript" charset="utf-8">

            
             function showConfirmModal(id){
             //   //alert(id);
                 $('#confirmmodal').modal('show');
                                $('#confirmmodal').find('#delete_btn_yes').click(function(){
                 
                  
   $.ajax( { type : 'POST',
          data : { inventoryidfordelete:id},
          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
          

            window.location.href = '';
              
              
              // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            //alert( "error" );
          }
        });
                    
                    
                });
                
            }
            function getreports(){
                //alert("clicked");
                 var date_from = $('#dtp_input1').val();
                var date_to = $('#dtp_input2').val();
                             
   $.ajax( { type : 'POST',
          data : { datefrom_waiterreport:date_from,dateto_waiterreport:date_to},
          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
          
              //alert(data);
              var json = JSON.parse(data);

               $("#reports").html("");
        //alert(json.length);
              
              for(var i =0;i<json.length;i++){
                  
                  $("#reports").append("<tr><td>"+json[i].waiter_name+"</td> <td>"+json[i].sales+"</td> </tr>");
                  
              }
              
              
              
              
              
              
              // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            //alert( "error" );
          }
        });     
                
                
                
            }
         
       
   
            
            
//            function showConfirmModal(id){
//             //   //alert(id);
//                 $('#confirmmodal').modal('show');
//                                $('#confirmmodal').find('#delete_btn_yes').click(function(){
//                 
//                  
//   $.ajax( { type : 'POST',
//          data : { tableidfordelete:id},
//          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
//          success: function ( data ) {
//          
//
//            window.location.href = '';
//              
//              
//              // <=== VALUE RETURNED FROM FUNCTION.
//          },
//          error: function ( xhr ) {
//            //alert( "error" );
//          }
//        });
//                    
//                    
//                });
//                
//            }
//
//            // Document Ready Function to start showing notification on page
//            $(document).ready(function(){
//
//                waitForMsg();
//
//            });
//            
//            // Function to bind orders count to show notification on page
//            function addmsg(type, msg)
//            {
//                $('#notification_count').html(msg);
//            }
//            
//            // Funtion to fetch the count of orders from select.php page
//            function waitForMsg()
//            {
//                $.ajax({
//                type: "GET",
//                url: "select.php",
//
//                async: true,
//                cache: false,
//                timeout:50000,
//
//                success: function(data)
//                {
//                    addmsg("new", data);
//                    setTimeout
//                    (
//                        waitForMsg,
//                        1000
//                    );
//                },
//                error: function(XMLHttpRequest, textStatus, errorThrown)
//                {
//                    addmsg("error", textStatus + " (" + errorThrown + ")");
//                    setTimeout
//                    (
//                        waitForMsg,
//                        15000
//                    );
//                }
//                });
//            };
//
//            ////alerts to show notification panel once new order is submitted
//            var old_count = 0;
//            var i = 0;
//            setInterval(function(){    
//            $.ajax({
//                type : "POST",
//                url : "notify.php",
//                success : function(data){
//                    if (data > old_count) { if (i == 0){old_count = data;} 
//                        else
//                        {
//
//                            //alertify.success("<h4>One new order has been placed!</h4><a href='recent_orders.php' style='text-decoration: none; text-shadow: none;'>Click to view</a>", "", 0);
//
//                            old_count = data;
//                        }
//                    } i=1;
//                }
//            });
//            },1000);

        </script>
        
        <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css"/>
        
    </head>
    
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        
        <?php include("include/header.php"); ?>
        <?php //include("include/sidebar.php"); ?>
        
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

                    <h2>WAITERS</h2>
                    <div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>NO OF SALES</th>
                                  
                                </tr>
                            </thead>
                            <tbody id="reports">
                                
                              
                            </tbody>
                        </table>
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
    
        <!-- //alertIFY -->
    
        <!-- JavaScript -->
        <script src="//alertify///alertify.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="//alertify///alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//alertify/default.min.css"/>
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//alertify/semantic.min.css"/>
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//alertify/bootstrap.min.css"/>

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
