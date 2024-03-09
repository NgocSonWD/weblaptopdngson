<?php
    include("connect.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="phandau">
        <div class="head">
            <div class="logo">
                <a href="index.php" > <img class="hinhlogo" src="IMG\logo.png" alt=""> </a>
            </div>
            <div class="danhmuc">
                <ul>
                    <li>
                        <a class="muc" href="">Danh Mục</a>
                        <ul class="hienduoi">
                            <li><a class="link" href="danhmuc.php?hangsx=ACER">ACER</a></li>
                            <li><a class="link" href="danhmuc.php?hangsx=ASUS">ASUS</a></li>
                            <li><a class="link" href="danhmuc.php?hangsx=DELL">DELL</a></li>
                            <li><a class="link" href="danhmuc.php?hangsx=HP">HP</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="search">
                <form action="search.php" method="post" name="search--post">

                    <button class="button-search" type="submit" name = "search-btn">
                        <img class="kinhlup" src="IMG\background\kinhlup-removebg.png" alt="">    
                    </button>
                    
                    <input type="text" name="search__bar" class="tim" placeholder="Hãy nhập vào đây"> 

                </form>               
            </div>
            <div class="shopping-cart">
                <a href="addtocart.php"><img class="anh_gh" src="IMG\background\giohang-removebg.png" alt=""></a>
            </div>
            <div class="taikhoan">
                <?php 
                    if(isset($_SESSION['login']['username'])){
                        ?>
                            <div class="taikhoan__list">
                                <ul>
                                    <p>Tài khoản</p>
                                    <li class="taikhoan__list--after">
                                        <?php 
                                            $user = $_SESSION['login']['username'];
                                        ?>
                                        <a id="taikhoan__list--acc" class="taikhoan__list taikhoan__list--acc" href="user.php?username=<?=$user?>"><?php echo $_SESSION['login']['username']?></a>
                                        <hr>
                                        <a class="taikhoan__list" href="yeuthich.php?username=<?=$user?>">Yêu thích</a>
                                        <hr>
                                        <a class="taikhoan__list taikhoan__list--logout" href="logout.php">Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                        <?php
                    }
                    else{
                        ?>
                        <a class="taikhoan__list" href="login.php">Đăng nhập</a>
                        <span class="taikhoan__list--separate"></span>
                        <a class="taikhoan__list" href="register.php">Đăng kí</a>
                        <?php  
                    }      
                ?>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
</body>
</html>