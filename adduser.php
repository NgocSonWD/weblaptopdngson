<?php
    include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href=".\fontawesome-free-6.4.0-web\fontawesome-free-6.4.0-web\css\all.min.css">
    <title>Document</title>
</head>
<body>  
    <form action="" method="post" name ="user">
        <div class="form">
            <div class="overlay"></div>
            <div class="form--register form_them">
                <div class="btn-return">
                    <a href="view.php">
                        <i class="fa-solid fa-backward"></i>
                    </a>
                </div>
                <div class="register__name">
                    <span>THÊM USER</span>
                </div>
                <div class="register">
                    <div class="register-user">
                        <i class="fa-regular fa-user"></i>
                        <input class="register-input" type="text" placeholder="Nhập username" name="username" value="">
                    </div>
                </div>
                <div class="register">
                    <div class="register-pass">
                        <i class="fa-solid fa-lock"></i>
                        <input class="register-input" type="password" placeholder="Nhập password" name="password" value="">
                    </div>
                </div>
                <div class="register">
                    <div class="register-repass">
                        <i class="fa-solid fa-lock"></i>
                        <input class="register-input" type="password" placeholder="Nhập lại password" name="repassword" value="">
                    </div>
                </div>
                <div class="register">
                    <div class="register-full">
                        <i class="fa-regular fa-circle-user"></i>
                        <input class="register-input" type="text" placeholder="Nhập họ tên" name="fullname" value="">
                    </div>
                </div>
                <div class="register">
                    <div class="register-full">
                        <i class="fa-solid fa-key"></i>
                        <input class="register-input" type="text" placeholder="Nhập quyền (1 hoặc 0)" name="quyen" value="">
                    </div>
                </div>
                <div class="btn-register">
                    <input class= "tki" type="submit" name="dangki" value="Thêm">
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
            $quyen = $_POST['quyen'];
            if($username && $password && $repassword && $fullname){
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
                        $sql_add = "insert into user (username, password, fullname, quyen) values('".$username."','".$password."','".$fullname."', '".$quyen."')";
                        $query = mysqli_query($conn, $sql_add);
                        if($query){
                            header("Location:view.php");
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