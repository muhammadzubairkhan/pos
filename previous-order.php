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
            
            .modal-dialog {
             position:absolute;
             top:50% !important;
             transform: translate(0, -50%) !important;
             -ms-transform: translate(0, -50%) !important;
             -webkit-transform: translate(0, -50%) !important;
             margin:auto 5%;
             width:90%;
             height:70%;
            }
            
            .modal-content {
             min-height:100%;
             position:absolute;
             top:0;
             bottom:0;
             left:0;
             right:0;
            }
            
            .modal-body {
             position:absolute;
             top:5px;
             bottom:45px;
             left:0;
             right:0;
            }
            
          
            
            .modal .modal-body
            {
                max-height: 500px;
                overflow-y: auto;
            }
            
        </style>
        
        <script type="text/javascript" charset="utf-8">

                        
            
           
            
            function fetchorders(){
                

                var date_from = $('#dtp_input1').val();
                var date_to = $('#dtp_input2').val();
                
                   $.ajax( { type : 'POST',
          data : { datefrom:date_from,dateto:date_to},
          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
          
              var json = JSON.parse(data);
              
              $("#prev_orders").html("");
              
              for(var i= 0;i<json.length;i++){
                  
                  $("#prev_orders").append('<tr><td>'+json[i].customer_id+'</td> <td>'+json[i].date_time+'</td> <td> <button type="button" class="btn btn-primary btn-sm"  onclick="orderdetails(\''+json[i].customer_id+'\');"  data-toggle="modal" data-target="#myModal"><i class="fa fa-eye""></i> VIEW</button> </td></tr>')
                  
                  
                  
              }
              
              
              // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            //alert( "error" );
          }
        });
                
                
        
                
                
                
            }

            
            
            
         $(document).ready(function(){
             
             
        $("#searchbox").keyup(function(){
            
            //alert(this.value);
            
            
                               $.ajax( { type : 'POST',
          data : { keywordforresult:this.value},
          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
          
              //alert(data);
              var json = JSON.parse(data);
              
              $("#prev_orders").html("");
              
              for(var i= 0;i<json.length;i++){
                  
                  $("#prev_orders").append('<tr><td>'+json[i].customer_id+'</td> <td>'+json[i].date_time+'</td> <td> <button type="button" class="btn btn-primary btn-sm" onclick="orderdetails(\''+json[i].customer_id+'\');" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i> VIEW</button></td></tr>')
                  
              }
              
              
              // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            //alert( "error" );
          }
        });
              
        });
            
         });
 function orderdetails(cust_id){
                
                //alert('aa'+cust_id);
          $.ajax( { type : 'POST',
          data : { orderbycustomerid:cust_id},
          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
          
              //alert(data);
              var json = JSON.parse(data);
              
              $("#orders").html("");
              
              for(var i= 0;i<json.length;i++){
                  
                  $("#orders").append('<tr><td>'+json[i].p_name+'</td> <td id="p_price">'+json[i].p_price+'</td> <td><input type="text" value="'+json[i].quantity+'" disabled /></td><td>'+json[i].date_time+'</td><td> <button type="button" class="btn btn-primary btn-sm" onclick="editOrder(this);"> EDIT</button></td></tr>')
                  
                  
 
              }
              
              
              // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            //alert( "error" );
          }
        });
                
            }
                 function editOrder(row){
                   
         var roww = row.parentNode.parentNode.rowIndex;
         var quanboxes = $('#orders tr td input'); 
         var priceboxes = $('#orders tr p_price'); 
         var btn = $('#orders tr td button');             
         var quanbox =  quanboxes.get(roww-1);
         var pricebox =  priceboxes.get(roww-1);
         if(quanbox.disabled == true){
               $(row).html("Done");
             $(row).removeClass('btn btn-primary btn-sm');
              $(row).addClass('btn btn-success btn-sm');
             alert(btn.get(roww-1));
            quanbox.disabled = false; 
         }else{
    
            $(row).html("Edit");
      $(row).removeClass('btn btn-success btn-sm');
              $(row).addClass('btn btn-primary btn-sm');

             
            quanbox.disabled = true; 
         }
        
                      
                     
        // alert(quanbox);
                     
                                  
                     
    
//      
//         
//     
//         var increamentquan = currentquan + 1;
//         var newprice =  (currentprice/currentquan) * (increamentquan);
//            if(increamentquan > 0){
//         quanbox.get(roww-1).value = increamentquan;
//         pricebox.get(roww-1).innerHTML = newprice;
//                calculatetotal();
//         }
         
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
                                    <button type="button" class="btn btn-primary btn-lg" onclick="fetchorders();" />Generate <i class="fa fa-print"></i>
                               </div>
                    </form>
                </div>
                
                <div class="col-md-12">

    
                   <form class="form-horizontal">
                      <div class="form-group">
                        <span class="pull-left col-sm-7" style="font-size:28px;"><b>PREVIOUS ORDERS</b></span>
                        <div class="col-sm-5">
                          <input class="form-control" id="searchbox" type="text" placeholder="Search..">
                        </div>
                      </div>
                       
                  </form>

                    <div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>CUSTOMER ID</th>
                                    <th>DATE</th>
                                    <th>ORDERS</th>

                                </tr>
                            </thead>
                            <tbody id="prev_orders">
                                

 

                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>    
        </div>

    </div>

</div>
    
    
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>Options</th>

                                </tr>
                            </thead>
                            <tbody id="orders">
                               
                            </tbody>
                        </table>
      </div>
      <div class="modal-footer">
              <button type="button" class="btn btn-default">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    
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
