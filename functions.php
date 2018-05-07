<?php

session_start();
include("include/dbconnect.php");


if(isset($_POST['waitername']))
{
    $waiter_name = $_POST['waitername'];

    // DELETING CATEGORY QUERY
    $sql = "INSERT INTO waiters(name) VALUES('$waiter_name')";

    if ($conn->query($sql) === TRUE)
    {
        echo 'Waiter added Successfully!';
    }

}

else if(isset($_POST['id']) && isset($_POST['name']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sql = "UPDATE restaurant_tables SET name='$name' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE)
    {
        echo $name;
    }
}

else if(isset($_POST['waiter_id']) && isset($_POST['name']))
{
    $id = $_POST['waiter_id'];
    $name = $_POST['name'];
    $services = $_POST['services'];
    $sql = "UPDATE waiters SET name='$name',status = '$services' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE)
    {
        echo $name;
    }
}

else if(isset($_POST['waiter_name']))
{
    $name = $_POST['waiter_name'];
    $sql = "INSERT INTO restaurant_tables(name) VALUES('$name')";

    if ($conn->query($sql) === TRUE)
    {
        echo 'Table added Successfully!';
        header('location:table.php');
    }
}

else if(isset($_POST['tableidfordelete']))
{
    $id = $_POST['tableidfordelete'];
    $sql = "DELETE FROM restaurant_tables WHERE id = '$id'";

    if ($conn->query($sql) === TRUE)
    {
        echo 'Waiter Deleted Successfully!';
    }
    else
    {
        echo 'Failed';
    }
}

else if(isset($_POST['waiteridfordelete']))
{
    $id = $_POST['waiteridfordelete'];
    $sql = "DELETE FROM waiters WHERE id = '$id'";

    if ($conn->query($sql) === TRUE)
    {
        echo 'Waiter Deleted Successfully!';
    }
    else
    {
        echo 'Failed';
    }
}

else if(isset($_POST['inventoryidfordelete']))
{
    $id = $_POST['inventoryidfordelete'];
    $sql = "DELETE FROM inventory WHERE inventory_id = '$id'";

    if ($conn->query($sql) === TRUE)
    {
        echo 'Inventory Deleted Successfully!';
    }
    else
    {
        echo 'Failed';
    }
}

else if(isset($_POST['productidfordelete']))
{
    $id = $_POST['productidfordelete'];
    $sql = "DELETE FROM menu_products WHERE p_id = '$id'";

    if ($conn->query($sql) === TRUE)
    {
        echo 'Product Deleted Successfully!';
    }
    else
    {
        echo 'Failed';
    }
}

else if(isset($_POST['categoryidfordelete']))
{
    $id = $_POST['categoryidfordelete'];
    $sql = "DELETE FROM menu_categories WHERE category_id = '$id'";

    if ($conn->query($sql) === TRUE)
    {
        echo 'Category Deleted Successfully!';
    }
    else
    {
        echo 'Failed';
    }
}

else if(isset($_POST['customeridfordelete']))
{
    $id = $_POST['customeridfordelete'];
    $sql = "DELETE FROM customers WHERE id = '$id'";

    if ($conn->query($sql) === TRUE)
    {
        echo 'Customer Deleted Successfully!';
    }
    else
    {
        echo 'Failed';
    }
}

else if(isset($_POST['cat_name']))
{
    $name = $_POST['cat_name'];
    $sql = "INSERT INTO menu_categories(cat_name) VALUES('$name')";

    if ($conn->query($sql) === TRUE)
    {
         echo 'Category added Successfully!';
    }
}

// Add New Product
else if(isset($_POST['prodname']) && isset($_POST['prodprice']) && isset($_POST['proddiscount']) && isset($_POST['catid']) && isset($_POST['prodbarcode']))
{
    $prod_name = $_POST['prodname'];
    $prod_price = $_POST['prodprice'];
    $prod_discount = $_POST['proddiscount'];
    $cat_id = $_POST['catid'];
    $prod_barcode = $_POST['prodbarcode'];

    $sql = "INSERT INTO menu_products(p_name, p_price, discount_percent, cat_id, p_barcode) VALUES('$prod_name', '$prod_price', '$prod_discount', '$cat_id', '$prod_barcode')";

    if ($conn->query($sql) === TRUE)
    {
        echo 'Product added successfully!';
        location.replace("items.php");
    }
}

else if(isset($_POST['inventory_name']) && isset($_POST['inventory_quan']) && isset($_POST['inventory_id']))
{
        $name = $_POST['inventory_name'];
        $quan = $_POST['inventory_quan'];
        $id = $_POST['inventory_id'];
        $sql = "UPDATE inventory SET name = '$name',quantity = '$quan',notify = '0',lastupdated_on = NOW() WHERE inventory_id = '$id'";

        if ($conn->query($sql) === TRUE)
        {
            echo 'Inventory updated Successfully!';
        }
}

else if(isset($_POST['prod_name']) && isset($_POST['prod_price']) && isset($_POST['prod_code']) && isset($_POST['proddiscount']) && isset($_POST['p_id']) && isset($_POST['prodbarcode']))
{
        $name = $_POST['prod_name'];
        $price = $_POST['prod_price'];
        $prod_code = $_POST['prod_code'];
        $prod_discount = $_POST['proddiscount'];
        $id = $_POST['p_id'];
        $barcode = $_POST['prodbarcode'];

        $sql_check = "SELECT * FROM menu_products WHERE p_barcode ='$barcode'";
        $result = mysqli_query($conn, $sql_check);

        if(mysqli_num_rows($result) < 1)
        {
            $sql = "UPDATE menu_products SET p_name = '$name', p_price = '$price', p_code = '$prod_code', discount_percent = '$prod_discount', p_barcode = '$barcode' WHERE p_id = '$id'";

            if ($conn->query($sql) === TRUE)
            {
                echo 'Product updated successfully!';
            }
        }
        else
        {
            echo 'Product update failed due to duplicate barcode value';
        }
}

// Updating Menu Categories
else if(isset($_POST['cat_name_edit']) && isset($_POST['cat_id']))
{
        $cat_name = $_POST['cat_name_edit'];
        $cat_id = $_POST['cat_id'];

        $sql = "UPDATE menu_categories SET cat_name = '$cat_name' WHERE category_id = '$cat_id'";

        if ($conn->query($sql) === TRUE)
        {
            echo 'Category updated successfully!';
        }
}

// Updating Customers
else if(isset($_POST['customer_name_edit']) && isset($_POST['customer_contact_edit'])  && isset($_POST['customer_id']))
{
        $customer_name = $_POST['customer_name_edit'];
        $customer_contact = $_POST['customer_contact_edit'];
        $customer_id = $_POST['customer_id'];

        $sql = "UPDATE customers SET customer_name = '$customer_name', customer_contact = '$customer_contact' WHERE id = '$customer_id'";

        if ($conn->query($sql) === TRUE)
        {
            echo 'Customer updated successfully!';
        }
}

// Checking for Barcode
else if(isset($_POST['searched_barcode']))
{
    $barcode = $_POST['searched_barcode'];
    $sql = "SELECT * FROM menu_products WHERE p_barcode = '$barcode'";
    $result = $conn->query($sql);
    $array = [];

    if ($result->num_rows > 0)
    {
        while($r = mysqli_fetch_assoc($result))
        {
            $array[] = $r;
        }
        echo json_encode($array);
    }
    else
    {
        echo "0 results";
    }
}

// Adding Customer
else if(isset($_POST['customername']) && isset($_POST['customercontact']) && isset($_POST['customerid']))
{
    $customer_name = $_POST['customername'];
    $customer_contact = $_POST['customercontact'];
    $customer_id = $_POST['customerid'];
    $datetime = date("Y-m-d");

    $sql_check = "SELECT * FROM customers WHERE customer_ord_id = '$customer_id'";
    $result_check = mysqli_query($conn, $sql_check);

    if(mysqli_num_rows($result_check) > 0)
    {
        echo 'Customer already created in the system!';
    }
    else
    {
        $sql = "INSERT INTO customers(customer_name, customer_contact, customer_datetime, customer_ord_id) VALUES('$customer_name', '$customer_contact', '$datetime', '$customer_id')";
        $result = mysqli_query($conn, $sql);

        echo 'Customer added successfully!';

    }
}

//
else if(isset($_POST['dataforinventory']) && isset($_POST['cat_id']))
{
    $data = json_decode($_POST["dataforinventory"]);
    $data1 = $_POST['cat_id'];
    var_dump($data);
    var_dump($data1);
    $ids = array();
    $quans = array();
    $result;
    foreach($data as $Object)
    {
        $id = $Object->id;
        $quans = $Object->quan;

        $sql = "SELECT * FROM manageinventory WHERE inventory_id='$id' AND product_id='$data1'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0)
        {
            $sql = "UPDATE manageinventory SET deducted_qty = '$quans' WHERE inventory_id = '$id' AND product_id='$data1'";
            if ($conn->query($sql) == TRUE)
            {
                echo 'Product updated successfully!';
            }

            echo "found";
        }
        else
        {
            $query1 = "INSERT INTO manageinventory(inventory_id,product_id,deducted_qty) VALUES('$id','$data1','$quans')";
            if ($conn->query($query1) == TRUE)
            {
                echo 'Product insert Successfully!';
            }
        }
}

}

else if(isset($_POST['SendCatId']))
{
    $cat_id = $_POST['SendCatId'];
    $getData = "SELECT * FROM menu_products WHERE cat_id='$cat_id'";
    $result = $conn->query($getData);
    while($r = mysqli_fetch_assoc($result))
    {
      $array[] = $r;
    }
    echo json_encode($array);
}

else if(isset($_POST['OrderDetails']) && isset($_POST['customer_id']) && isset($_POST['workPeriodid']) && isset($_POST['order_type']))
{
   $data = json_decode($_POST["OrderDetails"]);
   $cust_id = $_POST['customer_id'];
   $workperiod = $_POST['workPeriodid'];
   $p_id;
   $ordertype = $_POST['order_type'];

   if ($ordertype == 0)
   {
       $query1 = "UPDATE orders SET status = 0 WHERE workperiod_id = $workperiod AND customer_id = $cust_id";
       $resultnew = $conn->query($query1);
   }

   foreach($data as $Object)
   {
       $p_id = $Object->p_id;
       $p_qty = $Object->p_quan;

       $sql = "SELECT inventory_id, deducted_qty FROM `manageinventory` WHERE product_id = '$Object->p_id'";
       $result = $conn->query($sql);
       $array = [];
       while($r = mysqli_fetch_assoc($result))
       {
           $ded_qty2 = $Object->p_quan;
           $ded_qty = $ded_qty2 * $r['deducted_qty'];
           $invet_id = $r['inventory_id'];
           echo $ded_qty2 . "   ".'\n';
           echo $ded_qty."   ";
           echo $invet_id;

           // update deducted QTY of inventory
           $sql = "UPDATE inventory SET quantity = quantity - '$ded_qty' WHERE inventory_id = '$invet_id'";
           $resultnew = $conn->query($sql);
       }

       //insert new order
       $date = date("Y-m-d");
       if ($ordertype == 0)
       {
           $query1 = "INSERT INTO orders(product_id, customer_id, workperiod_id, quantity, status, date_time) VALUES($p_id, '$cust_id', $workperiod, $p_qty, 0, '$date')";
           echo $query1;
           $resultnew = $conn->query($query1);
       }
   }
}

else if(isset($_POST['OrderDetailsForTakeaway']) && isset($_POST['waiter_id']) && isset($_POST['custid']))
{
    $data = json_decode($_POST["OrderDetailsForTakeaway"]);
    $waiter_id = $_POST['waiter_id'];
    $cust_id = $_POST['custid'];
    $p_id;

    //var_dump($data);
    // echo $waiter_id;
    // update table and waiter status of inventory

    foreach($data as $Object)
    {
        $p_id = $Object->p_id;
        $p_qty = $Object->p_quan;

        $sql = "SELECT inventory_id,deducted_qty FROM `manageinventory` WHERE product_id = '$Object->p_id'";
        $result = $conn->query($sql);
        $array = [];
        while($r = mysqli_fetch_assoc($result))
        {
            $ded_qty2 = $Object->p_quan;
            $ded_qty = $ded_qty2 * $r['deducted_qty'];
            $invet_id = $r['inventory_id'];
            echo $ded_qty2 . "   ".'\n';
            echo $ded_qty."   ";
            echo $invet_id;

            // update deducted QTY of inventory
            $sql = "UPDATE inventory SET quantity = quantity - '$ded_qty' WHERE inventory_id = '$invet_id'";
            $resultnew = $conn->query($sql);
        }

        //insert new order
        $date = date("Y-m-d");
        $query1 = "INSERT INTO takeaway_orders(product_id,waiter_id,customer_id,quantity,date_time) VALUES($p_id, $waiter_id, '$cust_id', $p_qty, '$date')";
                    echo $query1;
        $resultnew = $conn->query($query1);
    }
}

else if(isset($_POST['datefrom']) && isset($_POST['dateto']))
{
    $date_from = $_POST['datefrom'];
    $date_to = $_POST['dateto'];
    $sql = "SELECT orders.customer_id,orders.date_time FROM orders WHERE date_time >= '$date_from' AND date_time <= '$date_to' UNION SELECT takeaway_orders.customer_id,takeaway_orders.date_time FROM takeaway_orders WHERE date_time >= '$date_from' AND date_time <= '$date_to'";
    $result = $conn->query($sql);
    $array = [];
    while($r = mysqli_fetch_assoc($result))
    {
        $array[] = $r;
    }
    echo json_encode($array);
}

else if(isset($_POST['keywordforresult']))
{
    $cust_id = $_POST['keywordforresult'];
    $array = [];
    $sql = "SELECT DISTINCT orders.customer_id , orders.date_time FROM orders WHERE customer_id LIKE '%$cust_id%' GROUP BY orders.customer_id";
    $result = $conn->query($sql);

    while($r = mysqli_fetch_assoc($result))
    {
        $array[] = $r;
    }
    $sql = "SELECT DISTINCT takeaway_orders.customer_id , takeaway_orders.date_time FROM takeaway_orders WHERE takeaway_orders.customer_id LIKE '%$cust_id%' GROUP BY takeaway_orders.customer_id";
    $result = $conn->query($sql);

    while($r = mysqli_fetch_assoc($result))
    {
        $array[] = $r;
    }
    echo json_encode($array);

}

else if(isset($_POST['orderbycustomerid']))
{
    $cust_id = $_POST['orderbycustomerid'];
    $array = [];
    $sql = "SELECT product_id,quantity,date_time,p_name,p_price FROM orders o JOIN menu_products mp ON mp.p_id = o.product_id WHERE o.customer_id = '$cust_id'";
    $result = $conn->query($sql);

    while($r = mysqli_fetch_assoc($result))
    {
        $array[] = $r;
    }

    $sql = "SELECT product_id,quantity,date_time,p_name,p_price FROM takeaway_orders t JOIN menu_products mp ON mp.p_id = t.product_id WHERE t.customer_id = '$cust_id'";
    $result = $conn->query($sql);

    while($r = mysqli_fetch_assoc($result))
    {
        $array[] = $r;
    }
    echo json_encode($array);

}

else if(isset($_POST['datefrom_salesreport']) && isset($_POST['dateto_salesreport']))
{
    $date_from = $_POST['datefrom_salesreport'];
    $date_to = $_POST['dateto_salesreport'];
    $array = [];
    $sql = "select t.product_id,SUM(q) AS 'quantity',mp.p_name,mp.p_price * SUM(q) AS 'price' from (SELECT product_id,SUM(quantity) AS 'q' from takeaway WHERE date_time <= '$date_to' AND date_time >= '$date_from' GROUP BY product_id UNION SELECT product_id,SUM(quantity) AS 'q' from orders WHERE date_time <= '$date_to' AND date_time >= '$date_from' GROUP BY product_id) t JOIN menu_products mp ON mp.p_id = t.product_id GROUP BY t.product_id";
    $result = $conn->query($sql);

    while($r = mysqli_fetch_assoc($result))
    {
        $array[] = $r;
    }

    echo json_encode($array);
}

else if(isset($_POST['datefrom_waiterreport']) && isset($_POST['dateto_waiterreport']))
{
    $date_from = $_POST['datefrom_waiterreport'];
    $date_to = $_POST['dateto_waiterreport'];
    $array = [];
    $sql = "SELECT t.waiter_id,COUNT(t.customer_id) AS 'sales',w.name AS 'waiter_name'FROM(SELECT DISTINCT(waiter_id),customer_id from orders WHERE date_time <= '$date_to' AND date_time >= '$date_from') t JOIN waiters w ON w.id = t.waiter_id GROUP BY t.waiter_id";
    $result = $conn->query($sql);

    while($r = mysqli_fetch_assoc($result))
    {
        $array[] = $r;
    }

    echo json_encode($array);

}

//TENDER ORDER - ORDER STATUS 2
else if(isset($_POST['period_id_settle']))
{
    $workperiod_id = $_POST['period_id_settle'];
    $sql = "UPDATE orders SET status = 2 WHERE workperiod_id = '$workperiod_id'";
    $result1 = $conn->query($sql);
}

else if(isset($_POST['startwork']))
{
    $sql = "INSERT INTO work_periods(status) VALUES(0)";
    $result1 = $conn->query($sql);

    $sql = "SELECT * from work_periods WHERE status = 0";
    $result1 = $conn->query($sql);
    $result1;
    $array = array();

    while($r = mysqli_fetch_assoc($result1))
    {
        $array[] = $r;
    }

    echo json_encode($array);
}
else if(isset($_POST['endwork']))
{
    $workperiod_id = $_POST['workperiod_id_end'];

    $sql = "SELECT * FROM orders o LEFT JOIN menu_products mp on o.product_id = mp.p_id WHERE (o.workperiod_id = $workperiod_id) AND o.status != 2";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result) > 0)
    {
        $array = array();
        while($r = mysqli_fetch_assoc($result))
        {
            $array[] = $r;
        }

        echo json_encode($array);

    }
    else
    {
        $sql = "UPDATE work_periods SET status = 1";
        $result1 = $conn->query($sql);
    }

}
else if(isset($_POST['resumework']))
{

    $sql = "SELECT * from work_periods WHERE status = 0";
    $result1 = $conn->query($sql);
    $result1;
    while($r = mysqli_fetch_assoc($result1))
    {
        $array[] = $r;
    }

    echo json_encode($array);

}

