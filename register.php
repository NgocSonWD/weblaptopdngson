<?php
    include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href=".\fontawesome-free-6.4.0-web\fontawesome-free-6.4.0-web\css\all.min.css">
</head>
<body>
    <form action="" method="post" name ="user">
        <div class="form">
            <div class="overlay"></div>
            <div class="form--register">
                <div class="btn-return">
                    <a href="login.php">
                        <img class="icon_back" src="IMG\background\back-removebg.png" alt="">
                    </a>
                </div>
                <div class="register__name">
                    <span>ĐĂNG KÍ</span>
                </div>
                <div class="register">
                    <div class="register-user">
                        <img class="icon_user" src="IMG\background\icon_user-removebg.png" alt="">
                        <input class="register-input" type="text" placeholder="Nhập username" name="username" value="">
                    </div>
                </div>
                <div class="register">
                    <div class="register-pass">
                        <img class="icon_user" src="IMG\background\icon_pass-removebg.png" alt="">
                        <input class="register-input" type="password" placeholder="Nhập password" name="password" value="">
                    </div>
                </div>
                <div class="register">
                    <div class="register-repass">
                        <img class="icon_user" src="IMG\background\icon_pass-removebg.png" alt="">
                        <input class="register-input" type="password" placeholder="Nhập lại password" name="repassword" value="">
                    </div>
                </div>
                <div class="register">
                    <div class="register-full">
                        <img class="icon_user" src="IMG\background\fullname-removebg.png" alt="">
                        <input class="register-input" type="text" placeholder="Nhập họ tên" name="fullname" value="">
                    </div>
                </div>
                <div class="register">
                    <div class="register-mail">
                        <img class="icon_user" src="IMG\background\mail-removebg.png" alt="">
                        <input class="register-input" type="text" placeholder="Nhập mail" name="mail" value="">
                    </div>
                </div>
                <div class="btn-register">
                    <input class= "tki" type="submit" name="dangki" value="Đăng kí">
                </div>
            </div>
        </div>
    </form>
    <?php
        if($_POST){
            $username = $_POST["username"];
            $password = md5($_POST["password"]);
            $repassword = md5($_POST["repassword"]);
            $fullname = $_POST["fullname"];
            $mail = $_POST["mail"];
            if($username && $password && $repassword && $fullname && $mail){
                $sql = "select * from user where username = '".$username."'";
                $query = mysqli_query($conn, $sql);
                $num_rows = mysqli_num_rows($query);
                if($num_rows == 1){
                    ?>
                        <p class="tb">User đã tồn tại!</p>
                    <?php
                }
                else{
                    if($password  == $repassword){
                        $sql_add = "insert into user (username, password, fullname, mail) values('".$username."','".$password."','".$fullname."','".$mail."')";
                        $query = mysqli_query($conn, $sql_add);
                        if($query){
                            header("Location:index.php");
                        } 
                    }
                    else{
                        ?>
                            <p class="tb">Sai mật khẩu.</p>
                        <?php   
                    }             
                }  
            }else{
                ?>
                    <p class="tb">Vui lòng nhập đầy đủ thông tin!</p>
                <?php
            }
        }
    ?>
</body>
</html>