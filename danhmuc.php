<?php
    include("connect.php");
    session_start();
    if(isset($_GET['hangsx'])){
        $search__bar = $_GET['hangsx'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Mục</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include("header.php");
    ?>
    <div class="all_table">
        <?php
            if (isset ($search__bar)){
                $sql = "select * from san_pham where hangsx = '$search__bar'";
                $query = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($query)){
            ?>
            <a class="bangsp-head" href="sanpham.php?masp=<?php echo $row['masp']?>">
                <table class="bangsp">
                    <tr>
                        <td>
                            <img class ="imgsanpham" src="IMG/sanpham/<?php echo $row['hinhanh'] ?>" alt="loi anh">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a class="bangsp-head bangsp__tensp" href=""><?php echo $row['tensp'] ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?php echo $row['gia'] . "đ" ?></p>
                        </td>
                    </tr>
                </table>
            </a>
            <?php
                }
            }
        ?>
    </div>
    
</body>
</html>