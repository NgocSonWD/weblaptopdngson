<?php
  include("connect.php");
  require 'carbon/autoload.php';
  use Carbon\Carbon;
  use Carbon\CarbonInterval;
  $now = carbon::now('Asia/Ho_Chi_Minh');
  $datenow = date($now);

  if(isset($_GET['thoigian'])){
    $thoigian = $_GET['thoigian'];
  }else{
    $thoigian = "";
    $subdays365 = carbon::now('Asia/Ho_Chi_Minh')->subdays(365);
    $dategh = date($subdays365);
  }

  if($thoigian == '7ngay'){
    $subdays7 = carbon::now('Asia/Ho_Chi_Minh')->subdays(7);
    $dategh = date($subdays7);
  }
  else if($thoigian == '28ngay'){
    $subdays30 = carbon::now('Asia/Ho_Chi_Minh')->subdays(30);
    $dategh = date($subdays30);
  }
  else if($thoigian == '90ngay'){
    $subdays90 = carbon::now('Asia/Ho_Chi_Minh')->subdays(90);
    $dategh = date($subdays90);
  }
  else if($thoigian == '365ngay'){
    $subdays365 = carbon::now('Asia/Ho_Chi_Minh')->subdays(365);
    $dategh = date($subdays365);
  }

  $hsx = [];
  $amount = [];
  $ngaymua = [];
  
  $sql_hangsx = "select sum(doanhthu) as dt, sum(soluong) as sl, ngaymua as nm from thongke
  where ngaymua BETWEEN '".$dategh."' AND '".$datenow."' group by ngaymua";
  $query_hangsx = mysqli_query($conn,$sql_hangsx);
  while($row_hangsx = mysqli_fetch_array($query_hangsx)){
      $ngaymua[] = $row_hangsx['nm'];
      $hsx[] = $row_hangsx['dt'];
      $amount[] = $row_hangsx['sl'];
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <p class="tkt">Thống kê theo: <span><?php echo $thoigian; ?></span></p>
    <select name="thoigian" class="thoigian" id="thoigian">
      <option value="ngay">--ngày--</option>
      <option value="7ngay">7 ngày</option>
      <option value="28ngay">28 ngày</option>
      <option value="90ngay">90 ngày</option>
      <option value="365ngay">365 ngày</option>
    </select>
    
    <script>
      $(document).ready(function(){
        $(".thoigian").change(function(){
          var thoigian = $(".thoigian").val();
          window.location.replace("thongke.php?thoigian="+thoigian);
          // ?thoigian="+thoigian
        })
      })
    </script>

    <div>
      <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      const hsxjs = <?php echo json_encode($hsx); ?>;
      const amountjs = <?php echo json_encode($amount); ?>;
      const ngaymuajs = <?php echo json_encode($ngaymua); ?>;
      
      const ctx = document.getElementById('myChart');
      
      var char = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ngaymuajs,
          datasets: [{
            label: 'Doanh thu',
            data: hsxjs,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
          },
          {
            label: 'Số lượng sản phẩm đã bán',
            data: amountjs,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
</body>
</html>
