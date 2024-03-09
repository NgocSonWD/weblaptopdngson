<?php
    include("connect.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href=".\fontawesome-free-6.4.0-web\fontawesome-free-6.4.0-web\css\all.min.css">
</head>
<body>
    <form action="" method="post" name ="user">
        <div class="container">
            <div class="overlay"></div>
            <div class="container__login">
                <div class="login__name">
                    <span>ĐĂNG NHẬP</span>
                </div>
                <div class="login-up">
                    <div class="login__username">
                        <img class="icon_user" src="IMG\background\icon_user-removebg.png" alt="">
                        <input class="login-input" type="text" placeholder="Nhập username" name="username"> 
                    </div>
                </div>
                <div class="login-up">
                    <div class="login__password">
                        <img class="icon_user" src="IMG\background\icon_pass-removebg.png" alt="">
                        <input class="login-input" type="password" placeholder="Nhập password" name="password" >
                        <img id="icon-eye" class="icon_user icon-eye" src="IMG\background\icon-eye-removebg-preview.png" alt="">
                    </div>
                </div>
                
                <div class="btn-rl">
                    <div class="btn--register">
                        <span>Bạn chưa có tài khoản?</span>
                        <a href="register.php"><span>Đăng kí.</span></a>
                    </div>
                    <div class="btn--login">  
                        <input class= "nhap__login" type="submit" name="dangnhap" value="Đăng nhập">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
        if($_POST){
            $username = $_POST["username"];
            $password = md5($_POST["password"]);
            if($username && $password){
                $sql = "select * from user where username = '".$username."'";
                $query = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($query);
                $num_rows = mysqli_num_rows($query);

                $permission = "select quyen from user where username = '".$username."'";
                $query_ad = mysqli_query($conn, $permission);
                $row_ad = mysqli_fetch_array($query_ad);
                $quyen = $row_ad['quyen'];

                $_SESSION['login']['username'] = $_POST['username'];

                if($num_rows == 1){
                    if($password  == $row['password']){
                        if(($quyen == 0)){
                            header("Location:index.php?username={$row['username']}");
                        }
                        else    header("Location:view.php");
                    }
                    
                    else{
                        ?>
                            <p class="tb">Sai mật khẩu</p>
                        <?php
                    } 
                }
            }
            else{
                ?>
                    <p class="tb">Vui lòng nhập đầy đủ thông tin!</p>
                <?php
            }
        }
    ?>

    <script >
        const eye = document.querySelector('#icon-eye');
        const passwordInput = document.querySelector('input[name="password"]');

        eye.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
 </script>
</body>
</html>