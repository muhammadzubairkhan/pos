<?php

    $server = "localhost";
    $username = "root";
    $pass = "";
    $db = "barcode-pos";

//    $server = "172.16.1.25";
//    $username = "osama";
//    $pass = "osama123";
//    $db = "pos_new";

    //create connection
    $conn = mysqli_connect($server,$username,$pass,$db);

    //check conncetion
    //Returns the error code from the last connection error
    if(mysqli_connect_errno())
	{
        die ("Connection Failed! " . mysqli_connect_error());
    }
	
?>