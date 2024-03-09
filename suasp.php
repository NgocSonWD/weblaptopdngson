<?php
    include('connect.php');
    $masp = $_GET['masp'];
    $sql = "select * from san_pham where masp = '".$masp."'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addsp.css">
    <title>Sửa sản phẩm</title>
</head>
<body>
    <div class="addsp">
        <div>
            <form action="" method = "POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th colspan="2">
                            <h1>SỬA SẢN PHẨM</h1>
                        </th> 
                    </tr>
                    <tr>
                        <td>
                            Tên sản phẩm : 
                        </td>
                        <td>
                            <input type="text" name="tensp" value = "<?=$row['tensp']?>" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Hãng SX : 
                        </td>
                        <td>
                            <select id="hangsx" name="hangsx" required>
                                <option value="ACER">ACER</option>
                                <option value="ASUS">ASUS</option>
                                <option value="DELL">DELL</option>
                                <option value="HP">HP</option>
                            </select> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Giá: 
                        </td>
                        <td>
                            <input type="number" name = "gia" value="<?=$row['gia']?>" placeholder = "Nhập giá">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Hình ảnh:
                        </td>
                        <td>
                            <input type="file" name="hinhanh" value="<?=$row['hinhanh']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Số lượng: </td>
                        <td>
                            <input type="number" name = "soluong" value ="<?=$row['soluong']?>" placeholder = "Nhập số lượng">
                        </td>
                    </tr>
                    <tr>
                        <td>TTSP: </td>
                        <td>
                            <input type="text" name = "ttsp" value ="<?=$row['ttsp']?>" placeholder = "Nhập thông tin sản phẩm">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input class="btn_them" type="submit" name ="submit" value="Sửa">
                        </td>
                        <td>
                            <input type="text" name = "masp" value="<?=$row['masp']?>" hidden>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
        if(isset($_POST['submit'])){
            $masp = $_POST['masp'];
            $hangsx = $_POST["hangsx"];
            $gia = $_POST["gia"];;
            $soluong = $_POST['soluong'];
            $ttsp = $_POST['ttsp'];
            if($hangsx && $gia && $soluong && $ttsp){
                $sql = "update san_pham set hangsx = '".$hangsx."', gia = '".$gia."',
                soluong = '".$soluong."', ttsp = '".$ttsp."' where masp = '".$masp."'";
                $query = mysqli_query($conn, $sql);

                if(isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0){

                    $doianh = $_FILES['hinhanh']['name'];
    
                    $target_url = "IMG/sanpham/";
    
                    if(move_uploaded_file($_FILES['hinhanh']['tmp_name'], $target_url.$doianh)){
                        $sql_up = "update san_pham set hinhanh = '".$doianh."' where masp = '".$masp."'";

                        $query_up = mysqli_query($conn,$sql_up);
                        header("refresh:0");
                    }
                    else{
                        echo "Tải lên file thất bại.";
                    }
                }

                if($query){
                    header("Location:view.php");
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