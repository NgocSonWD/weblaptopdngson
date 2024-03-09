<?php
    include('connect.php');
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['cart']);
    header('location:index.php');
?>