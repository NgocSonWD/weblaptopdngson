<?php
    ob_start();
    include("connect.php");
    session_start();
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addtocart.css">
    <title>Giỏ hàng</title>
    
</head>
<body>
    <?php
        include("header.php");
    ?>
    <?php
        if(isset($_SESSION['login']['username'])){
            if(isset($_SESSION['cart'])){
                ?>
                    <table class="table">
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hãng sản xuất</th>
                        <th>Hình ảnh</th>
                        <th>Đơn giá</th>
                        <th>số lượng</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>
                    <?php
                    $stt = 0;
                    $tong = 0;
                    foreach($cart as $id => $each):
                    ?>
                        <tr>
                            <td class="table__row--stt"><p class="stt"><?php echo $stt+1 ?></p></td>
                            <td class="table__row--tensp"><?php echo $each['name'] ?></td>
                            <td class="table__row--gia"><?php echo $each['hangsx'] ?></td>
                            <td class="table__row--hinhanh"><img class ="imgsp" src="IMG/sanpham/<?php echo $each['anh'] ?>" alt="loi anh"></td>
                            <td class="table__row--gia">
                                <?php
                                    $money = $each['gia'];
                                    $formattedMoney = number_format($money);
                                ?>
                                <p class ="giatien"><?php echo $formattedMoney . "đ" ?></p> 
                            </td>   
                            <td class="table__row--soluong">

                                <div class ="congtru">
                                    <div class="tru">
                                        <a href="trugh.php?masp=<?php echo $id ?>"> <p>-</p> </a>
                                    </div>
                                    &emsp;
                                    <div>
                                        <?php echo $each['soluong'] ?>  
                                    </div>
                                    &emsp;  
                                    <div class="cong">
                                        <a href="conggh.php?masp=<?php echo $id ?>"> <p>+</p> </a>    
                                    </div>
                                </div>

                            </td>
                            <?php
                                $thanhtien = $each['gia'] * $each['soluong'];
                                $tien = number_format($thanhtien);
                                $tong +=$thanhtien;
                            ?>
                            <td class="table__row--thanhtien"> <p class ="thanhtien"><?php echo $tien ."đ" ?></p></td>
                            <td class="table__row--xoa"><a class="btn_xoa" href="xoasp.php?masp=<?php echo $id ?>">Xóa</a></td>
                            
                        </tr>
                <?php
                    $stt++;
                    endforeach
                    ?>
                    <tr>
                        <td  colspan ="6"><p class="tong" >Tổng</p></td>
                        <td>
                            <p class="tong__so"><?php
                                $fmm = number_format($tong);
                                echo $fmm ."đ" ?>
                            </p>
                        </td>
                    </tr>
                    </table>
                    <div class="thanhtoan">
                        <a class="thanhtoan_btn" href="thanhtoan.php">Đặt hàng</a>
                        <a class="thanhtoan_btn" href="remove_cart.php">Xóa đơn hàng</a>
                    </div>
                    <?php
            }
        }
        else{
            ?>
            <p class="tb" >
                Vui lòng
                <a class="tb_login" href="login.php">đăng nhập</a>
                !
            </p>
            <?php
        }
        ob_end_flush();   
    ?>
</body>
</html>