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
    <title>Trang chu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include("header.php");
    ?>

    <div class="image-ads">

        <img id="img-ads" onclick="changeimage()" src="IMG\background\ads-1.png" alt="loi">

        <div class="image-ads--mini">

            <img id="img-ads-mini" src="IMG\background\ads-mini-1.png" alt="">
            <img id="img-ads-mini" src="IMG\background\ads-mini-2.png" alt="">
            <img id="img-ads-mini" src="IMG\background\ads-mini-3.png" alt="">

        </div>
        
        
    </div>

    <div class="all_table">
        <?php
            $limit = 8;

            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            $start = ($page - 1) * $limit;

                $sql = "SELECT * FROM san_pham order by masp desc LIMIT $start, $limit";
                $result = mysqli_query($conn, $sql);
                while($rows = mysqli_fetch_array($result)){
            ?>
            <a class="bangsp-head" href="sanpham.php?masp=<?php echo $rows['masp']?>">
                <table class="bangsp">
                    <tr class="td__hinhsp">
                        <td>
                            <img class ="imgsanpham" src="IMG/sanpham/<?php echo $rows['hinhanh'] ?>" alt="loi anh">
                        </td>
                    </tr>
                    <tr class="td__tensp">
                        <td>
                            <a class="bangsp__tensp" href="sanpham.php?masp=<?=$rows['masp']?>"><?php echo $rows['tensp'] ?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                $money = $rows['gia'];
                                $formattedMoney = number_format($money);
                            ?>
                            <p><?php echo $formattedMoney . "đ" ?></p>
                        </td>
                    </tr>
                </table>
            </a>
            <?php
                }         
            $countSql = "SELECT COUNT(*) as total FROM san_pham";
            $countResult = mysqli_query($conn, $countSql);
            $countRow = mysqli_fetch_assoc($countResult);
            $totalPages = ceil($countRow['total'] / $limit);
                ?>
                <div class="sotrang">
                    <?php
                        for ($i = 1; $i <= $totalPages; $i++) {
                            if ($i == $page) {
                                echo "<strong>$i</strong> ";
                            } else {
                                echo "<a href=\"?page=$i\">$i</a> ";
                            }
                        }
                    ?>
                </div>
                <?       
        ?>
    </div>

    <?php
        include("footer.php");
    ?>

    <script>
        var index = 0;
        function changeimage(){
            var imageads = ["ads-1", "ads-2", "ads-3"];
            document.getElementById('img-ads').src = "IMG/background/" + imageads[index] + ".png";
            index++;
            if(index == 3){
                index = 0;
            }   
        }
        setInterval(() => {
            changeimage();
        }, 2000);
    </script>
</body>
</html>