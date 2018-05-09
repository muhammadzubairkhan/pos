//Global Variables
var orderData = [];
var waiterDetails = [];
var cust_id = "";
var waiterid = 0;
var serviceNum = 0;
var workperiod_id = 0;
var isResume = false;
var prevOrderDataLength = 0;
var ordertype = 0;

//Document Ready Function

$(document).ready(function()
{
    try
    {
        $("#tender_btn").addClass("disabledbutton");
        $("#bill_btn").addClass("disabledbutton");

        $('.barcode-form').on('submit', function(e)
        {
            e.preventDefault();
        });

        $("#main").addClass("disabledbutton");

        checkWorkPeriods();
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }

});

$(document).ready(function()
{
    try
    {
        var pressed = false;
        var chars = [];
        $(window).keypress(function(e) {
            if (e.which >= 48 && e.which <= 57) {
                chars.push(String.fromCharCode(e.which));
            }
            //console.log(e.which + ":" + chars.join("|"));
            if (pressed == false) {
                setTimeout(function(){
                    // check we have a long length e.g. it is a barcode
                    if (chars.length >= 10) {
                        var barcode = chars.join("");
                        console.log("Barcode Scanned: " + barcode);
                        $("#barcode_product_search").val(barcode);
                    }
                    chars = [];
                    pressed = false;
                },500);
            }
            pressed = true;
        });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }

});

//Disable Everything Function

