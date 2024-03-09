<?php
    include('connect.php');
    $id = $_GET['id_user'];
    $sql = "select * from user where id_user = '".$id."'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="suauser.css">
    <title>Sửa User</title>
</head>
<body>
    <div class="suauser">
        <div>
            <form action="" method = "POST" name ="frmadd">
                <table>
                    <tr>
                        <th colspan="2  ">
                            <h1>SỬA USER</h1>
                        </th> 
                    </tr>
                    <tr>
                        <td>
                            Tên Đăng Nhập : 
                        </td>
                        <td>
                            <input type="text" name="username" value = "<?=$row['username']?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mật Khẩu : 
                        </td>
                        <td>
                            <input type="password" name = "password" placeholder = "Nhập vào mật khẩu">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nhập Lại Mật Khẩu : 
                        </td>
                        <td>
                            <input type="password" name = "repassword" placeholder = "Nhập Lại mật khẩu">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Họ Tên :
                        </td>
                        <td>
                            <input type="text" name = "fullname" value ="<?=$row['fullname']?>" >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input class="btn_sua" type="submit" name = "submit" value="Sửa">
                        </td>
                        <td>
                            <input type="text" name = "id" value="<?=$row['id_user']?>" hidden>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
    if($_POST){
        $id = $_POST['id_user'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $repassword = md5($_POST['repassword']);
        $fullname = $_POST['fullname'];
        if($username && $password && $repassword && $fullname){
            if($password == $repassword){
                if($password != "d41d8cd98f00b204e9800998ecf8427e"){
                    $sql_edit = "update user  set password = '".$password."',
                    fullname = '".$fullname."' where id = '".$id."'";
                }else{
                    $sql_edit = "update user set fullname = '".$fullname."' where id = '".$id."'";
                }
                $query = mysqli_query($conn, $sql_edit);
                if($query){
                    header("location:view.php");
                }
            }else{
                echo "Mật Khẩu không Trùng Nhau ";
            }
        }else{
            echo "Nhập Đầy Đủ Thông tin ";
        }
    }
    ?>
</body>
</html>