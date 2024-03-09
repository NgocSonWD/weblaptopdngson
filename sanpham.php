<?php
    ob_start();
    include("connect.php");
    session_start();
    $masp = $_GET['masp'];

    require 'carbon/autoload.php';
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $now = carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

    if(isset($_SESSION['login']['username'])){
        $username = $_SESSION['login']['username'];
        $sql_user = "select * from user where username = '".$username."'";
        $sql_query_user = mysqli_query($conn, $sql_user);
        $rows_user = mysqli_fetch_array($sql_query_user);
        $id_user = $rows_user['id_user'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <link rel="stylesheet" href="sanpham.css">
</head>
<body>
    <?php
        include("header.php");
    ?>  
    <?php
        $sql = "select * from san_pham where masp ='".$masp."'";
        $query = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_array($query);
    ?>

    <div>

        <div class="sanpham">
            <div class="sanpham__ten">
                <?php echo $rows['tensp'] ?>
                    <hr width="95%">
            </div>
            <div>

                <div class="sanpham__trai">

                    <div class="sanpham__hinhanh">
                        <img id="hak_img--js" class ="imgsp" src="IMG/sanpham/<?php echo $rows['hinhanh'] ?>" alt="loi anh">
                    </div>
                    
                    <div class="sanpham__yeuthich">

                        <form action="" method="post">

                            <?php

                            if(isset($_SESSION['login']['username'])){
                                $username = $_SESSION['login']['username'];
                                $sql_user = "select * from user where username = '".$username."'";
                                $sql_query_user = mysqli_query($conn, $sql_user);
                                $rows_user = mysqli_fetch_array($sql_query_user);
                                $id_user = $rows_user['id_user'];

                                $sql_ytsp = "select * from yeuthich_sanpham where id_user ='".$id_user."' and masp ='".$masp."'";
                                $query_ytsp = mysqli_query($conn, $sql_ytsp);
                                $rows_ytsp = mysqli_fetch_array($query_ytsp);
                            }

                            if(isset($rows_ytsp)){
                                ?>
                                    <input class="imgyt-full" name = "yt" type="submit" value="" >
                                    <?php
                                        if(isset($_POST['yt']) && isset($username)){
                                            $sql_yt_delete = "delete from yeuthich_sanpham where yeuthich_sanpham.id_user ='".$id_user."' and yeuthich_sanpham.masp = '".$masp."'";
                                            $query_yt_delete = mysqli_query($conn, $sql_yt_delete);
                                            header("Refresh:0");
                                        }
                                    ?>
                                <?php
                            }
                            else{
                                ?>
                                    <input class="imgyt-empty" type="submit" name="yt"  value="">
                                    <?php
                                        if(isset($_POST['yt'])){
                                            if(isset($id_user)){
                                                $sql_yt_insert = "INSERT INTO yeuthich_sanpham(id_user, masp) VALUES ('$id_user', '$masp')";
                                                $query_yt_insert = mysqli_query($conn, $sql_yt_insert);
                                                header("Refresh:0");
                                            }
                                            else{
                                                header("Location:login.php");
                                            }
                                            
                                        }
                                    ?>
                                <?php                               
                            }

                            ?>

                        </form>

                    </div>
                    
                </div>

                <div class="sanpham__phai">
                    <div class="sanpham__gia">
                        <?php
                            $money = $rows['gia'];
                            $formattedMoney = number_format($money);
                        ?>
                        <p><?php echo $formattedMoney . "đ" ?></p> 
                    </div>

                    <div class="sanpham__btn_buy">

                        <div class="sanpham__btn--buy_now">
                            <a class="sanpham__btn--muangay" href="buy_now.php?masp=<?php echo $masp ?>"><strong>MUA NGAY</strong></a>
                        </div>

                        <div class="sanpham__btn--add">
                            <a class="sanpham__btn--style" href="process_sp.php?masp=<?php echo $masp ?>">Thêm vào giỏ hàng</a>
                        </div>

                    </div>

                    <div class="sanpham_uudai">
                        <div class="uudai--ten">
                            <p><strong>ƯU ĐÃI THÊM</strong></p>
                        </div>
                        <div>
                            <?php
                                $sql_ttud = "select * from uu_dai_sp where masp ='".$masp."'";
                                $query_ttud = mysqli_query($conn, $sql_ttud);
                                $rows_ttud = mysqli_fetch_array($query_ttud);
                            ?>
                            <p><?php echo nl2br($rows_ttud['ttud']); ?></p>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>

        <div class="hinhanhkhac">
            <?php
                $sql_hak = "select * from hinhanhsanpham where hinhanhsanpham.masp ='".$masp."'";
                $query_hak = mysqli_query($conn, $sql_hak);
                while($rows_hak = mysqli_fetch_array($query_hak)){
            ?>
            <div class="mh">
                <p class ="mahinh">
                    <?=$rows_hak['hinhanh']?>
                </p>
            </div>
            <div class="hak">
                <img  class ="imgsp_hak" src="IMG/sanpham/<?php echo $rows_hak['hinhanh'] ?>" alt="loi anh">
            </div>
            <?php
                }
            ?>
        </div>

    </div>

    <div class="sanpham_detail">
        <div class="sanpham__tt__splq">
            <div class="sanpham__tt">
                <p class="sanpham__tt--name">ĐẶC ĐIỂM NỔI BẬT</p>
                <p><?php echo nl2br($rows['ttsp']); ?></p>
            </div>

            <div class="sanphamlienquan">
                <h2> &ensp; Sản phẩm liên quan</h2>
                <div class="splq">
                    <?php
                        $hangsx = $rows['hangsx'];
                        $splq = "select * from san_pham where hangsx ='".$hangsx."' order by rand() limit 3" ;
                        $query_splq = mysqli_query($conn, $splq);
                        while($rows_splq = mysqli_fetch_array($query_splq)){
                    ?>
                        <a class="splq__hinhanh_a" href="sanpham.php?masp=<?php echo $rows_splq['masp']?>">
                            <div class="splq__hinhanh">
                                <p class="splq__hinhanh_tensp"><?php echo $rows_splq['tensp'] ?></p>
                                <img class ="imgsplq" src="IMG/sanpham/<?php echo $rows_splq['hinhanh'] ?>" alt="loi anh">
                            </div>
                        </a> 
                    <?php
                        }
                    ?>
                </div>  
            </div>
        </div>  

        <div class="sanpham__tskt">
            <p class="sanpham__tskt-name"> <strong>THÔNG SỐ KĨ THUẬT</strong></p>
            <?php
                $sql_tskt = "select * from thong_so_ki_thuat where masp ='".$masp."'";
                $query_tskt = mysqli_query($conn, $sql_tskt);
                while($rows_tskt = mysqli_fetch_array($query_tskt)){
            ?>
            <div class="sanpham__tskt_noidung">
                <div class ="sanpham__tskt_tungnoidung">
                    <p class="ten_tskt">Loại card đồ họa</p>
                    <p class="bien_tskt"><?php echo $rows_tskt['GPU'] ?></p>
                </div>

                <div class ="sanpham__tskt_tungnoidung">
                    <p class="ten_tskt">Dung lượng RAM</p>
                    <p class="bien_tskt"><?php echo $rows_tskt['RAM'] ?></p>
                </div>

                <div class ="sanpham__tskt_tungnoidung">
                    <p class="ten_tskt">Ổ cứng</p>
                    <p class="bien_tskt"><?php echo $rows_tskt['o_cung'] ?></p>
                </div>

                <div class ="sanpham__tskt_tungnoidung">
                    <p class="ten_tskt">Kích thước màn hình</p>
                    <p class="bien_tskt"><?php echo $rows_tskt['kich_thuoc_mh'] ?></p>
                </div>

                <div class ="sanpham__tskt_tungnoidung">
                    <p class="ten_tskt">Hệ điều hành</p>
                    <p class="bien_tskt"><?php echo $rows_tskt['he_dieu_hanh'] ?></p>
                </div>

                <div class="sanpham__tskt_modal">

                    <button class="modal_open"><p>Xem cấu hình chi tiết</p></button>

                    <div class="modal hide">
                        <div class="modal__inner">

                            <div class="modal__header">
                                <p class="modal_btn_tat">X</p>
                            </div>

                            <div class="modal__body">
                                <span>Vi xử lý & đồ họa</span>
                                <div class="modal__body_tungmuc">
                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Loại card đồ họa</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['GPU'] ?></p>
                                    </div>
                        
                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Loại CPU</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['CPU'] ?></p>
                                    </div>
                                </div>
                                
                                <span>RAM & Ổ cứng</span>
                                <div class="modal__body_tungmuc">
                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Dung lượng RAM</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['RAM'] ?></p>
                                    </div>

                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Ổ cứng</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['o_cung'] ?></p>
                                    </div>
                                </div>

                                <span>Thông số khác</span>
                                <div class="modal__body_tungmuc">
                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Chất liệu</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['chat_lieu'] ?></p>
                                    </div>
                                </div>

                                <span>Màn hình</span>
                                <div class="modal__body_tungmuc">
                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Kích thước màn hình</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['kich_thuoc_mh'] ?></p>
                                    </div>

                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Độ phân giải màn hình</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['do_phan_giai_mh'] ?></p>
                                    </div>
                                </div>
                            
                                <span>Giao tiếp & kết nối</span>
                                <div class="modal__body_tungmuc">
                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Webcam</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['webcam'] ?></p>
                                    </div>

                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Hệ điều hành</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['he_dieu_hanh'] ?></p>
                                    </div>

                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Wi-Fi</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['wifi'] ?></p>
                                    </div>

                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Bluetooth</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['bluetooth'] ?></p>
                                    </div>
                                </div>

                                <span>Trọng lượng</span>
                                <div class="modal__body_tungmuc">
                                    <div class ="modal_noidung">
                                        <p class="ten_tskt">Trọng lượng</p>
                                        <p class="bien_tskt"><?php echo $rows_tskt['trong_luong'] ?></p>
                                    </div>
                                </div>

                            </div>

                            <div class="modal__footer">
                                <button>Tắt</button>
                            </div>
                        </div>
                    </div>  
                </div>
            <?php
                }
            ?>
        </div> 
    </div>
    
    <div class="comment">
        <h2>Hỏi và đáp</h2>
        <div class="comment_form">

            <form action="" method="post">
                <textarea name="noidungbinhluan" id="" cols="100" rows="10"></textarea>
                <input type="submit" name="thembinhluan" value="GỬI">
            </form>

            <?php
                if(isset($_POST['thembinhluan'])){

                    if(isset($_SESSION['login']['username'])){
                            
                        //$username = $_SESSION['login']['username'];
                        $id_user;

                        $noidungbinhluan = $_POST['noidungbinhluan'];
                        $masp = $_GET['masp'];

                        if($noidungbinhluan && $masp && $username){

                            $noidungbinhluan_words = explode(' ', $noidungbinhluan);

                            foreach ($noidungbinhluan_words as $word) {
                                $sql_ktr = "SELECT tu_cam FROM tucam WHERE tu_cam LIKE N'%".$word."%'";
                                $query_ktr = mysqli_query($conn, $sql_ktr);
                                if(mysqli_num_rows($query_ktr) > 0){
                                    ?>
                                    <script>
                                        alert('Nội dung bình luận không hợp lệ!');
                                    </script>
                                    <?php
                                    exit();
                                }
                            }
                            
                            $sql_thembinhluan = "INSERT INTO binhluan (masp, id_user, noi_dung, binhluan_date) 
                            VALUES ('$masp', '$id_user', '$noidungbinhluan', '$now')";
                            mysqli_query($conn, $sql_thembinhluan);
                            echo "<script type='text/javascript'>window.top.location='".$_SERVER['REQUEST_URI']."';</script>";
                            exit();                            

                        }
                        
                    }
                    else{
                        header("Location:login.php");
                    }

                }
            ?>
            
        </div>
    </div>
                    
    <div class="comment_show">
        <?php
            $sql_comment_show = "select * from binhluan l, user u where l.id_user = u.id_user and l.masp = '".$masp."' order by id_bl desc;";
            $query_comment_show = mysqli_query($conn, $sql_comment_show);
            while($rows_comment_show = mysqli_fetch_array($query_comment_show)){
        ?>
        <div class="comment_show--nd">
            <div class="comment_title">

                <div class="comment-username">
                    <span>Từ:</span>
                    <?php echo $rows_comment_show['fullname'] ?>
                    
                    <div class="comment-avt">
                        <img src="IMG\avtuser\<?php echo $rows_comment_show['avatar'] ?>" alt="">
                    </div>
                </div>

                <div class="comment_show--nd--nd">
                    <?php echo $rows_comment_show['noi_dung'] ?>
                </div>
                
                <div class="comment-date">
                    <?php echo $rows_comment_show['binhluan_date'] ?>
                </div>
                
            </div>
            <hr width: 100%;>

        </div>
        <?php
            }
        ?>
    </div>



    <?php
        ob_end_flush();
    ?>

    <script src="js/main.js"></script>

</body>
</html>