//START ORDER ON PAGE LOAD
else if(isset($_POST['workPeriodid']) && isset($_POST['status']))
{
   $workperiod = $_POST['workPeriodid'];
   $status = $_POST['status'];

   $sql = "SELECT orders.product_id, orders.customer_id, orders.quantity, menu_products.p_name, menu_products.p_price, menu_products.discount_percent, menu_products.cat_id FROM orders INNER JOIN menu_products ON orders.product_id=menu_products.p_id WHERE orders.workperiod_id = '$workperiod' AND orders.status = '$status'";
   $result = $conn->query($sql);
   $array = [];

   while($r = mysqli_fetch_assoc($result))
   {
       $array[] = $r;
   }

   echo json_encode($array);
}


//CHECKING FOR WORK PERIOD STATUS FOR END WORK PERIOD BUTTON
else if(isset($_POST['workperiod_status']))
{
   $workperiod_status = $_POST['workperiod_status'];

   $sql = "SELECT * FROM work_periods WHERE status = '$workperiod_status'";
   $result = $conn->query($sql);
   $array = [];

   while($r = mysqli_fetch_assoc($result))
   {
       $array[] = $r;
   }

   echo json_encode($array);
}

else if(isset($_POST['workPeriodId_start']) && isset($_POST['status_start']))
{
   $workperiod = $_POST['workPeriodId_start'];
   $status = $_POST['status_start'];

   $sql = "SELECT orders.product_id, orders.customer_id, orders.quantity, menu_products.p_name, menu_products.p_price, menu_products.cat_id FROM orders INNER JOIN menu_products ON orders.product_id=menu_products.p_id WHERE orders.workperiod_id = '$workperiod' AND orders.status = '$status'";
   $result = $conn->query($sql);
   $array = [];

   while($r = mysqli_fetch_assoc($result))
   {
       $array[] = $r;
   }

   $array_count = sizeof($array);


   if($array_count > 0)
   {
       echo json_encode($array);
   }
   else
   {
       echo $array_count;
   }
}

