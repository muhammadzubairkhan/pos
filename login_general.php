<?php

//session_start();
include("include/dbconnect.php");
include_once "include/session.php";

//3. If the form is submitted or not.
//3.1 If the form is submitted

if (isset($_POST["general_login"]) && isset($_POST['user_name']) && isset($_POST['password']))
{
   //3.1.1 Assigning posted values to variables.
   
   $user_name = $_POST['user_name'];
   $password = $_POST['password'];
    
    //   echo $user_name;
    //   echo $password;
    
   //3.1.2 Checking the values are existing in the database or not
   $query_for_admin = "SELECT * FROM users WHERE USER_NAME='$user_name' AND PASSWORD='$password'";

   $result_for_admin = mysqli_query($conn, $query_for_admin) or die(mysqli_error($conn));
   $count_for_admin = mysqli_num_rows($result_for_admin);
   
   $row_for_admin = mysqli_fetch_assoc($result_for_admin);
   //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
   if ($count_for_admin == 1)
   {       
       $_SESSION['user_name'] = $row_for_admin["USER_NAME"];
       $_SESSION['user_password'] = $row_for_admin["PASSWORD"];
       
       ?>

       <script>

          //console.log("Failed");
          alert("Successfully Logged In.");
          window.location="home.php";

       </script>

       <?php
       
       
   }

   else
   {
       
   ?>

       <script>

          //console.log("Failed");
          alert("Invalid Login Credentials");
          window.location="login.php";

       </script>

   <?php
       
   

   }
}

?>