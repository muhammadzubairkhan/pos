<?php

include("include/dbconnect.php");
include_once "include/session.php";

$cust_id = base_convert(time(), 10, 36);

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

        <script type="text/javascript">

    
                  var orderData = [];  

        function appendOrders(tr, id, price){

          document.getElementById("settle_Btn").disabled = false;

             var obj = {p_id:id, p_name:tr};
            orderData.push(obj);
            
            
            $('#orders').append('<tr><td><center><button class="btn btn-success" onclick="increasecounter(this)" type="button">+</button><input type="text" id="val" value="1" disabled class="" style="text-align:center; width: 25%; margin: 0px 10px 0px 10px;"><button class="btn btn-warning" type="button" onclick="decreasecounter(this);">-</button></td></center><td><center><button class="btn btn-danger" id="deleterow" onclick="deleteRow(this);"; type="button">Delete</button></center></td><td id="product_name"><center>'+tr+'</center></td><td id="pricebox">'+price+'</td></tr>');
            calculatetotal();
            
        }
                function printKitchenReceipt(cust_id,amount){
                       var quanbox = $('#orders tr td #val');
                var pricebox = $('#orders tr #pricebox');
       

                var e = document.getElementById("waiter");
                var wat_id = e.options[e.selectedIndex].value;
                ////alert(wat_id);
                            
                            

                for(var i = 0;i<quanbox.length;i++){
                    
                    var currentquan =  parseInt(quanbox.get(i).value);
                    var currentprice =  parseInt(pricebox.get(i).innerHTML);
                    orderData[i]["p_quan"] = currentquan;
                    orderData[i]["p_price"] = currentprice;
                    
                  //  //alert("quan  "+currentquan);
                    ////alert(orderData[i].p_quan);
                    
                }
            
                                   
          $.ajax( { type : 'POST',
          data : { data:JSON.stringify(orderData),waiter_id:wat_id,custid:cust_id,givenamount:amount},
          url  : 'escpos-php-master/example/interface/self-test.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {
          
          //  //alert("OK   "+data);
            window.location.href = '';
              
              
              // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            ////alert( "error  "+xhr );
          }
        });
                
            }
            
            
     function increasecounter(row){
         
         var roww = row.parentNode.parentNode.parentNode.rowIndex;
         
         ////alert(roww);
         
         var quanbox = $('#orders tr td #val');
         var pricebox = $('#orders tr #pricebox');
         
        
         var currentquan =  parseInt(quanbox.get(roww-1).value);
         var currentprice =  parseInt(pricebox.get(roww-1).innerHTML);
      
         
     
         var increamentquan = currentquan + 1;
         var newprice =  (currentprice/currentquan) * (increamentquan);
            if(increamentquan > 0){
         quanbox.get(roww-1).value = increamentquan;
         pricebox.get(roww-1).innerHTML = newprice;
                calculatetotal();
         }
         
     }
            
            function calculatetotal(){
            
            var totalprice = 0;    
             var pricebox = $('#orders tr #pricebox');
             //alert(pricebox.length);
                for(var i = 0;i<pricebox.length;i++){
                    
                    var eachprice = parseInt(pricebox.get(i).innerHTML);

                    totalprice += eachprice;
                    
                    
                }
               // //alert(totalprice);
               
                $('#totaltxt').html(totalprice);
                
            }
            function CatSelect(temp){                   
                var cat_id = temp
                ////alert(cat_id);
                $.ajax( { type : 'POST',
                data : { SendCatId:cat_id},
                url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                success: function ( data ) {
                    
                    //alert(data);

                    var temp2 = JSON.parse(data);
                  
                

                        ////alert(temp2);

                        document.getElementById("products_tb").innerHTML = "";

                     for(var i=0; i <temp2.length; i++){

                $("#products_tb").append('<tr onclick="appendOrders(\'' + temp2[i].p_name + '\','+temp2[i].p_id+','+temp2[i].p_price+','+temp2[i].p_id+')"><td>'+ temp2[i].p_name +'</td></tr>');

                        ////alert(temp2[i].p_name);
                    }

                    ////alert(temp2.length);
                    //temp2 = "";
                    ////alert(temp2);
                    
                    //window.location.href = '';
                    // <=== VALUE RETURNED FROM FUNCTION.
                },
                error: function ( xhr ) {
                    //alert( "error" );
                }
                });

            }

 function decreasecounter(row){
         
  var roww = row.parentNode.parentNode.parentNode.rowIndex;
         
         ////alert(roww);
         
         var quanbox = $('#orders tr td #val');
         var pricebox = $('#orders tr #pricebox');
         
        
         var currentquan =  parseInt(quanbox.get(roww-1).value);
         var currentprice =  parseInt(pricebox.get(roww-1).innerHTML);
         
           
     
         var increamentquan = currentquan - 1;
         var newprice =  (currentprice/currentquan) * (increamentquan);
     
         if(increamentquan > 0){
         quanbox.get(roww-1).value = increamentquan;
         pricebox.get(roww-1).innerHTML = newprice;
              calculatetotal();
           }
     }

            
        function deleteRow(row)
        {
         //   //alert(row);
            var roww = row.parentNode.parentNode.parentNode.rowIndex;
            //alert(roww-1);
            orderData.splice(roww-1, 1);
            //alert(orderData);
            $(row).closest('tr').remove();
            calculatetotal();
            
           
            
        }
            function submitorder(amount){
                ////alert("length  "+orderData.length);

                var quanbox = $('#orders tr td #val');
                var pricebox = $('#orders tr #pricebox');
            
                

                var e = document.getElementById("waiter");
                var wat_id = e.options[e.selectedIndex].value;
    
                ////alert(wat_id);

                for(var i = 0;i<quanbox.length;i++){
                    
                    var currentquan =  parseInt(quanbox.get(i).value);
                    var currentprice =  parseInt(pricebox.get(i).innerHTML);
                    orderData[i]["p_quan"] = currentquan;
                    orderData[i]["p_price"] = currentprice;
                    ////alert(orderData[i].p_quan);
                    
                }


                $.ajax( { type : 'POST',
                data : { OrderDetailsForTakeaway:JSON.stringify(orderData), waiter_id:wat_id,custid:'<?php echo $cust_id ?>'},
                url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                success: function ( data ) {
                    
                    //alert(data);

                    
                },
                error: function ( xhr ) {
                    //alert( "error" );
                }
                });
                
                

                printKitchenReceipt('<?php echo $cust_id ?>',amount);

            //      for(var i=0;i<orderData.length;i++){
                
            //     //alert(orderData[i].p_quan);
            //     //alert(orderData[i].p_name);
            //     //alert(orderData[i].p_price);



            // }
            }
            
            

        function handleSelect() {

              document.getElementById("category_select").disabled = false;
              
         }

