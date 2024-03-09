<?php
    include("connect.php");
    session_start();
    $username = $_GET['username'];
    $sql = "select * from user where username = '".$username."'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div>
            <form action="" method="post">
                <table>
                    <tr>
                        <td><a class="trove" href="user.php?username=<?=$username?>">Trở về</i></a></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h1>Đổi mật khẩu</h1>
                        </td>
                    </tr>
                    <tr class="ten">
                        <td><p class="username">Username: </p></td>
                        <td><p><?php echo $row['username']?></p></td>
                    </tr>
                    <tr class="ten">
                        <td><p class="password">Password: </p></td>
                        <td> <input type="password" name="pass" value="" ></td>
                    </tr>
                    <tr class="ten">
                        <td><p class="password">Repassword: </p></td>
                        <td><input type="password" name="repass" value="" ></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="btn_doi" type="submit" name="doi" value="Đổi"> </td>
                    </tr>
                </table>
            </form>   
        </div>
    </div>
    <?php
        if(isset($_POST['doi'])){
            $pass = md5($_POST['pass']);
            $repass = md5($_POST['repass']);
            if($pass = $repass){
                $sql_doi = "update user set password = '".$pass."' where username = '".$username."'";
                $query_doi = mysqli_query($conn, $sql_doi);
                if($query_doi){
                    header("Location:login.php");
                }
            }
            else{
                ?>
                <p>Mật khẩu không trùng nhau</p>
                <?php
            }
        }
    ?>
</body>
</html>