else if(isset($_POST['damage_qty_data']))
{

  $data = json_decode($_POST["damage_qty_data"]);

  foreach($data as $Object)
  {
        $p_id = $Object->p_id;
        $damage_qty = $Object->damage_qty;
        $waiter_id = $Object->waiter_id;
        $service_Num = $Object->service_Num;
        $workperiodid = $Object->workperiodid;

        $date = date("Y-m-d");
        $sql = "SELECT * FROM damage WHERE product_id = $p_id AND workperiod_id = $workperiodid";
        $result = $conn->query($sql);

        if (mysqli_num_rows($result) > 0)
        {
          //update
          echo $damage_qty."\n".$p_id."\n".$date;
          $sql = "UPDATE damage SET no_of_damages = no_of_damages + '$damage_qty' WHERE  workperiod_id = $workperiodid AND product_id ='$p_id'";

          if ($conn->query($sql) == TRUE)
          {
                echo 'damage updated Successfully!';
          }
          echo "update damage table";
        }

        else
        {
              $sql = "INSERT INTO damage(workperiod_id,product_id,no_of_damages,date_time) VALUES('$workperiodid','$p_id','$damage_qty','$date')";
              $result = $conn->query($sql);
        }
   }

    $sql = "SELECT product_id, quantity FROM orders WHERE workperiod_id = '$workperiodid'";
    $result = $conn->query($sql);

        while($r = mysqli_fetch_assoc($result))
        {

          foreach($data as $Object)
          {

            $p_id = $Object->p_id;
            $damage_qty = $Object->damage_qty;

            if ($p_id == $r['product_id'])
            {

              $newqty=$r['quantity'] - $damage_qty;

              if ($newqty==0)
              {
                $sql = "DELETE FROM orders WHERE workperiod_id = '$workperiodid' AND product_id ='$p_id'";
                $resultnew = $conn->query($sql);

              }
              else
              {
                $sql = "UPDATE orders SET quantity = '$newqty' WHERE waiter_id = '$waiter_id' AND service_id = '$service_Num' AND workperiod_id = '$workperiodid' AND product_id ='$p_id'";
                $resultnew = $conn->query($sql);
              }
            }
          }
        }
}