//
//        $(document).ready(function(){
//            $(".product").click(function(){
//
//                $(".show_product").append("<div class='cotainer-fluid' style='border-bottom:1px solid black; height:50px; width: 100%;'><div class='pull-left' style='font-size: 20px; margin-top: 10px;'>Product 1</div><div class='pull-right' style='font-size: 5px; margin-top: 10px;'><i class='fa fa-plus'></i><i class='fa fa-remove'></i></div><div class='pull-right' style='font-size: 5px; margin-top: 6px;'><input type='text' class='form-control form-inline' style='width:50px;'> </div></div>");
//
//
//
//            });
//
//            $(".product_name").click(function(){
//                //alert("Product: " + $(this).html());
//            });
//
//            $(".product_price").click(function(){
//                //alert("Price: " + $(this).html());
//            });
//        });

        </script>



        <style type="text/css">
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}


/* Basic reset */
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;

	/* Better text styling */
	font: bold 14px Arial, sans-serif;
}

/* Finally adding some IE9 fallbacks for gradients to finish things up */

/* A nice BG gradient */
html {
	height: 100%;
	background: white;
	background: radial-gradient(circle, #fff 20%, #ccc);
	background-size: cover;
}

/* Using box shadows to create 3D effects */
#calculator {
	width: auto;
	height: auto;

	
	padding: 20px 20px 9px;

/*	background: #9dd2ea;*/
	background: #949391;
	border-radius: 3px;
}

/* Top portion */
.top span.clear {
	float: left;
}

/* Inset shadow on the screen to create indent */
.top .screen {
	height: 40px;
	width: 212px;

	float: right;

	padding: 0 10px;

	background: rgba(0, 0, 0, 0.2);
	border-radius: 3px;
	box-shadow: inset 0px 4px rgba(0, 0, 0, 0.2);

	/* Typography */
	font-size: 17px;
	line-height: 40px;
	color: white;
	text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
	text-align: right;
	letter-spacing: 1px;
}

/* Clear floats */
.keys, .top {overflow: hidden;}

