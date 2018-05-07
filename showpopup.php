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

        </style>

        <script type="text/javascript" charset="utf-8">

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

            <html>
<head>
<style>
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
	width: 325px;
	height: auto;

	margin: 100px auto;
	padding: 20px 20px 9px;

	background: #9dd2ea;
	background: linear-gradient(#9dd2ea, #8bceec);
	border-radius: 3px;
	box-shadow: 0px 4px #009de4, 0px 10px 15px rgba(0, 0, 0, 0.2);
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
	background: #FFF0F5;
	margin-right: 0;
}

.keys span.eval {
	background: #f1ff92;
	box-shadow: 0px 4px #9da853;
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



<!-- Trigger/Open The Modal -->

<!-- <input type="text" id="value" value="5"><br><br> -->
<label id="val">15</label><br>
<button id="myBtn" class="btn btn-warning" type="button">Click Here!</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>

    <div id="calculator">
    	<!-- Screen and clear key -->
    	<div class="top">
    		<span class="clear">C</span>
    		<div class="screen"></div>
    	</div>

    	<div class="keys">
    		<!-- operators and other keys -->
    		<span>7</span>
    		<span>8</span>
    		<span>9</span>
    		<span class="operator">+</span>
    		<span>4</span>
    		<span>5</span>
    		<span>6</span>
    		<span class="operator">-</span>
    		<span>1</span>
    		<span>2</span>
    		<span>3</span>
    		<span class="operator">÷</span>
    		<span>0</span>
    		<span>.</span>
    		<span class="eval">=</span>
    		<span class="operator">x</span>
    	</div>
    </div>

    <!-- PrefixFree -->
    <script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript">
    // Get all the keys from document

    </script>



  </div>

</div>




<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {


    modal.style.display = "block";
}

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
      input.innerHTML = '';
      decimalAdded = false;
    }

    // If eval key is pressed, calculate and display the result
    else if(btnVal == '=') {
      var equation = inputVal;
      var lastChar = equation[equation.length - 1];

      // Replace all instances of x and ÷ with * and / respectively. This can be done easily using regex and the 'g' tag which will replace all instances of the matched character/substring
      equation = equation.replace(/x/g, '*').replace(/÷/g, '/');

      // Final thing left to do is checking the last character of the equation. If it's an operator or a decimal, remove it
      if(operators.indexOf(lastChar) > -1 || lastChar == '.')
        equation = equation.replace(/.$/, '');

      if(equation)
        input.innerHTML = eval(equation);

      decimalAdded = false;
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

</body>
</html>



<!-- <button class="btn btn-primary" type="button">Click here!</button> -->


            <!-- ... Your content goes here ... -->
        </div>

            <!-- Page Content -->






        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">










<!--

                            </tbody>
                        </table>
                    </div> -->
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

        <!-- ALERTIFY -->

        <!-- JavaScript -->
        <script src="alertify/alertify.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="alertify/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="alertify/default.min.css"/>
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="alertify/semantic.min.css"/>
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="alertify/bootstrap.min.css"/>


</body>
</html>
