<?php
    include('connect.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addsp.css">
    <title>Document</title>
</head>
<body>
    <div class="addsp">
        <div>
            <form action="" method = "POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th colspan="2">
                            <h1>THÊM SẢN PHẨM</h1>
                        </th> 
                    </tr>
                    <tr>
                        <td>
                            Tên sản phẩm : 
                        </td>
                        <td>
                            <input type="text" name="tensp" value = "" placeholder="Nhập tên sản phẩm">
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
                            <input type="number" name = "gia" placeholder = "Nhập giá">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Hình ảnh:
                        </td>
                        <td>
                            <input type="file" name= "hinhanh" accept="image/*">
                        </td>
                    </tr>
                    <tr>
                        <td>Số lượng: </td>
                        <td>
                            <input type="number" name = "soluong" value ="" placeholder = "Nhập số lượng">
                        </td>
                    </tr>
                    <tr>
                        <td>TTSP: </td>
                        <td>
                            <input type="text" name = "ttsp" value ="" placeholder = "Nhập thông tin sản phẩm">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input class="btn_them" type="submit" name ="submit" value="Thêm">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php
if($_POST){
    $tensp = $_POST["tensp"];
    $hangsx = $_POST["hangsx"];
    $gia = $_POST["gia"];
    $soluong = $_POST['soluong'];
    $ttsp = $_POST['ttsp'];
    if($tensp && $hangsx && $gia && $soluong && $ttsp){
        $sql = "select * from san_pham where tensp = '".$tensp."'";
        $query = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($query);
        if($num_rows == 1){
            echo "<p class='tb'>Sản phẩm đã tồn tại!</p>";
        }
        else{
            if(isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0){
                $image = $_FILES['hinhanh']['name'];
                
                $target_dir = "IMG/sanpham/";

                if(move_uploaded_file($_FILES['hinhanh']['tmp_name'], $target_dir.$image)){
                    echo "Tải lên file thành công.";
                } else{
                    echo "Tải lên file thất bại.";
                }
            } else {
                $image = NULL;
            }
            $sql_add = "insert into san_pham (tensp, hangsx, gia, hinhanh, soluong, ttsp) 
                values('$tensp','$hangsx','$gia','$image', '$soluong', '$ttsp')";
            $query = mysqli_query($conn, $sql_add);
            if($query){
                //header("Location:view.php");
            }             
        }  
    }else{
        echo "<p class='tb'>Vui lòng nhập đầy đủ thông tin!</p>";
    }
}
?>
</body>
</html>