else if(isset($_POST['workPeriodid']) && isset($_POST['update_qty']) && isset($_POST['product_id']) && isset($_POST['customer_id']))
{
    $workperiod = $_POST['workPeriodid'];
    $update_qty = $_POST['update_qty'];
    $product_id = $_POST['product_id'];
    $customer_id = $_POST['customer_id'];

    //Product QTY update on addmore button
    $sql = "UPDATE orders SET quantity = quantity + '$update_qty' WHERE workperiod_id = '$workperiod' AND product_id ='$product_id' AND customer_id = '$customer_id'";
    $resultnew = $conn->query($sql);

    //inventory update on addmore button
    $sql = "SELECT inventory_id, deducted_qty FROM `manageinventory` WHERE product_id = '$product_id'";
    $result = $conn->query($sql);
    $array = [];
    while($r = mysqli_fetch_assoc($result))
    {
        $ded_qty = $update_qty * $r['deducted_qty'];
        $invet_id = $r['inventory_id'];

        // update deducted QTY of inventory
        $sql = "UPDATE inventory SET quantity = quantity - '$ded_qty' WHERE inventory_id = '$invet_id'";
        $resultnew = $conn->query($sql);
    }

    echo $resultnew;
}

else if(isset($_POST['workPeriodid']) && isset($_POST['minus_qty']) && isset($_POST['product_id']) && isset($_POST['customer_id']))
{
    $workperiod = $_POST['workPeriodid'];
    $minus_qty = $_POST['minus_qty'];
    $product_id = $_POST['product_id'];
    $customer_id = $_POST['customer_id'];

    //Product QTY update on cancel button
    $sql = "UPDATE orders SET quantity = quantity - '$minus_qty' WHERE workperiod_id = '$workperiod' AND product_id ='$product_id' AND customer_id = '$customer_id'";
    $resultnew = $conn->query($sql);

    //Inventory update on cancel button
    $sql = "SELECT inventory_id,deducted_qty FROM `manageinventory` WHERE product_id = '$product_id'";
    $result = $conn->query($sql);
    $array = [];

    while($r = mysqli_fetch_assoc($result))
    {
        $ded_qty = $minus_qty * $r['deducted_qty'];
        $invet_id = $r['inventory_id'];

        // update QTY of inventory
        $sql = "UPDATE inventory SET quantity = quantity + '$ded_qty' WHERE inventory_id = '$invet_id'";
        $resultnew = $conn->query($sql);
    }

    echo "Cancel Works";
}

