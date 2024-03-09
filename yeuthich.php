<?php
    include("connect.php");
    session_start();
    $user = $_GET['username'];

    if(isset($user)){
        $sql_user = "select * from user where username = '".$user."'";
        $sql_query_user = mysqli_query($conn, $sql_user);
        $rows_user = mysqli_fetch_array($sql_query_user);
        $id_user = $rows_user['id_user'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeu Thich</title>
    <link rel="stylesheet" href="yeuthich.css">
</head>
<body>
    <div>
        <?php
            include("header.php");
        ?>
    </div>
    
    <h1>Danh sách yêu thích:</h1>

    <div  class="yt">
        <?php
        
        $sql_ytsp = "select * from yeuthich_sanpham where id_user ='".$id_user."'";
        $query_ytsp = mysqli_query($conn, $sql_ytsp);
        while($rows_ytsp = mysqli_fetch_array($query_ytsp)){
            $maspp = $rows_ytsp['masp'];
            $sql_sp = "select * from san_pham where masp = '".$maspp."'";
            $query_sp = mysqli_query($conn, $sql_sp);
            $rows_sp = mysqli_fetch_array($query_sp);
        ?>
            <div class="sp">
                <div class ="yt_sp">
                    <img class ="img_ytsp" src="IMG/sanpham/<?php echo $rows_sp['hinhanh'] ?>" alt="loi anh">
                    <a class="yt_tensp" href="sanpham.php?masp=<?=$rows_sp['masp']?>"><?php echo $rows_sp['tensp'] ?></a>
                </div>

            </div>

        <?php
            }
        ?>
        
    </div>

</body>
</html>