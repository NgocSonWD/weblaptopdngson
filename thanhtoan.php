<?php
    include("connect.php");
    session_start(); 
    $cart =  $_SESSION['cart'];
    
    if(isset($_SESSION['login']['username'])){
        $username = $_SESSION['login']['username'];
        $sql_user = "select * from user where username = '".$username."'";
        $sql_query_user = mysqli_query($conn, $sql_user);
        $rows_user = mysqli_fetch_array($sql_query_user);
        $id_user = $rows_user['id_user'];
        $fullname = $rows_user['fullname'];
    }

    require 'carbon/autoload.php';
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $now = carbon::now('Asia/Ho_Chi_Minh');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="thanhtoan.css">
    <title>Thanh Toán</title>
</head>
<body>
    <form action="" method ="post">  
        <div class="container">
            
            <div>
                <h1>Thanh Toán</h1>
            </div>
            <div>
                <p>Tên người nhận: </p>
                <input class="nhap" type="text" name="ten" value= " <?php echo $fullname ?>" >
            </div>
            <div>
                <p>Số điện thoại: </p>
                <input class="nhap" type="text" name="sdt" placeholder="Nhập số điện thoại">
            </div>
            <div>
                <p>Địa chỉ: </p>
                <input class="nhap" type="text" name="diachi" placeholder="Nhập địa chỉ">
            </div>
            <table>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hãng sản xuất</th>
                    <th>Hình ảnh</th>
                    <th>Đơn giá</th>
                    <th>số lượng</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
                $stt = 0;
                $tong = 0;
                foreach($cart as $id => $each):
                ?>
                    <tr>
                        <td class="table__row--stt"><p class="stt"><?php echo $stt+1 ?></p></td>
                        <td class="table__row--tensp"> <p class="ten"><?php echo $each['name'] ?></p></td>
                        <td class="table__row--hinhanh"> <p class="ten"><?php echo $each['hangsx'] ?></p></td>
                        <td class="table__row--hinhanh"><img class ="imgsp" src="IMG/sanpham/<?php echo $each['anh'] ?>" alt="loi anh"></td>
                        <td class="table__row--gia">
                            <?php
                                $money = $each['gia'];
                                $formattedMoney = number_format($money);
                            ?>
                            <p><?php echo $formattedMoney . "đ" ?></p> 
                        </td>
                        <td class="table__row--soluong">
                            <div>
                                <?php echo $each['soluong']?>
                            </div>                     
                        </td>
                        <?php
                            $thanhtien = $each['gia'] * $each['soluong'];
                            $tien = number_format($thanhtien);
                            $tong +=$thanhtien;
                        ?>
                        <td class="table__row--thanhtien"><?php echo $tien ."đ" ?></td>
                <?php
                $stt++;
                endforeach
                ?>
                <tr>
                    <td  colspan ="6"><p class="tong" >Tổng</p></td>
                    <td>
                        <p><?php
                            $fmm = number_format($tong);
                            echo $fmm ."đ" ?>
                        </p>
                    </td>
                </tr>
            </table>
            <div>
                <input class="thanhtoan-btn" type="submit" name="thanhtoan" value="Thanh toán">
            </div>
        </div>
    </form>
    <?php
        if(isset($_POST['thanhtoan'])){
            $name = $_POST["ten"];
            $sdt = $_POST["sdt"];
            $dc = $_POST["diachi"];
            $total = $tong;
            
            if($name && $sdt && $dc && $total){
                $sql = "INSERT INTO cart (fullname, address, tel, total, cart_date, user_id) values ('$name','$dc','$sdt','$total','$now','$id_user')";

                $query = mysqli_query($conn, $sql);
                $sql_maxid = "select max(id) from cart where user_id = $id_user";   
                $query_maxid = mysqli_query($conn,$sql_maxid);

                $order_id = mysqli_fetch_array($query_maxid)['max(id)'];
                
                foreach($cart as $product_id => $each){
                    $quantity = $each['soluong'];
                    $sql_ordt= "INSERT INTO add_to_cart(masp_id, cart_id, soluong) values
                    ('$product_id','$order_id','$quantity')";
                    $query_ordt=mysqli_query($conn,$sql_ordt);


                    $tg = date($now);
                    if(isset($tg)){
                        $sql_tk= "INSERT INTO thongke(ngaymua, soluong, doanhthu) values
                            ('$tg','$quantity','$total')";
                        $query_tk=mysqli_query($conn,$sql_tk);
                    }
                    


                    if($query_ordt){
                        header("Location:tt_complete.php");
                    }
                }
            }
            else{
                ?>
                    <p class="tbtt">Vui lòng nhập đủ thông tin</p>
                <?php
            }
        }
    ?>
</body>
</html>