else if(isset($_POST['workperiod_id_bill']) && isset($_POST['cust_id_bill']))
{
  $workperiod = $_POST['workperiod_id_bill'];
  $custid = $_POST['cust_id_bill'];

  $sql = "UPDATE orders SET status = 1 WHERE customer_id = '$custid' AND workperiod_id = $workperiod";
  $resultnew = $conn->query($sql);

}

else if(isset($_POST['wPeriod_id_discount']) && isset($_POST['discountprice']) && isset($_POST['totalprice']))
{

  $workperiod_id = $_POST['wPeriod_id_discount'];
  $discount_price = $_POST['discountprice'];
  $total_price = $_POST['totalprice'];

  echo($discount_price);
  $date = date("Y-m-d");

  $sql = "INSERT INTO discount(workperiod_id,discount_price,total_price,date_time) VALUES('$workperiod_id','$discount_price','$total_price','$date')";
  $result = $conn->query($sql);

}

//X REPORT FOR ORDERS
else if(isset($_POST['report_type']) && $_POST['report_type'] == "x-report-dine-in")
{
    $array = [];
    $sql_workperiod_id = "SELECT MAX( workperiod_id ) AS max FROM work_periods WHERE status = 0";
    $result_workperiod_id = $conn->query($sql_workperiod_id);
    while($r = mysqli_fetch_assoc($result_workperiod_id))
    {
        $workperiod_id = $r;
    }
    $sql_orders = "SELECT mp.p_name,product_id,SUM(quantity) AS 'quantity',mp.p_price,SUM(quantity)*mp.p_price AS 'totalprice' from orders JOIN menu_products mp ON mp.p_id = orders.product_id WHERE workperiod_id = ".$workperiod_id['max']." GROUP BY product_id";
    $result_orders = $conn->query($sql_orders);
    while($r = mysqli_fetch_assoc($result_orders))
    {
        $array[] = $r;
    }
    echo json_encode($array);

}