/* Applying same to the keys */
.keys span, .top span.clear {
	float: left;
	position: relative;
	top: 0;

	cursor: pointer;

	width: 66px;
	height: 36px;

	background: white;
	border-radius: 3px;
	box-shadow: 0px 4px rgba(0, 0, 0, 0.2);

	margin: 0 7px 11px 0;

	color: #888;
	line-height: 36px;
	text-align: center;

	/* prevent selection of text inside keys */
	user-select: none;

	/* Smoothing out hover and active states using css3 transitions */
	transition: all 0.2s ease;
}

/* Remove right margins from operator keys */
/* style different type of keys (operators/evaluate/clear) differently */
.keys span.operator {
	background: #d2d3d7;
	margin-right: 0;
}

.keys span.eval {
	background: #f7ae43;
	color: #888e5f;
}
            

.top span.clear {
	background: #ff9fa8;
	box-shadow: 0px 4px #ff7c87;
	color: white;
}

/* Some hover effects */
.keys span:hover {
	background: #9c89f6;
	box-shadow: 0px 4px #6b54d3;
	color: white;
}

.keys span.eval:hover {
	background: #abb850;
	box-shadow: 0px 4px #717a33;
	color: #ffffff;
}

.top span.clear:hover {
	background: #f68991;
	box-shadow: 0px 4px #d3545d;
	color: white;
}

/* Simulating "pressed" effect on active state of the keys by removing the box-shadow and moving the keys down a bit */
.keys span:active {
	box-shadow: 0px 0px #6b54d3;
	top: 4px;
}

.keys span.eval:active {
	box-shadow: 0px 0px #717a33;
	top: 4px;
}

