<?php
    include("connect.php");
    session_start();
    if(isset($_POST['search-btn'])){
        $search__bar = $_POST['search__bar'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href=".\fontawesome-free-6.4.0-web\fontawesome-free-6.4.0-web\css\all.min.css">  
</head>
<body>
    <?php
        include("header.php");
    ?>
    <div class="all_table">
        <?php
            if (isset ($search__bar)){
                $sql = "select * from san_pham where tensp LIKE '%$search__bar%'";
                $query = mysqli_query($conn, $sql);
                $num_rows = mysqli_num_rows($query);
                if($num_rows > 0){
                    while($row = mysqli_fetch_array($query)){
                        ?>
                        <a class="bangsp-head" href="sanpham.php?masp=<?=$row['masp']?>">
                            <table class="bangsp">
                                <tr>
                                    <td>
                                        <img class ="imgsanpham" src="IMG/sanpham/<?php echo $row['hinhanh'] ?>" alt="loi anh">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="bangsp-head bangsp__tensp" href="sanpham.php?masp=<?=$row['masp']?>"><?php echo $row['tensp'] ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                            $money = $row['gia'];
                                            $formattedMoney = number_format($money);
                                        ?>
                                        <p><?php echo $formattedMoney . "đ" ?></p>
                                    </td>
                                </tr>
                            </table>
                        </a>
                        <?php
                    }
                }
                else{
                    ?>
                        <p class="kthaysp">Không tìm thấy sản phẩm <?php echo  $search__bar ?></p>
                    <?php
                }  
            }
        ?>
    </div> 
</body>
</html>