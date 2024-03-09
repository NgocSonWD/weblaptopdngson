<?php
    include('connect.php');
    session_start();
    $masp = $_GET['masp'];
    if(isset($_SESSION['cart'][$masp])){
        if($_SESSION['cart'][$masp]['soluong'] > 0){
            $_SESSION['cart'][$masp]['soluong']--;
        }   
    }
    header("Location:addtocart.php");
?>