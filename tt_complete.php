<?php
    session_start();
    $cart =  $_SESSION['cart'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tt_complete.css">
    <title>Thanh toán thành công</title>
</head>
<body>
    <div class="container">
        <div class="tieude">
            <h1>THANH TOÁN THÀNH CÔNG</h1>
        </div>
        <table>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
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
                    <td class="table__row--tensp"><?php echo $each['name'] ?></td>
                    <td class="table__row--hinhanh"><img class ="imgsp" src="IMG/sanpham/<?php echo $each['anh'] ?>" alt="loi anh"></td>
                    <td class="table__row--gia">
                        <?php
                            $money = $each['gia'];
                            $formattedMoney = number_format($money);
                        ?>
                        <p><?php echo $formattedMoney . "đ" ?></p> 
                    </td>
                    <td class="table__row--soluong"><?php echo $each['soluong'] ?></td>
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
                <td  colspan ="5"><p class="tong" >Tổng</p></td>
                <td>
                    <p><?php
                        $fmm = number_format($tong);
                        echo $fmm ."đ" ?>
                    </p>
                </td>
            </tr>
        </table>
        <?php
            unset($_SESSION['cart']);
        ?>
        <a class="ttgd" href="index.php">Tiếp tục giao dịch khác</a>
    </div>  
</body>
</html>