else if(isset($_POST['report_type']) && $_POST['report_type'] == "x-report-takeaway")
{
    $array = [];
    $sql_workperiod_id = "SELECT MAX( workperiod_id ) AS max FROM work_periods WHERE status = 0";
    $result_workperiod_id = $conn->query($sql_workperiod_id);
    while($r = mysqli_fetch_assoc($result_workperiod_id))
    {
        $workperiod_id = $r;
    }
    $sql_takeaway = "SELECT mp.p_name,product_id,SUM(quantity) AS 'quantity',mp.p_price,SUM(quantity)*mp.p_price AS 'totalprice' from takeaway JOIN menu_products mp ON mp.p_id = takeaway.product_id WHERE workperiod_id = ".$workperiod_id['max']." GROUP BY product_id";

    $result_takeaway = $conn->query($sql_takeaway);
    while($r = mysqli_fetch_assoc($result_takeaway))
    {
        $array[] = $r;
    }
    $msg = "There were no records for takeaway today";
    echo json_encode($array);
}

else if(isset($_POST['report_type']) && $_POST['report_type'] == "x-report-damage")
{
    $array = [];
    $sql_workperiod_id = "SELECT MAX( workperiod_id ) AS max FROM work_periods WHERE status = 0";
    $result_workperiod_id = $conn->query($sql_workperiod_id);
    while($r = mysqli_fetch_assoc($result_workperiod_id))
    {
        $workperiod_id = $r;
    }
    $sql_takeaway = "SELECT mp.p_name,product_id,no_of_damages,mp.p_price,no_of_damages*mp.p_price AS 'totalprice' from damage JOIN menu_products mp ON mp.p_id = damage.product_id WHERE workperiod_id = ".$workperiod_id['max'];

    $result_takeaway = $conn->query($sql_takeaway);
    while($r = mysqli_fetch_assoc($result_takeaway))
    {
        $array[] = $r;
    }
    echo json_encode($array);

}

