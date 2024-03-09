<?php
    include('connect.php');
    session_start();
    $masp = $_GET['masp'];
    if(empty($_SESSION['cart'][$masp])){
        $sql = "select * from san_pham where masp = '$masp'";
        $query = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_array($query);
        $_SESSION['cart'][$masp]['name'] = $rows['tensp'];

        $_SESSION['cart'][$masp]['hangsx'] = $rows['hangsx'];

        $_SESSION['cart'][$masp]['anh'] = $rows['hinhanh'];
        $_SESSION['cart'][$masp]['gia'] = $rows['gia'];
        $_SESSION['cart'][$masp]['soluong'] = 1;
    }
    header("Location:thanhtoan.php");
?>