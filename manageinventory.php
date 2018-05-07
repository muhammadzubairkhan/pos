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

        <title>Manage Inventory - Point of Sales</title>

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

    function send_request(){

        var getval = $('#asd').val();
        //alert(getval);
    }
    function checklist(){
        
        var e = document.getElementById("inventories");

        var temp = document.getElementById("categories");
        var cat_id = temp.options[temp.selectedIndex].value;

        //alert(cat_id);

        var count = $('#inventories tr').length;
        var checks = $('#inventories tr td #chk');
        var deducted_quan = $('#inventories tr td #deducted_quan');
        var prod_ids = $('#inventories tr #p_id');
    
        var arr = [];  
        
    for (var i = 0; i < count; i++)
    {

         if(checks.get(i).checked)
             
        {
             var quan = deducted_quan.get(i).value;
      
            var id = prod_ids.get(i).innerHTML;
       
            
            var obj = {id:id, quan:quan};
            arr.push(obj);
        
             
        }
      
    }
        if(arr.length > 0){
            
                 $.ajax( { type : 'POST',
           data : { dataforinventory:JSON.stringify(arr) , cat_id:cat_id},
           url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
           success: function ( data ) {
             alert("Product Inventory Updated");
               //alert("sads");// <=== VALUE RETURNED FROM FUNCTION.
           },
           error: function ( xhr ) {
             alert( "error" );
           }
         });
        }
    
    }
    function enabletextbox(row){
        var i= row.parentNode.parentNode.rowIndex;
         var e = document.getElementById("inventories");
        if(e.rows[i-1].cells[3].children[0].disabled == true){
            
           e.rows[i-1].cells[3].children[0].disabled = false;
             
        
        }else{
            e.rows[i-1].cells[3].children[0].disabled = true;
        }
        
    }

    // function send_request(){
    //
    //   //  alert( "Hello" );
    //        var name = $('#waiter_name').val();
    //            $.ajax( { type : 'POST',
    //       data : { waitername:name},
    //       url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
    //       success: function ( data ) {
    //         alert( data );               // <=== VALUE RETURNED FROM FUNCTION.
    //       },
    //       error: function ( xhr ) {
    //         alert( "error" );
    //       }
    //     });
    //
    // }





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
            <label>Add Category</label><br>
            <select class="form-control" id="categories">
                    
                <?php
                  $getData = "SELECT * FROM menu_products";
                                $qur = $conn->query($getData);
                                
                                while($r = mysqli_fetch_assoc($qur)){
                                    ?>
                
                        <option value="<?php echo $r['p_id'] ?>"><?php echo $r['p_name']  ?></option>
                <?php
                                }
                
                ?>
<!--     <option value="Category1">Category1</option>
    <option value="Category2">Category2</option>
    <option value="Category3">Category3</option>
    <option value="Category4">Category4</option> -->
  </select>
</div>

            <label>Inventory</label><br> 
            <!-- <input type="text" class="form-control" placeholder="Product Name...">
            <br>
            <input type="text" class="form-control" placeholder="Product Price...">
            <br> -->


            <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody id="inventories">
                              <?php

                              $getData = "SELECT * FROM inventory";
                              $qur = $conn->query($getData);

                              while($r = mysqli_fetch_assoc($qur)){

                                  $status = '';
                                  if($r['status'] == '0'){
                                      $status = 'Active';

                                  }else{

                                        $status = 'Inactive';
                                  }


                              ?>

                                    <tr>

                                 <td id="p_id"><?php echo $r['inventory_id']; ?></td>

                                  <td id="<?php echo 'td_0213_'.$r['inventory_id'] ?>">
                                      <input type="checkbox" id="chk"  onclick="enabletextbox(this);"  />    
                                      <span> <?php echo $r['name']  ?></span>
                                      
                                  </td>
                                  <td><?php echo $status ?></td>
                                  <td>
                                      <input type="text" disabled id="deducted_quan" class="form-control" placeholder="Deducted Amount...">
                                  </td>
                              </tr>
                              <?php


}

                              ?>

                          </tbody>
                        </table>
                    </div>

            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="button" onclick="checklist();" class="btn btn-primary">Add</button>
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
            <!-- <div class="form-group">

            <button type="button" onclick="send_request();" class="btn btn-primary">Add</button>
            </div> -->
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