else if(isset($_POST['report_type']) && $_POST['report_type'] == "x-report-discount")
{
    $array = [];
    $sql_workperiod_id = "SELECT MAX( workperiod_id ) AS max FROM work_periods WHERE status = 0";
    $result_workperiod_id = $conn->query($sql_workperiod_id);
    while($r = mysqli_fetch_assoc($result_workperiod_id))
    {
        $workperiod_id = $r;
    }
    $sql_takeaway = "SELECT discount_price FROM discount WHERE workperiod_id = ".$workperiod_id['max'];
    $result_takeaway = $conn->query($sql_takeaway);

    while($r = mysqli_fetch_assoc($result_takeaway))
    {
        $array[] = $r;
    }
    echo json_encode($array);

}

//Z REPORT FOR ORDERS
else if(isset($_POST['report_type']) && $_POST['report_type'] == "z-report-takeaway")
{
    $array = [];
    $date_from = $_POST['datefrom_zreport'];
    $date_to = $_POST['dateto_zreport'];
    $sql_takeaway = "SELECT mp.p_name,product_id,SUM(quantity) AS 'quantity',mp.p_price,SUM(quantity)*mp.p_price AS 'totalprice' from takeaway JOIN menu_products mp ON mp.p_id = takeaway.product_id WHERE date_time <= '$date_to' AND date_time >= '$date_from' GROUP BY product_id";

    $result_takeaway = $conn->query($sql_takeaway);
    while($r = mysqli_fetch_assoc($result_takeaway))
    {
        $array[] = $r;
    }
    echo $sql_takeaway;

}

