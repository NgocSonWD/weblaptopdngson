<?php
    include('connect.php');
    session_start();
    unset($_SESSION['cart']);
    header('location:addtocart.php');
?>