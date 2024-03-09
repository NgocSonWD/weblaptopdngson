<?php

    ob_start();
    include("connect.php");
    session_start();
    require 'carbon/autoload.php';
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $now = carbon::now('Asia/Ho_Chi_Minh');
    $datenow = date($now);

    if(isset($_GET['thoigian'])){
        $thoigian = $_GET['thoigian'];
      }else{
        $thoigian = "";
        $subdays365 = carbon::now('Asia/Ho_Chi_Minh')->subdays(365);
        $dategh = date($subdays365);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view.css">
    <title>Trang Admin</title>
</head>
<body>
    <div class="header">
        <div class="headertrai">
            <p class="headertrai_ten"><i class="fa-solid fa-user"></i> <?php echo " Xin chào " .$_SESSION['login']['username'] ?> </p>
        </div>
        <div class="headerphai">
            <a class="headerphai_tc" href="index.php">   
                Trang chủ
            </a>
            <a href="logout.php">
                Đăng xuất
            </a>
        </div>
    </div>
    <div class="thanhngang">
        <h2 class="tenmenu">Admin menu</h2>
        <ul>
            <li class="ttnd"> <a href="#thongtinnguoidung">Thông tin người dùng</a></li>
            <li class="ttsp"> <a href="#thongtinsanpham">Thông tin sản phẩm</a></li>
            <li class="lsgd"><a href="#lichsugiaodich">Lịch sử giao dịch</a></li>
            <li class="tk"><a href="#thongke">Thống kê</a></li>
        </ul>
    </div>
    <div class="noidung">
        <div id="thongtinnguoidung">
            <table class="table__nd">
                    <tr class="tencot">
                        <th>STT</th>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                <?php
                    $stt = 0;
                    $ttnd = "select * from user";
                    $query_ttnd = mysqli_query($conn,$ttnd);
                    while($rows_ttnd = mysqli_fetch_array($query_ttnd)){
                ?>
                    <tr class="hang">
                        <form action="" method="post">
                            <td class="thongtinnguoidung__stt"><?php echo $stt+1 ?></td>
                            <td class="thongtinnguoidung__id"><?php echo $rows_ttnd['id_user']?></td>
                            <td class="thongtinnguoidung__ten"><?php echo $rows_ttnd['username']?></td>
                            <td class="thongtinnguoidung__full"><?php echo $rows_ttnd['fullname']?></td>
                            <td class="thongtinnguoidung__sua"><a href="suauser.php?id_user=<?=$rows_ttnd['id_user']?>">Sửa</a></td>
                            <td class="thongtinnguoidung__xoa"><input class="btn_del" type="submit" name="ttnd_xoa" value="Xóa"></td>
                            <input type="text" name="id_xoa" value="<?=$rows_ttnd["id_user"]?> " hidden>
                        </form>
                    </tr>              
                <?php
                    $stt++;
                    }                   
                    if(isset($_POST['ttnd_xoa'])){
                        $ttnd_del = $_POST['id_xoa'];
                        $ttnd_xoa = "delete from user where id_user = $ttnd_del";
                        $query_ttnd_xoa = mysqli_query($conn, $ttnd_xoa);
                        if($query_ttnd_xoa){
                            header("refresh: 0");
                        }
                    }
                    $query_ttnd_user = mysqli_query($conn,$ttnd);
                    $rows_ttndadd = mysqli_fetch_array($query_ttnd_user);
                ?>
            </table>
            <div class="hang_them">
                <a href="adduser.php?id=<?=$rows_ttndadd['id_user']?>">Thêm</a>
            </div>
        </div>
        <div id="thongtinsanpham">
            <table class="table__sp">
                    <tr class="tencot">
                        <th>STT</th>
                        <th>MãSP</th>
                        <th>TênSP</th>
                        <th>HãngSX</th>
                        <th>Đơn giá</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>TTSP</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                <?php
                    $stt = 0;
                    $ttsp = "select * from san_pham";
                    $query_ttsp = mysqli_query($conn,$ttsp);
                    while($rows_ttsp = mysqli_fetch_array($query_ttsp)){
                ?>
                    <tr class="hangsp">
                        <td class="thongtinnguoidung__stt"><?php echo $stt+1 ?></td>
                        <td class="thongtinnguoidung__masp"><?php echo $rows_ttsp['masp']?></td>
                        <td class="thongtinnguoidung__tensp"><?php echo $rows_ttsp['tensp']?></td>
                        <td class="thongtinnguoidung__hangsx"><?php echo $rows_ttsp['hangsx']?></td>
                        <td class="thongtinnguoidung__gia">
                            <?php
                                $money = $rows_ttsp['gia'];
                                $formattedMoney = number_format($money);
                            ?>
                            <p><?php echo $formattedMoney . "đ" ?></p>
                        </td>
                        <td class="thongtinnguoidung__hinhanh">
                            <img class ="imgsp" src="IMG/sanpham/<?php echo $rows_ttsp['hinhanh'] ?>" alt="loi anh">
                        </td>
                        <td class="thongtinnguoidung__sl"><?php echo $rows_ttsp['soluong']?></td>
                        <td class="thongtinnguoidung__ttsp"><?php echo nl2br($rows_ttsp['ttsp']) ?></td>


                        <td class="thongtinnguoidung__sua"><a href="suasp.php?masp=<?=$rows_ttsp['masp']?>">Sửa</a></td>


                        <form action="" method="POST">
                            <td class="thongtinnguoidung__xoa"><input class="btn_del" type="submit" name="ttsp_xoa" value="Xóa"></td>
                            <input type="text" name="idsp_xoa" value = "<?=$rows_ttsp['masp']?> " hidden >  
                        </form>
                        
                    </tr>              
                <?php
                    $stt++;
                    }
                    if(isset($_POST['ttsp_xoa'])){
                        $ttnd_delsp = $_POST['idsp_xoa'];
                        $ttsp_xoa = "delete from san_pham where masp = $ttnd_delsp";
                        $query_ttsp_xoa = mysqli_query($conn, $ttsp_xoa);
                        if($query_ttsp_xoa){
                            header("refresh: 0");
                        }
                    }
                    $query_ttsp_add = mysqli_query($conn,$ttsp);
                    $rows_ttsp_add = mysqli_fetch_array($query_ttsp_add);
                    //?masp=<?=$rows_ttsp_add['masp']
                ?>
            </table>
            <div class="hang_them">
                <a href="addsp.php">Thêm</a>   
            </div>
        </div>
        <div id="lichsugiaodich">
            <table class="table__ls">
                    <tr class="tencot">
                        <th>STT</th>
                        <th>ID</th>
                        <th>Fullname</th>
                        <th>Địa chỉ</th>
                        <th>SDT</th>
                        <th>Tổng</th>
                        <th>ID_User</th>
                        <th>Xóa</th>
                    </tr>
                <?php
                    $stt = 0;
                    $lsgd = "select * from cart";
                    $query_lsgd = mysqli_query($conn,$lsgd);
                    while($rows_lsgd = mysqli_fetch_array($query_lsgd)){
                ?>
                    <tr class="hangls">
                        <td class="thongtinnguoidung__stt"><?php echo $stt+1 ?></td>
                        <td class="thongtinnguoidung__id"><?php echo $rows_lsgd['id']?></td>
                        <td class="thongtinnguoidung__ten"><?php echo $rows_lsgd['fullname']?></td>
                        <td class="thongtinnguoidung__dc"><?php echo $rows_lsgd['address']?></td>
                        <td class="thongtinnguoidung__full"><?php echo $rows_lsgd['tel']?></td>
                        <td class="thongtinnguoidung__full">
                            <?php
                                $money = $rows_lsgd['total'];
                                $formattedMoney = number_format($money);
                            ?>
                            <p><?php echo $formattedMoney . "đ" ?></p>    
                        </td>
                        <td class="thongtinnguoidung__user_id"><?php echo $rows_lsgd['user_id']?></td>
                        <form action="" method="post">  
                            <td class="thongtinnguoidung__xoa"><input class="btn_del" type="submit" name="lsgd_xoa" value="Xóa"></td>
                            <input type="text" name="lsgd_idxoa" value="<?=$rows_lsgd['id']?> " hidden>
                        </form>
                    </tr>              
                <?php
                    $stt++;
                    }     
                    if(isset($_POST['lsgd_xoa'])){
                        $ttnd_dells = $_POST['lsgd_idxoa'];
                        $lsgd_xoa = "delete from cart where id = $ttnd_dells";
                        $query_lsgd_xoa = mysqli_query($conn, $lsgd_xoa);
                        if($query_lsgd_xoa){
                            header("refresh: 0");
                        }
                    }
                ?>
            </table>
        </div>
        <div id="thongke">
            <?php
                include("Thongke.php");
            ?>
            
        </div>
        
    </div>
    <?php
        ob_end_flush();
    ?> 
            
</body>

</html>