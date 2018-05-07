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

        <title>Items - Point of Sales</title>

        <link rel="icon" type="icons/png" href="icons/mobile-dashboard-icon.png">

        <!-- jQUERY -->
        <script src="js/jquery.min.js"></script>

        <!-- SLIDE DOWN EFFECT ON PRODUCTS, CATEGORIES, ORDERS  -->
        <script type="text/javascript">

            $(document).ready(function()
            {
                    var pressed = false;
                    var chars = [];
                    $(window).keypress(function(e)
                    {
                        if (e.which >= 48 && e.which <= 57)
                        {
                            chars.push(String.fromCharCode(e.which));
                        }

                        console.log(e.which + ":" + chars.join("|"));
                        if (pressed == false)
                        {
                            setTimeout(function()
                            {
                                // check we have a long length e.g. it is a barcode
                                if (chars.length >= 10)
                                {
                                    var barcode = chars.join("");
                                    console.log("Barcode Scanned: " + barcode);
                                    $("#prod_barcode").val(barcode);
                                }

                                chars = [];
                                pressed = false;

                            },500);
                        }

                        pressed = true;
                    });
            });

            $(function ()
            {
                $(this).find('.panel-footer').show();

                /*
                    This code will determine when a code has been either entered manually or
                    entered using a scanner.
                    It assumes that a code has finished being entered when one of the following
                    events occurs:
                    • The enter key (keycode 13) is input
                    • The input has a minumum length of text and loses focus
                    • Input stops after being entered very fast (assumed to be a scanner)
                */

                var inputStart, inputStop, firstKey, lastKey, timing, userFinishedEntering;
                var minChars = 3;

                // handle a key value being entered by either keyboard or scanner
                $("#prod_barcode").keypress(function (e)
                {
                    //alert("Hi");
                    // restart the timer
                    if (timing)
                    {
                        clearTimeout(timing);
                    }

                    // handle the key event
                    if (e.which == 13)
                    {
                        // Enter key was entered
                        // don't submit the form
                        e.preventDefault();

                        // has the user finished entering manually?
                        if ($("#prod_barcode").val().length >= minChars)
                        {
                            userFinishedEntering = true; // incase the user pressed the enter key
                            inputComplete();
                        }
                    }
                    else
                    {
                        // some other key value was entered
                        // could be the last character
                        inputStop = performance.now();
                        lastKey = e.which;

                        // don't assume it's finished just yet
                        userFinishedEntering = false;

                        // is this the first character?
                        if (!inputStart)
                        {
                            firstKey = e.which;
                            inputStart = inputStop;

                            // watch for a loss of focus
                            $("body").on("blur", "#prod_barcode", inputBlur);
                        }

                        // start the timer again
                        timing = setTimeout(inputTimeoutHandler, 500);
                    }
                });

                // Assume that a loss of focus means the value has finished being entered
                function inputBlur()
                {
                    clearTimeout(timing);
                    if ($("#prod_barcode").val().length >= minChars)
                    {
                        userFinishedEntering = true;
                        inputComplete();
                    }
                };


                // reset the page
                $("#reset").click(function (e)
                {
                    e.preventDefault();
                    resetValues();
                });

                function resetValues()
                {
                    // clear the variables
                    inputStart = null;
                    inputStop = null;
                    firstKey = null;
                    lastKey = null;
                    // clear the results
                    inputComplete();
                }

                // Assume that it is from the scanner if it was entered really fast
                function isScannerInput()
                {
                    return (((inputStop - inputStart) / $("#prod_barcode").val().length) < 15);
                }

                // Determine if the user is just typing slowly
                function isUserFinishedEntering()
                {
                    return !isScannerInput() && userFinishedEntering;
                }

                function inputTimeoutHandler()
                {
                    // stop listening for a timer event
                    clearTimeout(timing);
                    // if the value is being entered manually and hasn't finished being entered
                    if (!isUserFinishedEntering() || $("#prod_barcode").val().length < 3)
                    {
                        // keep waiting for input
                        return;
                    }
                    else
                    {
                        reportValues();
                    }
                }

                // here we decide what to do now that we know a value has been completely entered
                function inputComplete()
                {
                    // stop listening for the input to lose focus
                    $("body").off("blur", "#prod_barcode", inputBlur);
                    // report the results
                    reportValues();
                }

                function reportValues()
                {
                    // update the metrics
                    $("#startTime").text(inputStart == null ? "" : inputStart);
                    $("#firstKey").text(firstKey == null ? "" : firstKey);
                    $("#endTime").text(inputStop == null ? "" : inputStop);
                    $("#lastKey").text(lastKey == null ? "" : lastKey);
                    $("#totalTime").text(inputStart == null ? "" : (inputStop - inputStart) + " milliseconds");

                    if (!inputStart)
                    {
                        // clear the results
                        $("#resultsList").html("");
                        $("#prod_barcode").focus().select();
                    }
                    else
                    {
                        // prepend another result item
                        var inputMethod = isScannerInput() ? "Scanner" : "Keyboard";
                        $("#resultsList").html("");
                        $("#resultsList").prepend("<h2>Product Details</h2><div class='resultItem " + inputMethod + "'>" +
                            "<span><b>Barcode Value:</b> " + $("#prod_barcode").val() + "<br/>" +
                            "<span><b>Product Name:</b> " + $("#prod_name").val() + "<br/>" +
                            "<span><b>Product Price:</b> " + $("#prod_price").val() + " Rs<br/>" +
                            //"<span>ms/char: " + ((inputStop - inputStart) / $("#prod_barcode").val().length) + "</span></br>" +
                            //"<span>Input Method: <strong>" + inputMethod + "</strong></span></br>" +
                            "</span></div></br>");

                    }
                }

                $("#prod_barcode").focus();

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

       //  alert( "Hello" );
//            var name = $('#waiter_name').val();
//                $.ajax( { type : 'POST',
//           data : { waitername:name},
//           url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
//           success: function ( data ) {
//             alert( data );               // <=== VALUE RETURNED FROM FUNCTION.
//           },
//           error: function ( xhr ) {
//             //alert( "error" );
//           }
//         });

     }

     function openAjaxModel()
     {
           $('#addcategorymodel').modal('show');
           $('#addcategorymodel').find('#submit_btn').click(function()
           {
                var catname = $('#cat_name').val();

                $.ajax({ type : 'POST',
                         data : { cat_name:catname},
                         url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                         success: function ( data )
                         {
                              $('#addcategorymodel').modal('hide');
                              alert(data);
                              window.location.href = '';
                              // <=== VALUE RETURNED FROM FUNCTION.
                         },
                         error: function ( xhr )
                         {
                            //alert( "error" );
                         }
                    });
         });
    }

    function sendrequest()
    {
        var prod_name =  $('#prod_name').val();
        var prod_price =  $('#prod_price').val();
        var prod_code =  0;//$('#prod_code').val();
        var prod_discount =  $('#prod_discount').val();
        var prod_barcode =  0;//$('#prod_barcode').val();

        alert(prod_name);
        alert(prod_price);
        alert(prod_discount);

        var e = document.getElementById("categories");
        var cat_id = e.options[e.selectedIndex].value;

           $.ajax({  type : 'POST',
                     data : { prodname:prod_name, prodprice:prod_price, proddiscount:prod_discount, catid:cat_id, prodbarcode:prod_barcode },
                     url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                     success: function ( data )
                     {
                        alert(data);
                        //window.location.href = '';

                        // <=== VALUE RETURNED FROM FUNCTION.
                     },
                     error: function ( xhr )
                     {
                        //alert( "error" );
                     }
                  });
    }

    function showAjaxModal(id){


//
//                var getValue = document.getElementById('1').value;
//                console.log(getValue);
//                alert(getValue);

                //alert(id);

                var name = $('#td_0213_'+id).html();
                var price = $('#td_0211_'+id).html();
                var code = 0;//$('#td_0214_'+id).html();
                var discount = $('#td_0210_'+id).html();
                var barcode = 0;//$('#td_0212_'+id).html();
                   //alert(name);
                $('#exampleModalLong').modal('show');
                $('#exampleModalLong').find('#prod_name').val(name);
                $('#exampleModalLong').find('#prod_price').val(price);
                $('#exampleModalLong').find('#prod_discount').val(discount);



                $('#exampleModalLong').find('#sumit_btn').click(function(){


                   name = $('#exampleModalLong').find('#prod_name').val();
                   price =  $('#exampleModalLong').find('#prod_price').val();
                   code =  0;//$('#exampleModalLong').find('#prod_code').val();
                   discount =  $('#exampleModalLong').find('#prod_discount').val();
                   barcode =  0;//$('#exampleModalLong').find('#prod_barcode').val();

//                   alert(name);
//                   alert(price);
//                   alert(id);
//                   alert(barcode);
       $.ajax( { type : 'POST',
          data : { prod_name:name, prod_price:price, prod_code:code, proddiscount: discount, p_id:id, prodbarcode:barcode },
          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
          success: function ( data ) {

            alert(data);
         //   window.location.href = '';


              // <=== VALUE RETURNED FROM FUNCTION.
          },
          error: function ( xhr ) {
            //alert( "error" );
          }
        });



                });




//
//
                // $('#exampleModalLong').html("aaaaaaaaaaaaaaa");


            }

            function showConfirmModal(id)
            {
                 $('#confirmmodal').modal('show');
                 $('#confirmmodal').find('#delete_btn_yes').click(function()
                 {
                       $.ajax({ type : 'POST',
                                data : { productidfordelete:id},
                                url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                                success: function ( data )
                                {
                                   window.location.href = '';
                                   // <=== VALUE RETURNED FROM FUNCTION.
                                },
                                error: function ( xhr )
                                {
                                   //alert( "error" );
                                }
                              });
                });
            }

        </script>

        <style type="text/css">


            .resultItem
            {
                padding 8px;::;
            }

            .Scanner
            {
                background-color: lightgreen;
            }

            .Keyboard
            {
                background-color: lightgreen;
            }

            #resultsList div:first-of-type
            {
                border: 1px solid black;
                padding: 10px;
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
            <div class="form-group">
            <label>Select Category</label>
            <br>
            <select class="form-control" id="categories" required>
                <?php
                  $getData = "SELECT * FROM menu_categories";
                  $qur = $conn->query($getData);

                  while($r = mysqli_fetch_assoc($qur))
                  {

                ?>
                    <option value="<?php echo $r['category_id'] ?>"><?php echo $r['cat_name']  ?></option>
                <?php

                  }

                ?>
  </select>
</div>

            <button type="button" class="btn btn-success" onclick="openAjaxModel();" data-target="#addcategorymodel">
              Add Category <i class="glyphicon glyphicon-plus"></i>
            </button>

            <br/>
            <br/>

            <label>Product Details</label>

            <br>
            <input type="text" id="prod_name" class="form-control" placeholder="Product Name..." required>
            <br>
            <input type="text" id="prod_price" class="form-control" placeholder="Product Price..." required>
            <br>
            <input type="text" class="form-control" id="prod_discount" placeholder="Product Discount...">
            <br>
            <div>

            <div id="resultsList"></div>
            </div>

            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
              <button id="reset" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> Reset</button>
              <button type="button" class="btn btn-success" onclick="sendrequest();"><i class="glyphicon glyphicon-plus"></i> Add Product</button>
            </div>
                    <h2>Products' List</h2>
                    <div>

                        <div class="form-group">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for items..">
                        </div>

                        <table class="table table-bordered table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>PRICE</th>

                                    <th>DISCOUNT %</th>

                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php

                                $getData = "SELECT * FROM menu_products";
                                $qur = $conn->query($getData);

                                while($r = mysqli_fetch_assoc($qur))
                                {
//$msg[] = array("user_id" => $r['id'] , "fullname" =>$r['firstname'].' '.$r['lastname'] , "displayname" =>$r['displayname'], "image" =>$link.$r['image']);
                                ?>

                                  <tr>
                                    <td id="<?php echo 'td_0213_'.$r['p_id'] ?>"><?php echo $r['p_name'] ?></td>
                                    <td id="<?php echo 'td_0211_'.$r['p_id'] ?>"><?php echo $r['p_price'] ?></td>

                                    <td id="<?php echo 'td_0210_'.$r['p_id'] ?>"><?php echo $r['discount_percent'] ?></td>

                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" type="button">Action <span class="caret"></span></button>
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                <!-- teacher EDITING LINK -->
                                                <li>
                                                    <a href="#" onclick="showAjaxModal(<?php echo $r['p_id'] ?>);"><i class="entypo-pencil"></i> Edit</a>
                                                </li>
                                                <li class="divider"></li><!-- teacher DELETION LINK -->
                                                <li>
                                                    <a href="#" class="entypo-pencil" onclick="showConfirmModal(<?php echo $r['p_id'] ?>);"><i class="entypo-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
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

<div class="modal fade" id="addcategorymodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
       <label>Category Name</label>
        <input type="text" class="form-control" id="cat_name" placeholder="Category Name...">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" id="submit_btn" onclick="send_request();" class="btn btn-secondary">Add</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Product Name</label>
        <input type="text" class="form-control" id="prod_name" placeholder="Product Name...">
        <br>
        <label>Product Price</label>
        <input type="text" class="form-control" id="prod_price" placeholder="Product Price...">
        <br>
        <label>Product Discount</label>
        <input type="text" class="form-control" id="prod_discount" placeholder="Product Discount...">
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
        <label>Are you sure you want to delete this inventory?</label>
      </div>

      <div class="modal-footer">
        <button type="button" id="delete_btn_yes" class="btn btn-secondary">YES</button>
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
