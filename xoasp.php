<?php
    include('connect.php');
    session_start();
    $masp = $_GET['masp'];
    unset($_SESSION['cart'][$masp]);
    header('location:addtocart.php');
?>