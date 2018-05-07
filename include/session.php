<?php

session_start();

$admin = false;

if(isset($_SESSION['user_name']) && isset($_SESSION['user_password']) && $_SESSION['user_name'] === "admin" && $_SESSION['user_password'] === "admin123")
{
    $admin = true;
}
else
{
    $admin = false;
}

?>