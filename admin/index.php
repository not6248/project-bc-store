<?php
require '../connection/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include './includes/head.php'; ?>
<!-- /head -->

<body class="sidebar-mini layout-fixed" style="height: auto;">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include './includes/navbar.php'; ?>
    <!-- /.navbar -->

    <!-- คอนเทนเนอร์ แถบด้านข้างหลัก -->
    <?php include './includes/sidebar.php' ?>
    <!-- /.sidebar -->
    <!-- Content Wrapper. เนื้อหาเพจ -->
    <div class="content-wrapper">
      <?php
      if (!isset($_GET['page']) && empty($_GET['page'])) {
        include './page/dashboard/index.php';
      } elseif (isset($_GET['page']) && $_GET['page'] == 'product') {
        if (isset($_GET['function']) && $_GET['function'] == 'add') {
          include 'page/product/insert.php';
        } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
          include 'page/product/edit.php';
        } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
          include 'page/product/delete.php';
        } else {
          include './page/product/index.php';
        }
      } elseif (isset($_GET['page']) && $_GET['page'] == 'category') {
        if (isset($_GET['function']) && $_GET['function'] == 'add') {
          include 'page/category/insert.php';
        } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
          include 'page/category/edit.php';
        } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
          include 'page/category/delete.php';
        } else {
          include './page/category/index.php';
        }
      } elseif (isset($_GET['page']) && $_GET['page'] == 'user') {
        if (isset($_GET['function']) && $_GET['function'] == 'add') {
          include 'page/user/insert.php';
        } elseif (isset($_GET['function']) && $_GET['function'] == 'update') {
          include 'page/user/edit.php';
        } elseif (isset($_GET['function']) && $_GET['function'] == 'delete') {
          include 'page/user/delete.php';
        } else {
          include './page/user/index.php';
        }
      } elseif (isset($_GET['page']) && $_GET['page'] == 'order') {
        if (isset($_GET['function']) && $_GET['function'] == 'detail') {
          include 'page/order/order_detail.php';
        } elseif (isset($_GET['function']) && $_GET['function'] == 'cancel_order') {
          include 'page/order/cancel_order.php';
        } else {
          include './page/order/index.php';
        }
      }

      ?>
      <!-- เนื้อหาเพจ -->
    </div>
  </div> <!-- ./wrapper -->
  <!-- Main Footer -->
  <?php include './includes/footer.php' ?>
  <!-- /Footer -->

  <!-- REQUIRED SCRIPTS -->
  <?php include './includes/scripts.php' ?>
  <!-- /SCRIPTS -->
</body>

</html>