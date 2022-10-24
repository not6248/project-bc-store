<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN PANEL</title>
  <?php
  session_start();
  if (!isset($_SESSION['admin_login'])) {
    header('location: ../');
  }
  ?>
  <!--===============================================================================================-->
  <link type="image/png" sizes="16x16" rel="icon" href="Upload/icon/icon-16.png">
  <link type="image/png" sizes="32x32" rel="icon" href="Upload/icon/icon-32.png">
  <!--===============================================================================================-->
  <link rel="stylesheet" href="fontawesome/css/all.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" href="css/adminlte.min.css">
  <!--===============================================================================================-->
  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <!--===============================================================================================-->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!--===============================================================================================-->
  <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
  <!--===============================================================================================-->
  <!-- DataTables css -->
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css">
  <!--===============================================================================================-->
  <!-- jQuery -->
  <script src="js/jquery.min.js"></script>
  <!--===============================================================================================-->
  <script src="js/sweetalert2.all.min.js"></script>
  <!--===============================================================================================-->
  <script src="js/chart.min.js"></script>
  <!--===============================================================================================-->
  <script src="js/chartjs-plugin-datalabels"></script>
  <!--===============================================================================================-->
  <script src="../js/fa.js" crossorigin="anonymous"></script>
  <!--===============================================================================================-->
  <style>
    body {
      font-family: 'Itim', cursive;
    }
  </style>
  <!--===============================================================================================-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <?php $sql = "SELECT protype_name,COUNT(*) AS sum FROM protype_tb JOIN product_tb USING(protype_id) GROUP BY protype_name ORDER BY protype_id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $rowdata[] = array($row['protype_name'], $row['sum'] + 0);
  }
  $jsondata = json_encode($rowdata, JSON_UNESCAPED_UNICODE);
  ?>
  <html>

  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages': ['corechart']
      });

      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'ประเภท');
        data.addColumn('number', 'จำนวน');
        data.addRows(<?php echo $jsondata; ?>);

        var options = {
          'title': 'จำสวนสินค้าแต่ละประเภท',
          'width': 650,
          'height': 500,
          'fontSize': 16,
          'is3D': true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  </html>

</head>