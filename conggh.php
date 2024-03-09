<?php
    include('connect.php');
    session_start();
    $masp = $_GET['masp'];
    if(isset($_SESSION['cart'][$masp])){
        $_SESSION['cart'][$masp]['soluong']++;
    }
    header("Location:addtocart.php");
?>