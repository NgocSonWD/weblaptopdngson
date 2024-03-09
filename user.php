<?php
    ob_start();

    include("connect.php");
    session_start();
    $user = $_GET['username'];
    
    
    $sql = "select * from user where username = '".$user."'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user.css">
    <title>Người dùng</title>
</head>
<body>
    <div>
        <?php
            include("header.php");
        ?>
    </div>
    <div class="userr">
        <form action="" method="post" enctype="multipart/form-data">

            <h1>Người dùng:</h1>
            <div class="userr__avt">
                <img src="IMG/avtuser/<?php echo $row['avatar']?>" alt="">
                <input type="file" name="doiavt" value="Đổi avatar">
            </div>
                
            <div class="userr__info">
                <p>Tên người dùng: </p>
                <input type="text" name="username" placeholder="Nhập username" value="<?php echo $user?>" readonly>
                <p>Tên đầy đủ: </p>
                <input type="text" name="fullname" placeholder="Nhập username" value="<?php echo $row['fullname']?>">
                <p>Email: </p>
                <input type="text" name="email" placeholder="Nhập email" value="<?php echo $row['mail']?>">

            </div>

            <div class="userr__btnluu">
                <input type="submit" value="Lưu" name="btnluu">
            </div>


            

        </form>

    <div class="userr__btnchange">
            <!-- <input type="submit" name= "changePass" value="Thay đổi mật khẩu"> -->
            <button class="modal_open"><p>Thay đổi mật khẩu</p></button>
            
    </div>

    <div class="modal hide">
        <div class="modal__inner">

            <div class="modal__header">
                <p class="modal_btn_tat">X</p>
            </div>

            <form action="" method="post">

                <div class="modal__body">
                    
                    <h2>Thay đổi mật khẩu</h2>
                    <span>Nhập mật khẩu cũ</span>
                    <input type="password" value="" name="passcu">
                    <span>Nhập mật khẩu mới</span>
                    <input type="password" value="" name="passmoi">
                    <span>Nhập lại mật khẩu mới</span>
                    <input type="password" value="" name="repassmoi">
                </div>
                <input type="text" name="password" value="<?php echo $row['password']?>" hidden>
                <input type="submit" class="changePass" value="Đổi" name= "changePass">
                

            </form>

            <?php
                if(isset($_POST['changePass'])){
                    $passworddd = $_POST["password"];
                    
                    $passcu = md5($_POST['passcu']);
                    $passmoi = md5($_POST['passmoi']);
                    $repassmoi = md5($_POST['repassmoi']);
        
                    if($passcu && $passmoi && $repassmoi){
                        if($passcu == $passworddd){
                            if($passmoi == $repassmoi){
                                $sql_upPass = "update user set password = '".$passmoi."' where username = '".$user."'";
                                $query_upPass = mysqli_query($conn,$sql_upPass);
                                echo "<script>
                                        alert('Thay đổi thành công!');
                                    </script>";
                            }
                            else{
                                echo "<script>
                                        alert('Mật khẩu không trùng khớp!');
                                    </script>";
                            }
                        }
                        else{
                            echo "<script>
                                    alert('Sai mật khẩu cũ!');
                                </script>";
                        }
                    }
                    else{
                        echo "<script>
                                alert('Vui lòng nhập đầy đủ thông tin!');
                            </script>";
                    }   
                }
            ?>
            
        </div>
    </div>

    <?php

        
        
        if(isset($_POST['btnluu'])){

            $fullnamee = $_POST["fullname"];
            $emaill = $_POST["email"];

            $sql_up = "update user set fullname = '".$fullnamee."', mail = '".$emaill."' where username = '".$user."'";
            $query_up = mysqli_query($conn,$sql_up);
            
            if(isset($_FILES['doiavt']) && $_FILES['doiavt']['error'] == 0){

                $doiavt = $_FILES['doiavt']['name'];

                $target_url = "IMG/avtuser/";

                if(move_uploaded_file($_FILES['doiavt']['tmp_name'], $target_url.$doiavt)){
                    $sql_up = "update user set avatar = '".$doiavt."' where username = '".$user."'";
                    $query_up = mysqli_query($conn,$sql_up);
                    header("refresh:0");
                }
                else{
                    echo "Tải lên file thất bại.";
                }

            }
            header("refresh:0");
        }
            ob_end_flush();
        ?>
    </div>

    <script src="js/main.js"></script>
</body>
</html>