function disableAll()
{
    try
    {
        $("#submit_btn").addClass("disabledbutton");
        $("#damage_btn").addClass("disabledbutton");
        $("#bill_btn").addClass("disabledbutton");
        $("#tender_btn").addClass("disabledbutton");
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//On Clicking Products, Show Buttons

function productClickEnable()
{
    try
    {
        $("#submit_btn").removeClass("disabledbutton");
        $("#damage_btn").addClass("disabledbutton");
        $("#bill_btn").addClass("disabledbutton");
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Enable Submit Button Function

function submitClickEnable()
{
    try
    {
        $("#submit_btn").addClass("disabledbutton");
        $("#damage_btn").removeClass("disabledbutton");
        $("#bill_btn").removeClass("disabledbutton");
        $("#tender_btn").removeClass("disabledbutton");
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Enable Bill Button Function

function billClickEnable()
{
    try
    {
        $("#submit_btn").addClass("disabledbutton");
        $("#damage_btn").addClass("disabledbutton");
        $("#bill_btn").addClass("disabledbutton");
        $("#tender_btn").addClass("disabledbutton");
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Start Work Period Function

function startPeriod()
{
    try
    {
        //alert(status);
        $("#main").removeClass('disabledbutton');
        $("#end_btn").removeClass('disabledbutton');
        $("#tender_btn").removeClass('disabledbutton');
        $("#submit_btn").addClass('disabledbutton');

        document.getElementById('main').disabled = false;

        if(isResume == true)
        {
            document.getElementById('start_btn').disabled = true;
            $("#main").removeClass('disabledbutton');
            document.getElementById("end_btn").disabled = false;

            //alert(workperiod_id);

            if(status == 0 || status == 1)
            {
                //alert("Start Period Status: " + status);
                $.ajax( { type : 'POST',
                         data : { workPeriodId_start: workperiod_id, status_start: status},
                         url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                         success : function ( data )
                         {
                            //alert(data);

                            if(data != 0)
                            {
                                //alert("Data");
                                $("#main").removeClass('disabledbutton');
                                $("#third_div").addClass('disabledbutton');
                                $("#fourth_div").addClass('disabledbutton');
                                $(".barcode-form").addClass('disabledbutton');
                                document.getElementById('main').disabled = false;
                            }
                            else
                            {
                                //alert("No Data");
                                $("#main").removeClass('disabledbutton');
                                $("#third_div").removeClass('disabledbutton');
                                $("#fourth_div").removeClass('disabledbutton');
                                $(".barcode-form").removeClass('disabledbutton');
                            }

                            data = JSON.parse(data);

                            cust_id = data[0].customer_id;
                            //alert("In Start Period Customer ID: "+cust_id);
                        },
                        error: function ( xhr )
                        {
                            //alert( "error" );
                        }
                    });
            }
            else
            {

            }

        }
        else
        {
               //cust_id =  "<?php echo base_convert(time(), 10, 36); ?>";

               cust_id = new Date().valueOf();

               $.ajax( { type : 'POST',
                         data : { startwork:true },
                         url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                         success : function ( data )
                         {
                            //alert(data);
                            var temp = JSON.parse(data);
                            workperiod_id = temp[0]['workperiod_id'];
                            document.getElementById('start_btn').disabled = true;
                            $("#main").removeClass('disabledbutton');
                            document.getElementById("end_btn").disabled = false;

                            //printKitchenReceipt(custid,tableid);
                        },
                        error: function ( xhr )
                        {
                            //alert( "error" );
                        }
                    });
        }
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Print Kitchen Receipt

function printKitchenReceipt()
{
    try
    {
        //alert("kitchen receipt");
        //alert("PRINT KITCHEN ORDER DATA: "+orderData);
        //alert(orderData.length);

        var myDataArray1 = [];
        var myDataArray2 = [];
        var myDataArray3 = [];
        var myDataArrayCatID = [];

        for(var num = prevOrderDataLength; num < orderData.length; num++)
        {
            //alert("Category ID: "+orderData[num].cat_id);
            myDataArray1.push({'CAT_ID': orderData[num].cat_id, 'P_NAME': orderData[num].p_name, 'P_QUANTITY': orderData[num].p_quan, 'P_PRICE': orderData[num].p_price});
        }

        //console.log("prev Order length "+prevOrderDataLength);
        //console.log(myDataArray1);

        myDataArray2 = myDataArray1.sort(

            function(a, b)
            {
                return parseFloat(a.CAT_ID) - parseFloat(b.CAT_ID);
            }

        );

        var flags = [], output = [], l = myDataArray2.length, i;

        for( i = 0; i < l; i++)
        {
            //alert("FLAG VALUE FOR: "+flags[myDataArray2[i].CAT_ID]);
            if(flags[myDataArray2[i].CAT_ID])    continue;
            //alert("Cat Ids  "+i);

            //alert("FLAG VALUE IF: "+flags[myDataArray2[i].CAT_ID]);
            flags[myDataArray2[i].CAT_ID] = true;
            output.push(myDataArray2[i].CAT_ID);
            //console.log(myDataArray2[i].CAT_ID);
            //alert("iteration   "+i);
            //alert("FLAG VALUE: "+output[i]);
        }

        //console.log(myDataArray2+" Cat IDsss");

        var catID = null;
        var temp_catID = myDataArray2[0]['CAT_ID'];;
        var finalArray = "";
        var finalArray = [];
        var tempArray = [];

        for(var num1 = 0; num1 < myDataArray2.length; num1++)
        {
            //alert(myDataArray2[num1]['P_NAME']);
            catID = myDataArray2[num1]['CAT_ID'];
            //temp_catID = myDataArray2[num1]['CAT_ID'];
            //temp_catID = myDataArray2[num1]['CAT_ID'];

            if(catID == temp_catID)
            {
                var obj = {P_NAME:myDataArray2[num1]['P_NAME'], P_QUANTITY:myDataArray2[num1]['P_QUANTITY']};
                tempArray.push(obj);
                //alert("Cat same");
                //continue;
            }
            else
            {
                var obj = {cat_idd:temp_catID, data:tempArray};
                finalArray.push(obj);
                temp_catID = catID;
                tempArray = [];
                var obj = {P_NAME:myDataArray2[num1]['P_NAME'], P_QUANTITY:myDataArray2[num1]['P_QUANTITY']};
                tempArray.push(obj);
                //alert("Cat Changed");
                //tempArray.push(myDataArray2[num1]['P_NAME']);
            }
        }

        var obj = {cat_idd:temp_catID, data:tempArray};
        finalArray.push(obj);
        //console.log(finalArray);

        var quanbox = $('#orders tr td #val');
        var pricebox = $('#orders tr #pricebox');

        //var e = document.getElementById("waiter");
        //var wat_id = e.options[e.selectedIndex].value;
        //alert(waiterid);

        for(var i = 0;i<quanbox.length;i++)
        {
            var currentquan =  parseInt(quanbox.get(i).value);
            var currentprice =  parseInt(pricebox.get(i).innerHTML);
            orderData[i]["p_quan"] = currentquan;
            orderData[i]["p_price"] = currentprice;

            //alert("quan  "+currentquan);
            //alert(orderData[i].p_quan);
        }

        $.ajax({ type : 'POST',
                 data : { data:JSON.stringify(finalArray), custid:cust_id},
                 url  : 'escpos-php-master/example/interface/receiptforkitchen.php',              // <=== CALL THE PHP FUNCTION HERE.
                 success: function(data)
                 {
                       //alert(data);
                       //alert("OK   "+data);
                       //window.location.href = '';
                       //alert("success receipt");

                        //alert(data);
                        //console.log("Order Data length "+orderData.length);
                        prevOrderDataLength = orderData.length;
                        startOrder(1);

                        // <=== VALUE RETURNED FROM FUNCTION.
                },
                error: function (xhr)
                {
                    //alert( "error  "+xhr );
                }
             });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Print Kitchen Receipt For Edited Order

function printKitchenReceiptForEditOrder(index, newquan, edittype)
{
    try
    {
        var tempArray = [];
        var finalArray = [];
        //console.log(orderData+"Order Data");
        var obj = {P_NAME:orderData[index]['p_name'],P_QUANTITY:newquan};
        tempArray.push(obj);
        var obj = {cat_idd:orderData[index]['cat_id'],data:tempArray};
        finalArray.push(obj);
        console.log(finalArray);

        //alert("Final Array: "+finalArray);
        //alert("Cust ID: "+cust_id);

        $.ajax({ type : 'POST',
                 data : { data:JSON.stringify(finalArray), custid:cust_id, edit_type:edittype},
                 url  : 'escpos-php-master/example/interface/receiptforkitchen.php',              // <=== CALL THE PHP FUNCTION HERE.
                 success: function(data)
                 {
                    //alert(data);
                    //alert("OK   "+data);
                    //window.location.href = '';
                    //alert("success receipt");

                    //console.log("Order Data length "+orderData.length);
                    prevOrderDataLength = orderData.length;
                    startOrder(1);

                    // <=== VALUE RETURNED FROM FUNCTION.
                 },
                 error: function (xhr)
                 {
                    //alert( "error  "+xhr );
                 }
        });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Print Customer Receipt

function printCustomerReceipt()
{
    try
    {
        //alert(orderData);

        $.ajax({ type : 'POST',
                 data : { data:JSON.stringify(orderData), custid:cust_id },
                 url  : 'escpos-php-master/example/interface/receiptforcustomer.php',              // <=== CALL THE PHP FUNCTION HERE.
                 success: function(data)
                 {
                    // <=== VALUE RETURNED FROM FUNCTION.
                 },
                 error: function (xhr)
                 {
                    //alert( "error  "+xhr );
                 }
        });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

// New Order Function

function newOrder()
{
    try
    {
        //alert("New Order Started. Click on Resume Work Period button to create a customer!");

        $("#new_order_btn").addClass('disabledbutton');
        $("#start_btn").removeClass('disabledbutton');

        cust_id = new Date().valueOf(); //"<?php echo base_convert(time(), 10, 36); ?>";
        //alert(cust_id);
        orderData = [];
        //alert(orderData.length);
        $("#orders").html("");
        $("#totaltxt").html("0");
        $("#discounttxt").html("0");

        document.getElementById("start_btn").disabled = false;
        //$("#start_btn").removeClass('disabledbutton');

        tender();
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//End Work Period Function

function endPeriod()
{
    try
    {
       $.ajax( { type : 'POST',
                 data : { 'endwork':true,'workperiod_id_end':workperiod_id },
                 url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                 success: function ( data )
                 {

                    //alert(data);

                    if(data != "")
                    {
                        //console.logg(data);
                        data = JSON.parse(data);
                        nonTenderOrders(data);
                    }
                    else
                    {
                          window.location.href = '';
                    }

                    $("#main").removeClass('disabledbutton');
                    $("#end_btn").addClass('disabledbutton');
                    $("#start_btn").removeClass('disabledbutton');
                    $("#tender_btn").removeClass('disabledbutton');
                 },
                 error: function ( xhr )
                 {
                    //alert( "error" );
                 }
            });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Checking Work Periods For Showing End Work Period Button

function checkWorkPeriods()
{
    try
    {
       $.ajax( { type : 'POST',
                 data : { 'workperiod_status':0 },
                 url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                 success: function ( data )
                 {

                    //alert(data);

                    if(data.length > 0)
                    {
                        //alert("WorkPeriod Hain");
                        $("#end_btn").addClass('disabledbutton');
                        $("#start_btn").removeClass('disabledbutton');
                        //alert("Order Data: "+orderData.length);
                    }
                    else
                    {
                          //alert("WorkPeriod Nahi Hain");
                          window.location.href = '';
                          $("#end_btn").removeClass('disabledbutton');
                    }

                    $("#main").addClass('disabledbutton');

                 },
                 error: function ( xhr )
                 {
                    //alert( "error" );
                 }
            });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}


//Non Tendered Orders Data Function

function nonTenderOrders(data)
{
    try
    {
        // document.getElementById("myModal_waiters").style.display = "block";
        $("#myModal_waiters").modal();
        $("#nontender-waiters").html("");
        var total = $('#totaltxt').text();
        var discount = $('#discounttxt').text();

        for(var i =0;i<data.length;i++)
        {
            $("#nontender-waiters").append('<tr><td><center>'+data[i].p_name+'</center></td><td><center>'+data[i].quantity+'</center></td><td><center>'+data[i].quantity*data[i].p_price+' Rs</center></td><td><center>'+data[i].quantity*data[i].discount_percent+' Rs</center></td></tr>');
            //<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="getServices('+data[i].waiter_id+','+data[i].status+');">VIEW</button>
        }

        $("#nontender-waiters").append('<tr><td colspan="4"></td></tr><tr><td colspan="3">TOTAL DISCOUNT</td><td>'+discount+'</td></tr><tr><td colspan="3">TOTAL AMOUNT</td><td>'+total+'</td></tr><tr><td colspan="4"><center><button type="submit" id="tender_btn" onclick="tender();" class="btn btn-warning waves-effect waves-light btn-xlg black" style="color:white;">TENDER <span class="glyphicon glyphicon-ok"></span></button></center></td></tr>');
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Start Order Using Status like 0 for Submitted Order, 1 for Billed Order, 2 for Tendered Order

function startOrder(status)
{
    try
    {
        //alert(status);
        //alert("PREVIOUS ORDER DATA LENGTH: "+prevOrderDataLength);
        //alert("Order Status:"+"  "+status);
        $("#orders").html("");
        //$('#orders').append('<li class="list-group-item row"> <div class="col-md-12"><h4 id="ordersHeading" class="list-group-item-heading"><center>Items Ordered</center></h4></li>');
        calculatetotal();
        orderData = [];
        ordertype = 0;
        document.getElementById("row3").style.display = "none";
        document.getElementById("row2").style.display = "block";
        document.getElementById("row1").style.display = "block";

        $("#main").removeClass('disabledbutton');
        $("#sec_div").removeClass('disabledbutton');
        $("#third_div").removeClass('disabledbutton');
        $("#fourth_div").removeClass('disabledbutton');

        if (status == 0)
        {
           prevOrderDataLength = 0;

           $.ajax({ type : 'POST',
                    data : { 'workPeriodid':workperiod_id, 'status':status },
                    url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                    success : function ( data )
                    {
                         //alert("Current Order: "+data);
                         data = JSON.parse(data);

                         var discounted_amount;
                         var discounted_price;

                         //var discounted_amount = (discounted_price/100)*price;
                         //discounted_price = price - discounted_amount;

                         cust_id = data[0].customer_id;
                         //alert("In Start Order Customer ID: "+cust_id);

                         //printKitchenReceipt(custid,tableid);
                         //$("#orders").html("");

                         for (var i = 0; i < data.length ; i++)
                         {
                             //discounted_amount = (data[i].discount_percent/100)*data[i].p_price;
                             discounted_amount = data[i].discount_percent;
                             discounted_price = data[i].p_price - discounted_amount;

                             //alert(discounted_amount);

                             //alert("Current Order: "+data);
                             //appendOrders(data[i].p_name, data[i].product_id, data[i].p_price, data[i].discount_percent*data[i].quantity, data[i].quantity, status, data[i].cat_id);

                             appendOrders(data[i].p_name, data[i].product_id, data[i].p_price, data[i].discount_percent, data[i].quantity, status, data[i].cat_id);
                         }

                         prevOrderDataLength = orderData.length;

                         $(".increase_btn").addClass("disabledbutton");
                         $(".decrease_btn").addClass("disabledbutton");



                         if (status == 2)
                         {
                             //alert("Hi");
                             billClickEnable();
                             //alert("bill");
                         }
                         else
                         {
                             submitClickEnable();
                         }
                    },
                    error: function ( xhr )
                    {
                       //alert( "error" );
                    }
                });


           //$("#sec_div").removeClass("disabledbutton");
           //$("#third_div").removeClass("disabledbutton");
           //$("#fourth_div").removeClass("disabledbutton");
           //$('.services').addClass('hidden');

           cust_id = new Date().valueOf(); //"<?php echo base_convert(time(), 10, 36); ?>";
           //waiterid = waiter_id;
           //serviceNum = service_Num;
           disableAll();
           //alert(waiterid + "   " +serviceNum);

        }
        else if (status == 1 || status == 2)
        {
           //alert("status 2 if "+status);
           //$("#sec_div").removeClass("disabledbutton");
           //$("#third_div").removeClass("disabledbutton");
           //$("#fourth_div").removeClass("disabledbutton");
           //$('.services').addClass('hidden');
           //waiterid = waiter_id;
           //serviceNum = service_Num;



           $.ajax({ type : 'POST',
                    data : { 'workPeriodid':workperiod_id, 'status':status },
                    url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                    success : function ( data )
                    {
                         //alert("Hi");
                         //alert(data);
                         data = JSON.parse(data);

                        var discounted_amount;
                         var discounted_price;


                         //printKitchenReceipt(custid,tableid);
                         //$("#orders").html("");

                         if(status == 0 || status == 1)
                         {
                             for (var i = 0; i < data.length ; i++)
                             {
                                 //alert(data[i].discount_percent);
                                 //discounted_amount = (data[i].discount_percent/100)*data[i].p_price;
                                 discounted_amount = data[i].discount_percent;
                                 discounted_price = data[i].p_price - discounted_amount;
                                 //alert(discounted_price);

                                 //alert(discounted_amount);
                                 //alert(discounted_price);


                                 //appendOrders(data[i].p_name, data[i].product_id, data[i].p_price, data[i].discount_percent*data[i].quantity, data[i].quantity, status, data[i].cat_id);


                                 appendOrders(data[i].p_name, data[i].product_id, data[i].p_price, data[i].discount_percent, data[i].quantity, status, data[i].cat_id);
                             }

                             prevOrderDataLength = orderData.length;
                         }



                         if (status == 2)
                         {
                             billClickEnable();
                             //alert("bill");
                         }
                         else
                         {
                             submitClickEnable();
                         }
                    },
                    error: function ( xhr )
                    {
                       //alert( "error" );
                    }
                });
        }

        //alert(waiterid + "   " +serviceNum);
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//startOrder(1);

//Edit Order Function

function EditOrder(row)
{
    try
    {
         var list = row.parentNode.parentNode.parentNode;
         var roww = $(list).index();
         var increase_btn = $('#orders li div #increase_btn').get(roww);
         var cancel_btn = $('#orders li div .btn-danger').get(roww);

         //alert(cancel_btn);

         var quanbox = $('#orders li div #val');

         //var currentquan = 0;

         if($(row).text() == "ADD MORE")
         {
             var currentquan = parseInt(quanbox.get(roww).value);
             $(row).html("APPLY");
             $(increase_btn).removeClass('disabledbutton');
             $(cancel_btn).addClass('disabledbutton');
             var pricebox = $('#orders li #pricebox h4');
         }
         else
         {
             $(row).html("ADD MORE");
             $(increase_btn).addClass('disabledbutton');
             $(cancel_btn).removeClass('disabledbutton');
             var quanbox = $('#orders li div #val');
             var pricebox = $('#orders li #pricebox h4');
             var newquan =  parseInt(quanbox.get(roww).value);
             var finalqty = newquan - orderData[roww].p_quan;

             orderData[roww].p_quan = newquan;

             //alert(orderData[roww-1].p_id);
             //alert(finalqty);
             //console.log(orderData[roww-1].p_quan);

             if(finalqty > 0)
             {
                alert("Final Quantity: "+finalqty);
                $.ajax( { type : 'POST',
                          data : { workPeriodid:workperiod_id, update_qty:finalqty, product_id : orderData[roww].p_id, customer_id: cust_id },
                          url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                          success : function ( data123 )
                          {
                                //alert("hello shujaat4");
                                alert("Data Returned: "+data123);
                                printKitchenReceiptForEditOrder(roww,finalqty,1);
                          },
                          error: function ( xhr )
                          {
                                //alert( "error" );
                          }
                    });
            }
        }
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Cancel Order Function

function cancelOrder(row)
{
    try
    {
         var list = row.parentNode.parentNode.parentNode;
         var roww = $(list).index();
         var increase_btn = $('#orders li div #decrease_btn').get(roww);
         var addmore_btn = $('#orders li div .btn-success').get(roww);
         var quanbox = $('#orders li div #val');
         if($(row).text() == "CANCEL")
         {
              var currentquan = parseInt(quanbox.get(roww).value);
              $(row).html("APPLY");
              $(increase_btn).removeClass('disabledbutton');
              $(addmore_btn).addClass('disabledbutton');
              var pricebox = $('#orders li #pricebox h4');
         }
         else
         {
              $(row).html("CANCEL");
              $(increase_btn).addClass('disabledbutton');
              $(addmore_btn).removeClass('disabledbutton');
              var quanbox = $('#orders li div #val');
              var pricebox = $('#orders li #pricebox h4');
              var newquan =  parseInt(quanbox.get(roww).value);
              var finalqty = orderData[roww].p_quan - newquan;
              orderData[roww].p_quan = newquan;
              //alert(orderData[roww-1].p_id);
              //alert(finalqty);
              //console.log(orderData[roww-1].p_quan);

              if(finalqty > 0)
              {
                    $.ajax( { type : 'POST',
                              data : {  workPeriodid:workperiod_id , minus_qty:finalqty , product_id:orderData[roww].p_id, customer_id: cust_id },
                              url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                              success: function ( data )
                              {
                                    //alert(data);
                                    printKitchenReceiptForEditOrder(roww,finalqty,0);
                              },
                              error: function ( xhr )
                              {
                                    //alert( "error" );
                              }
                        });
               }
         }
         //alert(currentquan);
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Submit Order Function

function submitorder()
{
    try
    {
        //document.getElementById("settle_Btn").disabled = false;
        //document.getElementById("submit_Btn").disabled = true;

        var quanbox = $('#orders li div #val');
        var pricebox = $('#orders li #pricebox h4');
        var discount = $('#orders li #discounted_amount h4');

        for(var i = 0;i<quanbox.length;i++)
        {
            var currentquan =  parseInt(quanbox.get(i).value);
            var currentprice =  parseInt(pricebox.get(i).innerHTML);
            var currentdiscount =  parseInt(discount.get(i).innerHTML);

            orderData[i]["p_quan"] = currentquan;
            orderData[i]["p_price"] = currentprice;
            orderData[i]["p_discount"] = currentdiscount;
            //alert(orderData[i]["p_quan"]);
            //alert(orderData[i].p_quan);
        }

        //alert("Order Data Length: "+orderData.length);

        if(cust_id == "")
        {
            //alert("Customer ID: "+cust_id);
            cust_id = new Date().valueOf();
            //alert("New Customer Created!");
        }

        //alert(JSON.stringify(orderData));

        $.ajax( { type : 'POST',
                  data : { OrderDetails:JSON.stringify(orderData), customer_id:cust_id, workPeriodid:workperiod_id, order_type:ordertype },
                  url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                  success: function ( data )
                  {
                    //alert(data);
                    //alert(JSON.stringify(orderData));
                    //alert("Submitted Order Data Return Value: "+data);
                    $("#submit_btn").addClass("disabledbutton");
                    $("#damage_btn").removeClass("disabledbutton");
                    $("#bill_btn").removeClass("disabledbutton");
                    $("#tender_btn").removeClass("disabledbutton");
                    //$("#orders").addClass("disabledbutton");

                    //startOrder(2);

                    //alert(data);
                    //printKitchenReceipt();

                    window.location.reload(true);

                  },
                  error: function ( xhr )
                  {
                    //alert( "error" );
                  }
                });

                //for(var i=0;i<orderData.length;i++){
                //alert(orderData[i].p_quan);
                //alert(orderData[i].p_name);
                //alert(orderData[i].p_price);
                //}
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Check For Order That is already being added. If Product with id 1 is added to cart, it will not be added again

function in_array(array, id)
{
    try
    {
        for(var i = 0; i < array.length; i++)
        {
           //alert(array[i]['p_id']);

           if(array[i]['p_id'] === id)
           {
             return false;
           }
        }
        return true;
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Delete Order Row Function

function deleteRow(row)
{
    try
    {
        //alert(row);
        //document.getElementById("submit_Btn").disabled = false;
        //var roww = row.parentNode.parentNode.parentNode.rowIndex;
        var list = row.parentNode.parentNode.parentNode;
        var roww = $(list).index();
        //alert(roww);
        orderData.splice(roww, 1);
        //alert(orderData);
        $(row).closest('li').remove();
        calculatetotal();
        if (orderData.length < 1)
        {
            disableAll();
        }
        else if (orderData.length == prevOrderDataLength )
        {
            submitClickEnable();
        }
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Get Services Function, Not-In-Use

function getServices(waiter_id, numOfServices)
{
    try
    {
        //alert(waiter_id);
        //alert(numOfServices);
        $('.services').removeClass('hidden');
        $('.services').hide().fadeIn(100);
        $("#services").html("");
        $("#services").append('<li class="list-group-item row"> <div class="col-md-12"><h4 id="ordersHeading" class="list-group-item-heading"><center>Services</center></h4></div></li>');

        $.ajax( { type : 'POST',
                  data : {workperiodid:workperiod_id,checkservicestatus:true },
                  url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                  success : function ( data )
                  {
                    //alert(data);
                    data = JSON.parse(data);
                    var status = 0;
                    var styleClass = "free_service";
                    var desc = "Free";
                    //console.log("Waiter Data  "+data);
                    for(var i=0;i<numOfServices;i++)
                    {
                        for(var j=0;j<data.length;j++)
                        {
                              if((i+1) == data[j].service_Id)
                              {
                                    //console.log("Service Num "+i+1+" status = "+data[j].status);
                                    if(data[j].status == 0)
                                    {
                                          status = 1;
                                          styleClass = "active_service";
                                          desc = "Reserved";
                                    }
                                    else if(data[j].status == 1)
                                    {
                                          status = 2;
                                          styleClass = "waiting_service";
                                          desc = "Bill";
                                    }
                                    else if(data[j].status == 2)
                                    {
                                          status = 3;
                                          styleClass = "tender_service";
                                          desc = "Tender";
                                    }
                                    else
                                    {
                                          status = 0;
                                          styleClass = "free_service";
                                          desc = "Free";
                                    }

                                    break;

                                    //alert("mathced");
                                }
                                else
                                {
                                          status = 0;
                                          styleClass = "free_service";
                                          desc = "Free";
                                }
                        }

                        if(status == 3)
                        {
                              $("#services").append('<li class="list-group-item row '+styleClass+'"><div class="col-md-12"><h4 class="list-group-item-heading"><a href="#">Service '+(i+1)+'</a></h4><small class="list-group-item-text">'+desc+'</small></div></li>');
                        }
                        else
                        {
                              $("#services").append('<li class="list-group-item row '+styleClass+'"><div class="col-md-12" onclick="startOrder('+status+');"><h4 class="list-group-item-heading"><a href="#">Service '+(i+1)+'</a></h4><small class="list-group-item-text">'+desc+'</small></div></li>');
                        }
                    }

                    //printKitchenReceipt(custid,tableid);
                },
                error: function ( xhr )
                {
                    //alert( "error" );
                }
            });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//appendOrders(product_name, product_id, product_price, discounted_price, product_quantity, product_id is 0 by default, product_category)

//Append Orders Function

function appendOrders(tr, id, price, discounted_price, quantity, status, catid)
{
    try
    {
        //falert(discounted_price);
        id = parseInt(id);
        var styleclass = "";
        var result = in_array(orderData, id);

        //Discount Percentage Amount
        //var discounted_amount = (discounted_price/100)*price;
        //var discounted_amount = data[i].discount_percent;
        discounted_price = price - discounted_price;
        //alert("asdasd"+discounted_amount);
        //alert(status);

        if(result)
        {
            var obj = {p_id:id, p_name:tr, p_quan:quantity, p_price:price, p_discount:discounted_price, cat_id:catid};
            orderData.push(obj);
            //alert(obj.p_discount);
            if(status == 1 || status == 2 || status == 0)
            {
                $('#orders').append('<li class="list-group-item row ordered-items"><div class="col-md-2"><h4 id="p_name">'+tr+'</h4></div> <div id="pricebox" class="col-md-2"><h4>'+(price*quantity)+' Rs</h4></div> <div class="col-md-6"><div class="form-inline"><button type="submit" id="decrease_btn" class="btn btn-sm btn-default disabledbutton decrease_btn"><span class="glyphicon glyphicon-minus"></span></button><div class="form-group"><input type="text" id="val" value="'+quantity+'" disabled  class="form-control" style="width:50px;"></div><button type="submit" id="increase_btn" class="btn btn-sm btn-default disabledbutton increase_btn"><span class="glyphicon glyphicon-plus"></span></button></div></div><div class="col-md-2" id="discounted_amount"><h4>'+discounted_price*quantity+'  Rs</h4></div></li>');

                //$(".delete_btn").addClass("disabledbutton");

                //<button type="submit" onclick="EditOrder(this)" class="btn btn-sm btn-success waves-effect waves-light">ADD MORE</button><button type="submit" onclick="cancelOrder(this)" class="btn btn-sm btn-danger waves-effect waves-light">CANCEL</button></div></div></li>');

                calculatetotal();
            }
            else
            {
                productClickEnable();
                $("#bill_btn").addClass("disabledbutton");
                $("#tender_btn").addClass("disabledbutton");
                $('#orders').append('<li class="list-group-item row '+styleclass+' ordered-items"><div class="col-md-2"><h4 id="p_name">'+tr+'</h4></div> <div id="pricebox" class="col-md-2"><h4>'+(price*quantity)+' Rs </h4></div> <div class="col-md-6"><div class="form-inline"><button type="submit" id="decrease_btn" class="btn btn-sm btn-default decrease_btn"><span class="glyphicon glyphicon-minus"></span></button><div class="form-group"><input type="text" id="val" value="'+quantity+'" disabled  class="form-control" style="width:50px;"></div><button type="submit" id="increase_btn" class="btn btn-sm btn-default increase_btn"><span class="glyphicon glyphicon-plus"></span></button><button type="submit" onclick="deleteRow(this)" class="btn btn-sm btn-danger waves-effect waves-light delete_btn">Delete</button></div></div><div class="col-md-2" id="discounted_amount"><h4>'+discounted_price*quantity+' Rs</h4></div></li>');

                //<button type="submit" onclick="deleteRow(this)" class="btn btn-sm btn-danger waves-effect waves-light delete_btn">Delete</button></div></div></li>');

                calculatetotal();

//                if(status == 1 || status == 2)
//                {
//
//                }
            }
        }
        else
        {
            alert("Item already added in order!");
            //$(".decrease_btn").addClass("disabledbutton");
            //$(".increase_btn").addClass("disabledbutton");
        }
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Settle Order Function

function Settle(custid, inputvalue, total, discountpercent)
{
//    alert("Order Billed!");
//    alert("S Cust ID: "+custid);
//    alert("S Input Value: "+inputvalue);
//    alert("S Total: "+total);
//    alert("S Discount Percent: "+discountpercent);

    try
    {
        if(ordertype == 1)
        {
            submitorder();
            //add_customer();
        }

        billClickEnable();
        alert("Printing Customer Receipt");
        printCustomerReceipt(custid, inputvalue, total, discountpercent);
        alert("Printing Kitchen Receipt");
        printKitchenReceiptNew(custid, inputvalue, total, discountpercent);

        //window.location.href = "";
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Print Customer Receipt Function

function printCustomerReceipt(cust_id, inputvalue, total, discountpercent)
{
    try
    {
//        alert("Customer Receipt");
//        alert("CR Cust ID: "+cust_id);
//        alert("CR Input Value: "+inputvalue);
//        alert("CR Total: "+total);
//        alert("CR Discount Percent: "+discountpercent);

        //alert(JSON.stringify(orderData, null, 4));

        $.ajax( { type : 'POST',
                  data : { data:JSON.stringify(orderData), custid:cust_id, input_value:inputvalue, total_amount:total, discount_percent:discountpercent },
                  url  : 'escpos-php-master/example/interface/receiptforcustomer.php',              // <=== CALL THE PHP FUNCTION HERE.
                  success: function ( data )
                  {
                        document.getElementById("myModal").style.display = "None";
                        // <=== VALUE RETURNED FROM FUNCTION.
                  },
                  error: function ( xhr )
                  {
                        //alert( "error  "+xhr );
                  }
            });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }

}

//Print Kitchen Receipt Function

function printKitchenReceiptNew(cust_id, inputvalue, total, discountpercent)
{
    try
    {
//        alert("Customer Receipt");
//        alert("CR Cust ID: "+cust_id);
//        alert("CR Input Value: "+inputvalue);
//        alert("CR Total: "+total);
//        alert("CR Discount Percent: "+discountpercent);

        //alert(JSON.stringify(orderData, null, 4));

        $.ajax( { type : 'POST',
                  data : { data:JSON.stringify(orderData), custid:cust_id, input_value:inputvalue, total_amount:total, discount_percent:discountpercent },
                  url  : 'escpos-php-master/example/interface/receiptkitchen.php',              // <=== CALL THE PHP FUNCTION HERE.
                  success: function ( data )
                  {
                        document.getElementById("myModal").style.display = "None";
                        // <=== VALUE RETURNED FROM FUNCTION.
                  },
                  error: function ( xhr )
                  {
                        //alert( "error  "+xhr );
                  }
            });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }

}

//Document Ready Function, Decrease and Increase The Quantity of Order Function

$(document).ready(function()
{
    try
    {
         $('#orders').on('click', 'li div div #decrease_btn', function (event)
         {
            //alert("decrease_btn");
            $("#submit_btn").removeClass("disabledbutton");
            $("#bill_btn").addClass("disabledbutton");
            $("#tender_btn").addClass("disabledbutton");
            var list = this.parentNode.parentNode.parentNode;
            //alert(list);

            var roww = $(list).index();
            //alert();

            var quanbox = $('#orders li div #val');
            var pricebox = $('#orders li #pricebox h4');
            var discount = $('#orders li #discounted_amount h4');

            var currentquan =  parseInt(quanbox.get(roww).value);
            var currentprice =  parseInt(pricebox.get(roww).innerHTML+" Rs");
            var currentdiscount = parseInt(discount.get(roww).innerHTML+" Rs");

            //alert(currentdiscount);

            var increamentquan = currentquan - 1;
            var newprice =  (currentprice/currentquan) * (increamentquan);
            var newdiscount = (currentdiscount/currentquan) * (increamentquan);

            //alert(newdiscount);

            if(increamentquan > 0)
            {
                quanbox.get(roww).value = increamentquan;
                pricebox.get(roww).innerHTML = newprice+" Rs";
                discount.get(roww).innerHTML = newdiscount+" Rs";
                calculatetotal();
            }

        });

        $('#orders').on('click', 'li div div #increase_btn', function (event)
        {
            //alert("increase_btn");
            $("#submit_btn").removeClass("disabledbutton");
            $("#bill_btn").addClass("disabledbutton");
            $("#tender_btn").addClass("disabledbutton");
            var list = this.parentNode.parentNode.parentNode;
            var roww = $(list).index();
            //alert(roww);
            var quanbox = $('#orders li div #val');
            var pricebox = $('#orders li #pricebox h4');
            var discount = $('#orders li #discounted_amount h4');

            var currentquan =  parseInt(quanbox.get(roww).value);
            var currentprice =  parseInt(pricebox.get(roww).innerHTML+" Rs");
            var currentdiscount = parseInt(discount.get(roww).innerHTML+" Rs");
            //alert(currentdiscount);

            var increamentquan = currentquan + 1;
            var newprice =  (currentprice/currentquan) * (increamentquan);
            var newdiscount = (currentdiscount/currentquan) * (increamentquan);

            //alert(newdiscount);

            if(increamentquan > 0)
            {
                quanbox.get(roww).value = increamentquan;
                pricebox.get(roww).innerHTML = newprice+" Rs";
                discount.get(roww).innerHTML = newdiscount+" Rs";
                calculatetotal();
            }
        });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
});

//Calculate Total Amount of Order Function

function calculatetotal()
{
    try
    {
        //document.getElementById("submit_Btn").disabled = false;

        var totalprice = 0;
        var totaldiscout = 0;
        var pricebox = $('#orders li #pricebox h4');
        var discount = $('#orders li #discounted_amount h4');

        //alert(pricebox.length);
        for(var i = 0;i<pricebox.length;i++)
        {
            var eachprice = parseInt(pricebox.get(i).innerHTML);
            var eachdiscount = parseInt(discount.get(i).innerHTML);
            totalprice += eachprice;
            totaldiscout += eachdiscount;
        }

        //alert(totalprice);

        $('#totaltxt').html(totalprice + " Rs");
        //var discounted_amount = parseInt(totalprice) - parseInt(totaldiscout);
        //alert(discounted_amount);
        $('#discounttxt').html(totaldiscout + " Rs");
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Get All Products of each category using Category Id

function getProducts(cat_id)
{
    try
    {
        //alert(cat_id);
        $.ajax( { type : 'POST',
                  data : { SendCatId:cat_id},
                  url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                  success : function ( data )
                  {
                        //alert(data);
                        var temp2 = JSON.parse(data);
                        //alert(temp2);
                        document.getElementById("products_tb").innerHTML = "";
                        //$("#products_tb").append('<li class="list-group-item row">  <div class="col-md-12"><h4 class="list-group-item-heading"><center>Products</center></h4></div></li>');
                        for(var i=0; i <temp2.length; i++)
                        {
                            $("#products_tb").append('<li class="list-group-item row ordered-items"><div class="col-md-10" onclick="appendOrders(\'' + temp2[i].p_name + '\', '+temp2[i].p_id+', '+temp2[i].p_price+', '+temp2[i].discount_percent+', '+1+', '+4+', '+temp2[i].cat_id+')"><h4 class="list-group-item-heading"> '+ temp2[i].p_name +' <small class="list-group-item-text">  <span class="badge pull-right">'+temp2[i].p_price+' Rs</span> </small></h4> </div></li>');
                            //$("#products_tb").append('<tr onclick="appendOrders(\'' + temp2[i].p_name + '\','+temp2[i].p_id+','+temp2[i].p_price+','+1+')"><td>'+ temp2[i].p_name +'</td></tr>');
                            //alert(temp2[i].p_name);
                        }

                        //alert(temp2.length);
                        //temp2 = "";
                        //alert(temp2);

                        //window.location.href = '';
                        //<=== VALUE RETURNED FROM FUNCTION.
                },
                error: function ( xhr )
                {
                    //alert( "error" );
                }
            });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Get Bill Function

function getbill()
{
    try
    {
        //alert("Bill Generated!");
        //alert("WP_ID: "+workperiod_id);
        //alert("CUST_ID: "+cust_id);

        //alert(cust_id);

        $("#tender_btn").removeClass("disabledbutton");

        $.ajax( { type : 'POST',
                  data : { 'workperiod_id_bill':workperiod_id, 'cust_id_bill':cust_id },
                  url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                  success: function ( data )
                  {
                        //window.location.reload(true);
                        add_customer();
                        //printCustomerReceipt();
                        //console.log(data);
                  },
                  error: function ( xhr )
                  {
                        //console.log(xhr);
                  }
             });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Get Damage Data Function

function getdamagedata()
{
    try
    {
        //alert("damage");

        document.getElementById("damage-orders").innerHTML = "";
        var p_name = $("#orders li div #p_name");
        var quanbox = $('#orders li div #val');
        var pricebox = $('#orders li #pricebox h4');
        var p_id_array=[];

        //alert(p_name.length);

        for(var i = 0; i<p_name.length; i++)
        {
            //alert(orderData[i].p_id);
            //alert(p_name.get(i).innerHTML);
            //alert(pricebox.get(i).innerHTML);
            //alert(quanbox.get(i).value);
            //$('#damage-orders').append('<li class="list-group-item row"><div class="col-md-2"><h4 id="p_name">'+p_name.get(i).innerHTML+'</h4></div> <div id="pricebox" class="col-md-2"><h4>'+pricebox.get(i).innerHTML+'</h4></div> <div class="col-md-8"><div class="form-inline"><button type="submit" id="decrease_btn" onclick="decreasecounter(this);" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-minus"></span></button><div class="form-group"><input type="text" id="val" value="'+quanbox.get(i).value+'" disabled  class="form-control" style="width:50px;"></div><button type="submit" id="increase_btn" onclick="increasecounter(this)" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span></button> <button type="submit" onclick="deleteRow(this)" class="btn btn-sm btn-danger waves-effect waves-light">Delete</button></div></div></li>');
            $("#damage-orders").append('<tr><td><input type="checkbox" id="chk"  onclick="enabletextbox(this);"  /> '+p_name.get(i).innerHTML+'</td><td><center><input type="text" id="val1" value="'+quanbox.get(i).value+'" disabled class="form-control" style="text-align:center; width: 25%; margin: 0px 10px 0px 10px;"></center></td><td><center><input type="text" id="damage_qty" value="" class="form-control" disabled onkeyup="integerInRange(this, this.value, 1, '+quanbox.get(i).value+')" style="text-align:center; width: 25%; margin: 0px 10px 0px 10px;"></center></td></tr>');
        }
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Check For Order Paid Amount Range

function integerInRange(row, value, min, max)
{
    try
    {
        var i= row.parentNode.parentNode.parentNode.rowIndex;
        //alert(i);
        var e = document.getElementById("damage-orders");
        if(value < min || value > max)
        {
            //alert("enter less than orignal quantity");
            e.rows[i-1].cells[2].children[0].children[0].value = "";
        }
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Enable Text Box Function For damaged products

function enabletextbox(row)
{
    try
    {
        var i= row.parentNode.parentNode.rowIndex;
        //alert(i);
        var e = document.getElementById("damage-orders");
        //alert(e);
        //alert(e.rows[i-1].cells[2].children[0].children[0].value);
        if(e.rows[i-1].cells[2].children[0].children[0].disabled == true)
        {
            e.rows[i-1].cells[2].children[0].children[0].disabled = false;
        }
        else
        {
            e.rows[i-1].cells[2].children[0].children[0].disabled = true;
        }
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Check Damaged List of Products

function checkdamagelist()
{
    try
    {
        //alert("submit works");
        var e = document.getElementById("damage-orders");
        var count = $('#damage-orders tr').length;
        var checks = $('#damage-orders tr td #chk');
        var damage_qty = $('#damage-orders tr td #damage_qty');
        //var prod_ids = $('#damage-orders tr #p_id');
        //alert(damage_qty.get(0).value);
        var damage_qty_arr = [];

        for (var i = 0; i < count; i++)
        {
            if(checks.get(i).checked)
            {
                //alert("in if");
                var quan = damage_qty.get(i).value;
                var id = orderData[i].p_id
                var obj = {p_id:id, damage_qty:quan, workperiodid:workperiod_id };
                damage_qty_arr.push(obj);
            }
        }
        //console.log(damage_qty_arr);

        if(damage_qty_arr.length > 0)
        {
            $.ajax( { type : 'POST',
                      data : { damage_qty_data:JSON.stringify(damage_qty_arr)},
                      url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                      success: function ( data )
                      {
                            //alert( data );
                            document.getElementById("myModal_damage").style.display = "none";
                            startOrder(1);
                            //alert("sads");// <=== VALUE RETURNED FROM FUNCTION.
                      },
                      error: function ( xhr )
                      {
                            //alert( "error" );
                      }
                    });
        }
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Tender Order Function

function tender()
{
    try
    {
         $.ajax( { type : 'POST',
                   data : { 'period_id_settle':workperiod_id},
                   url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                   success: function ( data )
                   {
                        $('#myModal_waiters').modal('hide');
                        //alert(data);
                        //window.location.href = '';
                        $("#main").removeClass('disabledbutton');
                        $("#sec_div").removeClass('disabledbutton');
                        $("#third_div").removeClass('disabledbutton');
                        $("#fourth_div").removeClass('disabledbutton');
                        alert("Order Ended Succesfully!");
                        $("#tender_btn").addClass('disabledbutton');
                        $("#bill_btn").addClass('disabledbutton');

                        $("#orders").html('');
                        $("#totaltxt").html('');
                        $("#discounttxt").html('');

                        cust_id = new Date().valueOf();

                        //alert("New Customer Created!");

                        $("#new_order_btn").addClass('disabledbutton');
                        $("#start_btn").removeClass('disabledbutton');
                        $("#main").addClass('disabledbutton');

                        window.location.reload(true);


                    },
                    error: function ( xhr )
                    {
                        //alert( "error" );
                    }
                });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

//Insert Discount In Order Function

function insertDiscount(discount_price, total_price)
{
    try
    {
         //alert(discount_price);
         //alert(total_price);
         $.ajax( { type : 'POST',
                   data : { wPeriod_id_discount:workperiod_id, discountprice:discount_price, totalprice:total_price},
                   url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                   success: function ( data )
                   {
                   },
                   error: function ( xhr )
                   {
                        //alert( "error" );
                   }
                });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

function add_product_to_order(quantity, status)
{
    try
    {
        var barcode_value = $('#barcode_product_search').val();

        $.ajax( { type : 'POST',
                   data : { searched_barcode:barcode_value },
                   url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                   success: function ( data )
                   {
                       //alert(data);
                       var data = JSON.parse(data);
                       //alert(data[0].p_price);
                       for(var i = 0; i < data.length; i++)
                       {
                           //alert("NAME: "+data[i].p_name);
                           //alert("P ID: "+data[i].p_id);
                           //alert("P PRICE: "+data[i].p_price);
                           //alert("QUAN: "+quantity);
                           //alert("STATUS: "+status);
                           //alert("CAT ID: "+data[i].cat_id);
                           appendOrders(data[i].p_name, data[i].p_id, data[i].p_price, data[i].discount_percent, quantity, status, data[i].cat_id);
                       }
                       //appendOrders(product_name, product_id, product_price, product_quantity, product_id is 0 by default, product_category)
                   },
                   error: function ( xhr )
                   {
                        //alert( "error" );
                   }
                });
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}


// Add Customer Name

function add_customer()
{
    try
    {
        //$("#modal_customer").modal();
        var customer_name = $('#customer_name').val();
        var customer_contact = $('#customer_contact').val();

        //alert(customer_name);
        //alert(customer_contact);
        //alert(cust_id);

        //var fields_validation = validateForm();
        //alert(fields_validation);

        if(customer_name != null || customer_name != "" || customer_contact != null || customer_contact != "")
        {
            //alert(customer_name);

            $.ajax( {  type : 'POST',
                       data : { customername:customer_name, customercontact:customer_contact, customerid:cust_id },
                       url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                       success : function ( data )
                       {

                           getbill();
                           //alert(data);

                           //var data = JSON.parse(data);

                           //alert(data);

                           //alert(data[0].p_price);
                           //for(var i = 0; i < data.length; i++)
                           //{
                               //alert("NAME: "+data[i].p_name);
                               //alert("P ID: "+data[i].p_id);
                               //alert("P PRICE: "+data[i].p_price);
                               //alert("QUAN: "+quantity);
                               //alert("STATUS: "+status);
                               //alert("CAT ID: "+data[i].cat_id);
                               //appendOrders(data[i].p_name, data[i].p_id, data[i].p_price, quantity, status, data[i].cat_id);
                           //}
                           //appendOrders(product_name, product_id, product_price, product_quantity, product_id is 0 by default, product_category)
                       },
                       error: function ( xhr )
                       {
                            //alert( "error" );
                       }
                    });
        }
        else
        {
            alert("Please fill complete customer details!");
        }
    }
    catch(err)
    {
        document.getElementById("error_message").innerHTML = "Error Message: " + err.message + "<br/>Error Name: " + err.name + "<br/>Error Line: " + err.lineNumber + "<br/>Error File: " + err.fileName + "<br/>For stack trace, view console!";
        console.log("Error Trace: "+ err.stack);
    }
}

// Add Customer Name

// Validated Customer Form Fields

//function validateForm()
//{
//    var customer_name = document.getElementById("customer_name").value;
//    var customer_contact = document.getElementById("customer_contact").value;
//
//    if ((customer_name == null || customer_name == "") || (customer_contact == null || customer_contact == ""))
//    {
//      //alert("Please fill all required fields");
//      return false;
//    }
//    else
//    {
//        return true;
//    }
//}

// Validate Customer Form Fields

// Error Message To User On POS

function showErrorMessageToUser()
{
    $('#overlay').fadeIn(200,function()
    {
        $('#box').animate({'top':'30%'},200);
        $('#box').removeClass("hide_error");
        $('#box').addClass("display_error");
    });
    return false;
}

function hideErrorMessageFromUser()
{
    $('#box').animate({'top':'-200px'},500,function()
    {
        $('#overlay').fadeOut('fast');
    });
}