else if(isset($_POST['report_type']) && $_POST['report_type'] == "z-report-dine-in")
{
    $array = [];
    $date_from = $_POST['datefrom_zreport'];
    $date_to = $_POST['dateto_zreport'];
    $sql_takeaway = "SELECT mp.p_name,product_id,SUM(quantity) AS 'quantity',mp.p_price,SUM(quantity)*mp.p_price AS 'totalprice' from orders JOIN menu_products mp ON mp.p_id = orders.product_id WHERE date_time <= '$date_to' AND date_time >= '$date_from' GROUP BY product_id";
    $result_takeaway = $conn->query($sql_takeaway);
    while($r = mysqli_fetch_assoc($result_takeaway))
    {
        $array[] = $r;
    }
    echo json_encode($array);

}

else if(isset($_POST['report_type']) && $_POST['report_type'] == "z-report-damage")
{
    $array = [];
    $date_from = $_POST['datefrom_zreport'];
    $date_to = $_POST['dateto_zreport'];
    $sql_takeaway = "SELECT mp.p_name,product_id,no_of_damages,mp.p_price,no_of_damages*mp.p_price AS 'totalprice' from damage JOIN menu_products mp ON mp.p_id = damage.product_id WHERE  date_time <= '$date_to' AND date_time >= '$date_from' GROUP BY product_id";

    $result_takeaway = $conn->query($sql_takeaway);
    while($r = mysqli_fetch_assoc($result_takeaway))
    {
        $array[] = $r;
    }

    echo json_encode($array);

}

else if(isset($_POST['report_type']) && $_POST['report_type'] == "z-report-discount")
{
    $array = [];
    $date_from = $_POST['datefrom_zreport'];
    $date_to = $_POST['dateto_zreport'];
    $sql_workperiod_id = "SELECT MAX( workperiod_id ) AS max FROM work_periods WHERE status = 0";
    $result_workperiod_id = $conn->query($sql_workperiod_id);
    while($r = mysqli_fetch_assoc($result_workperiod_id))
    {
        $workperiod_id = $r;
    }

    $sql_takeaway = "SELECT discount_price FROM discount WHERE date_time <= '$date_to' AND date_time >= '$date_from'";
    $result_takeaway = $conn->query($sql_takeaway);

    while($r = mysqli_fetch_assoc($result_takeaway))
    {
        $array[] = $r;
    }

    echo json_encode($array);
}

else
{
    //echo 'Error !';
}

?>