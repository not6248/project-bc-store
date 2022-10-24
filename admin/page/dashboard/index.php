<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<?php $product_sum_all_st = mysqli_fetch_assoc(mysqli_query($conn, $sql = "SELECT COUNT(*) AS SUM FROM product_tb")) ?>
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <!-- ===================================================================================================== -->
      <section class="col-lg-4 connectedSortable">
        <!-- ===================================================================================================== -->
        <div class="col-lg-12 col-12">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $product_sum_all_st['SUM'] ?> ชิ้น <i class="fa-solid fa-box"></i></h3>
              <p>
              <h5>จำนวนสินค้าทั้งหมด (ทุกสถานะ)</h5>
              <div class="icon">
                <i class="fas fa-shopping-cart"></i>
              </div>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          <?php $key = mysqli_query($conn, $sql = "SELECT * FROM key_tb LEFT JOIN paymentdetail_tb USING (order_id);") ?>
          <!-- small box -->
        </div>
        <div class="col-lg-12 col-12">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <?php $i = '0';
              foreach ($key as $data) {
                if ($data['key_status'] != 1) {
                  $i++;
                }
              } ?>
              <h3> <?= $i ?> ชิ้น
                <!-- <sup style="font-size: 20px">%</sup> -->
              </h3>
              <p>
              <h5>จำนวน Key ทั้งหมดของสินค้าทุกสินค้า</h5>
              <h5>(ยกเว้นขายแล้ว)</h5>
              <div class="icon">
                <i class="fa-solid fa-key"></i>
              </div>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          <!-- small box -->
        </div>
        <div class="col-lg-12 col-12">
          <!-- small box -->
          <?php $key_sum_all = mysqli_fetch_assoc(mysqli_query($conn, $sql = "SELECT COUNT(*) AS SUM FROM key_tb;")) ?>
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $key_sum_all['SUM'] ?> ชิ้น
                <!-- <sup style="font-size: 20px">%</sup> -->
              </h3>

              <p>
              <h5>จำนวน KEY ทั้งหมด (ทุกสถานะ)</h5>
              </p>
              <div class="icon">
                <i class="fa-solid fa-key"></i>
              </div>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
          <!-- small box -->
        </div>
        <!-- ===================================================================================================== -->
      </section>
      <!-- ===================================================================================================== -->
      <section class="col-lg-3 connectedSortable">
        <div class="col-lg-12 col-12">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <?php $user_sum = mysqli_fetch_assoc(mysqli_query($conn, $sql = "SELECT COUNT(*) AS SUM FROM user_tb WHERE user_type = '2';"))  ?>
              <h3><?= $user_sum['SUM'] ?> User </h3>
              <p>
              <h5>User ทั้งหมดในระบบ (ยกเว้น ADMIN)</h5>
              </p>
              <div class="icon">
                <i class="fa-solid fa-user"></i>
              </div>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <div class="col-lg-12 col-12">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">

              <?php $sell = mysqli_fetch_assoc(mysqli_query($conn, $sql = "SELECT COUNT(*) AS SUM FROM order_tb  WHERE order_status = '1';"))  ?>
              <h3><?= $sell['SUM'] ?> รายการ</h3>


              <?php $sell = mysqli_fetch_assoc(mysqli_query($conn, $sql = "SELECT SUM(order_price) AS SUM_PRICE FROM order_tb WHERE order_status = '1';"))  ?>
              <p>
              <h5>Order ที่สำเร็จแล้ว</h5>
              <h5>รวมเป็นเงินทั้งสิ้น <?= number_format($sell['SUM_PRICE']) ?>฿</h5>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
      </section>
      <!-- ===================================================================================================== -->
      <section class="col-lg-5 connectedSortable">
        <div class="col-lg-12 col-12">
        <div id="chart_div" style="width: 400; height: 500px;"></div>
        </div>
      </section>
      <!-- ===================================================================================================== -->


    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->


      <!-- <section class="col-lg-7 connectedSortable"> -->
      <!-- Custom tabs (Charts with tabs)-->
      <!-- </section> -->
      <!-- ===================================================================================================== -->
      <section class="col-lg-6 connectedSortable">

      </section>
      <!-- ===================================================================================================== -->
      <section class="col-lg-6 connectedSortable">

      </section>
      <!-- ===================================================================================================== -->
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->

      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>

