
        <!-- jQUERY --> 
<script src="js/jquery.min.js"></script>

<?php

include("include/dbconnect.php");
include_once "include/session.php";

$sql = "SELECT * FROM inventory WHERE notify = '0'";
$result = mysqli_query($conn,$sql);
$total = 0;
$inventories = "";
        while($r = mysqli_fetch_assoc($result)){


            if($r['quantity'] < 10){
 
                $id = $r['inventory_id'];

                $total += 1;
                $inventories .= $r['name'].' ';
                
   $sql = "UPDATE inventory SET notify = '1' WHERE inventory_id = $id";
   $result1 = mysqli_query($conn,$sql);
                
            }
            
            if($total >= 1){
                 ?>
                             <script>
                              $(document).ready(function(){
              swal({
              title: "Inventory Alert !",
              text: "<?php echo $inventories; ?>",
              type: "warning"
              //closeOnCancel: false
            });
               }); 
            
      
                </script>;
<?php
   
                
            }
      
        

        }

?>



 <!-- ALL REFERENCE LINKS TO JS AND CSS -->
        
<!--
         jQuery 
            <script>
             $(document).ready(function(){
            
            swal({
              title: "Are you sure?",
              text: "You will not be able to recover this imaginary file!",
              type: "warning"
              //closeOnCancel: false
            });
            
        }); 
                </script>
                    
            
            
-->
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
 <!-- jQUERY -->
        <script src="js/jquery.min.js"></script>
        <!--.......................-->