.top span.clear:active {
	top: 4px;
	box-shadow: 0px 0px #d3545d;
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
            <div class="form-group">

                <!-- <div class="col-md-4 col-sm-12 col-xs-12"> -->


                  <div class="form-group">
                  <h2>Select Waiter</h2>
<select class="form-control" id="waiter" onchange="handleSelect()">

                    <option value="" disabled selected>Select Waiter</option>
                        <?php
                      $getData = "SELECT * FROM waiters";
                                    $qur = $conn->query($getData);
                                    
                                    while($r = mysqli_fetch_assoc($qur)){
                                        ?>
                    
                    
                            <option value="<?php echo $r['id'] ?>"><?php echo $r['name']  ?></option>
                    <?php
                                    }
                    
                    ?>
</select>

      </div>

      <div class="form-group">
      <h2>Select Catergory</h2>
<select class="form-control" id="category_select" onchange="CatSelect(this.value)">

                <option value="" disabled selected>Select Category</option>
                        <?php
                  $getData = "SELECT * FROM menu_categories";
                                $qur = $conn->query($getData);
                                
                                while($r = mysqli_fetch_assoc($qur)){
                                    ?>
                
                
                        <option value="<?php echo $r['category_id'] ?>" ><?php echo $r['cat_name']  ?></option>
                <?php
                                }
                
                ?>

</select>

</div>


<div class="row">
    <div class="col-md-12">
<h2>Products</h2>
</div>
</div>

<div class="row">
  <div class="col-md-6">


<div >
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><center>Update Product</center></th>
                <th><center>Delete</center></th>
                <th><center>Selected Products</center></th>
                <th><center>Price</center></th>


            </tr>
        </thead>
        <tbody id="orders">




        </tbody>
    </table>
    
    
    
     <table class="table table-bordered table-hover">
        <tbody>
            
         <tr>
             <td colspan="3">TOTAL</td>
             <td id="totaltxt" >0</td>
         </tr>

        </tbody>
    </table>
    
</div>

      <button id="settle_Btn" class="btn btn-primary btn-sm" onclick="settle();" style="width: 100px;" type="button" disabled>Settle </button>
</div>




  <div class="col-md-6">

    <div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>

                <th>Avialable Products</th>

            </tr>
        </thead>
        <tbody id="products_tb">

            





        </tbody>
    </table>
  </div>
</div>

</div>



        </div>

    <!-- </div> -->
</div>

</div>
    
    <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>

      
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Products</th>
                        <th>Quantity</th>
                        <th>Price</th>
                      </tr>
                    </thead>
                    <tbody id="table_products">

                    </tbody>
                  </table>
                            <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Total</th>
                        <th id="modal-total">0</th>
                      </tr>
                    </thead>
            
                  </table>
            </div>

        
        

        
            <div class="col-md-4">
                <div id="calculator">

                        <!-- Screen and clear key -->
                        <div class="top">
                            <span class="clear">C</span>
                            <div class="screen"></div>
                        </div>

                        <div class="keys">
                            <!-- operators and other keys -->
                            <span>1</span>
                            <span>2</span>
                            <span>3</span>
                            
                            <span>4</span>
                            <span>5</span>
                            <span>6</span>
                            
                            <span>7</span>
                            <span>8</span>
                            <span>9</span>
                            
                            
                            
                            
                            
                            <span>0</span>
                       
                            <span class="eval">DONE</span>
                            
                        </div>

                </div>
            </div>
            
        </div>
            

        </div>
    </div>
      
    
        
    

    <!-- PrefixFree -->
    <script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript">
    // Get all the keys from document

    </script>


    <script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("settle_Btn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
//
//<tr><td><center><button class="btn btn-success" onclick="increasecounter(this)" type="button">+</button><input type="text" id="val" value="1" disabled class="" style="text-align:center; width: 25%; margin: 0px 10px 0px 10px;"><button class="btn btn-warning" type="button" onclick="decreasecounter(this);">-</button></td></center><td><center><button class="btn btn-danger" id="deleterow" onclick="deleteRow(this);"; type="button">Delete</button></center></td><td id="product_name"><center>'+tr+'</center></td><td id="pricebox">'+price+'</td></tr>
        modal.style.display = "block";
        
        
                     var pricebox = $('#orders tr #pricebox');
                     var p_name = $('#orders tr #product_name');
                     var p_quan = $('#orders tr #val');

        //alert(p_name.length);
                for(var i = 0;i<p_name.length;i++){
                
                         $("#table_products").append('<tr><td>'+p_name.get(i).innerHTML+'</td><td>'+p_quan.get(i).value+'</td><td>'+pricebox.get(i).innerHTML+'</td></tr');
                    
                    
                }
       
        var total = $('#totaltxt').text();
             $('#modal-total').html(total);      
        
        
    }

    
//$("body").on('DOMSubtreeModified', ".screen", function() { 
//
//
//
//});
        
        

//$( "#target" ).keyup(function() {
//  //alert( "Handler for .keyup() called." );
//});
    

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


    var keys = document.querySelectorAll('#calculator span');
    var operators = ['+', '-', 'x', '÷'];
    var decimalAdded = false;

    // Add onclick event to all the keys and perform operations
    for(var i = 0; i < keys.length; i++) {
      keys[i].onclick = function(e) {
        // Get the input and button values
        var input = document.querySelector('.screen');
        var inputVal = input.innerHTML;
        var btnVal = this.innerHTML;

        // Now, just append the key values (btnValue) to the input string and finally use javascript's eval function to get the result
        // If clear key is pressed, erase everything
        if(btnVal == 'C') {
          input.innerHTML = '';s
          decimalAdded = false;
        }

  
        // If eval key is pressed, calculate and display the result
        else if(btnVal == 'DONE') {
     
            var total = parseInt($('#totaltxt').text());
            var inputvalue = parseInt(input.innerHTML);
            
            if(inputvalue >= total){
                
                submitorder(inputvalue);
                
            }else{
               //alert('not ok');  
            }
            
            
        }

        // Basic functionality of the calculator is complete. But there are some problems like
        // 1. No two operators should be added consecutively.
        // 2. The equation shouldn't start from an operator except minus
        // 3. not more than 1 decimal should be there in a number

        // We'll fix these issues using some simple checks

        // indexOf works only in IE9+
        else if(operators.indexOf(btnVal) > -1) {
          // Operator is clicked
          // Get the last character from the equation
          var lastChar = inputVal[inputVal.length - 1];

          // Only add operator if input is not empty and there is no operator at the last
          if(inputVal != '' && operators.indexOf(lastChar) == -1)
            input.innerHTML += btnVal;

          // Allow minus if the string is empty
          else if(inputVal == '' && btnVal == '-')
            input.innerHTML += btnVal;

          // Replace the last operator (if exists) with the newly pressed operator
          if(operators.indexOf(lastChar) > -1 && inputVal.length > 1) {
            // Here, '.' matches any character while $ denotes the end of string, so anything (will be an operator in this case) at the end of string will get replaced by new operator
            input.innerHTML = inputVal.replace(/.$/, btnVal);
          }

          decimalAdded =false;
        }

        // Now only the decimal problem is left. We can solve it easily using a flag 'decimalAdded' which we'll set once the decimal is added and prevent more decimals to be added once it's set. It will be reset when an operator, eval or clear key is pressed.
        else if(btnVal == '.') {
          if(!decimalAdded) {
            input.innerHTML += btnVal;
            decimalAdded = true;
          }
        }

        // if any other key is pressed, just append it
        else {
          input.innerHTML += btnVal;
        }

        // prevent page jumps
        e.preventDefault();
      }
    }

    </script>




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
