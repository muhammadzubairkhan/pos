<?php

include("include/dbconnect.php");
include_once "include/session.php";

if(isset($_POST['inventory_name']) && isset($_POST['inventory_quan'])){
    
    $name = $_POST['inventory_name'];
    $quan = $_POST['inventory_quan'];
    $sql = "INSERT INTO inventory(name,quantity,status) VALUES('$name','$quan',0)";

        if ($conn->query($sql) === TRUE) 
        {
            
      

      

           echo "<script>alert('Inventory added Successfully')</script>";
                    
                    

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

        <title>Inventory - Point of Sales</title>
        
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
            
            #myInput 
            {
                background-image: url('icons/searchicon.png'); /* Add a search icon to input */
                background-position: 10px 12px; /* Position the search icon */
                background-repeat: no-repeat; /* Do not repeat the icon image */
                width: 100%; /* Full-width */
                font-size: 16px; /* Increase font-size */
                padding: 12px 20px 12px 40px; /* Add some padding */
                border: 1px solid #ddd; /* Add a grey border */
                margin-bottom: 12px; /* Add some space below the input */
            }
            
        </style>
        
        <script type="text/javascript" charset="utf-8">
             

            function showAjaxModal(id){
       

//            
//                var getValue = document.getElementById('1').value;
//                console.log(getValue);
//                alert(getValue);
                
                //alert(id);
            
                var name = $('#td_0213_'+id).html();
                var quan = $('#td_0211_'+id).html();
                   //alert(name);
                $('#exampleModalLong').modal('show');
                   $('#exampleModalLong').find('#inventory_name').val(name);
                $('#exampleModalLong').find('#inventory_quan').val(quan);
               
                 
                
                $('#exampleModalLong').find('#sumit_btn').click(function(){
                    
                       name = $('#inventory_name').val();
                    quan = $('#inventory_quan').val();
                   
                       $.ajax( { type : 'POST',
          data : { inventory_name:name,inventory_quan:quan,inventory_id:id},
          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
          
            alert(data);
            window.location.href = '';
              
              
              // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            alert( "error" );
          }
        });
                  
                    
                    
                });

                    
                    
           
//           
//                
                // $('#exampleModalLong').html("aaaaaaaaaaaaaaa");
                
                
            }
            
             function showConfirmModal(id){
             //   alert(id);
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
            alert( "error" );
          }
        });
                    
                    
                });
                
            }
            
        </script>
        
        <script type="text/javascript">
            function myFunction() 
            {
              // Declare variables
              var input, filter, table, tr, td, i;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");

              // Loop through all table rows, and hide those who don't match the search query
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }
              }
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
            
           
            
            
            
            <!-- ... Your content goes here ... -->
        </div>
        
            <!-- Page Content -->
     
        
    
        
        
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    
                    
                
<form action="#" method="post">
            <div class="form-group">
            <label>Inventory Name</label>
            <input type="text" class="form-control" name="inventory_name" placeholder="Inventory Name..."/>
                <br>
            <input type="text" class="form-control" name="inventory_quan" placeholder="Inventory Quantity..."/>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Add"/>
            </div>

      </form>              
                    
                    
                    
                    
                    
                    
                    
                    <h2>INVENTORIES</h2>
                    <div>
                        
                        <div class="form-group">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for inventory names..">    
                        </div>
                        
                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>QUANTITY</th>
                                    <th>STATUS</th>
                                    <th>LAST UPDATED ON</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                
                                $getData = "SELECT * FROM inventory";
                                $qur = $conn->query($getData);
                                
                                while($r = mysqli_fetch_assoc($qur)){
                                    
//                                    $status = '';
//                                    if($r['status'] == '0'){
//                                        $status = 'Active';
//                                        
//                                    }else{
//                                        
//                                          $status = 'Inactive';
//                                    }

//$msg[] = array("user_id" => $r['id'] , "fullname" =>$r['firstname'].' '.$r['lastname'] , "displayname" =>$r['displayname'], "image" =>$link.$r['image']);
//                   
                            
                                ?>
                                
                                      <tr>
                                    <td id="<?php echo 'td_0213_'.$r['inventory_id'] ?>"><?php echo $r['name'] ?></td>
                                    <td id="<?php echo 'td_0211_'.$r['inventory_id'] ?>"><?php echo $r['quantity'] ?></td>
                                    <td><div class="btn-group">
                                            <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" type="button">Action <span class="caret"></span></button>
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                <!-- teacher EDITING LINK -->
                                                <li>
                                                    <a href="#" onclick="showAjaxModal(<?php echo $r['inventory_id'] ?>);"><i class="entypo-pencil"></i> Edit</a>
                                                </li>
                                                <li class="divider"></li><!-- teacher DELETION LINK -->
                                                <li>
                                                    <a href="#" class="entypo-pencil" onclick="showConfirmModal(<?php echo $r['inventory_id'] ?>);"><i class="entypo-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td><?php echo $r['lastupdated_on'] ?></td>
                                </tr>
                                <?php
                                    
                                    
}
                                
                                ?>
                                
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

</body>
</html>
