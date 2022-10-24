<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">แก้ไขข้อมูลผู้ใช้</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=<?= $_GET['page'] ?>">จัดการข้อมูลผู้ใช้</a></li>
                    <li class="breadcrumb-item active">แก้ไขข้อมูลผู้ใช้</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-lg-6">
                <div class="col">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">รายละเอียด ORDER</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?php
                        if (isset($_POST) && !empty($_POST)) {
                            $order_id = $_POST['order_id'];
                            $sql = "UPDATE order_tb o,key_tb k SET o.order_status = '1',k.key_status = '2' 
                                    WHERE k.order_id = '$order_id' AND o.order_id = '$order_id';";
                            $query = mysqli_query($conn, $sql);
                            echo '<script>
                                alert("ยืนยัน order เรียบร้อย");
                                window.location.href = "?page=order";
                                </script>';
                        } else {
                        }
                        ?>


                        <?php
                        if (isset($_GET['order_id']) && !empty($_GET['order_id'])) {
                            $sql = "SELECT * FROM order_tb LEFT JOIN paymentdetail_tb USING (order_id) WHERE order_id=" . $_GET['order_id'];
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $order_id2 = $row['order_id'];
                        }
                        ?>
                        <form action="" method="POST" onsubmit="return confirm('ยืนยันออเด้อ #<?= $row['order_id'] ?> หรือไม่')">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>ORDER ID</label>
                                    <input type="text" class="form-control" value="<?= $row['order_id'] ?>" disabled>
                                    <input name="order_id" type="hidden" value="<?= $row['order_id'] ?>" readonly>
                                </div>
                                <div class="form-group mb-4">
                                    <label>รหัสตะกล้า</label>
                                    <input name="cart_id" type="text" class="form-control" value="<?= $row['cart_id'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>สถานะของ ORDER</label>
                                    <input name="order_status" type="text" class="form-control" value="<?= $row['order_status'] == 0 ? 'รอการยืนยัน' : 'ยืนยันแล้ว' ?>" disabled>

                                </div>
                                <!-- <div class="form-group">
                                <label></label>
                                <input name="" type="email" class="form-control" placeholder="ไม่มี" value="" disabled>
                            </div> -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <?php if ($row['order_status'] == 0 && !empty($row['pay_id']) ) : ?>
                                    <button type="submit" class="btn btn-success">ยืนยันออเดอร์</button>
                                <?php endif;  ?>
                            </div>
                        </form>
                    </div> <!-- /.card -->
                </div>
                <div class="col">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">หลักฐานการชำระเงิน</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>รูปสลิป  [Pay_ID#<?= $row['pay_id'] ?>]</label><br>
                                    <?php if(!empty($row['pay_slip'])) : ?>
                                    <img width="50%" height="70%" src="upload/pay_slip/<?= $row['pay_slip'] ?>" alt="" srcset="">
                                    <?php else : ?>
                                    <span><h4>ไม่มีการอัพโหลดสลิป</h4></span>
                                    <?php endif; ?>
                                    
                                </div>
                                <div class="form-group mb-4">
                                    <label>โอนเข้าธนาคาร</label>
                                    <input name="cart_id" type="text" class="form-control" value="<?= $row['bankname'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>วันที่ทำการอัพโหลดสลิป</label>
                                    <input name="cart_id" type="text" class="form-control" value="<?= $row['pat_datetime'] ?>" disabled>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div> <!-- /.card -->
                </div>
            </div>

            <!-- ------------------------------------------------------------------------------------------------------------------------------------------------ -->
            <?php //$order_details = $row['order_details'];
            $order_details = unserialize($row['order_details']);
            $qty = 0;
            ?>

            <div class="col-lg-6">
                <div class="col">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">ลายละเอียดสินค้า</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form action="" method="POST">
                            <div class="card-body">
                                <table class="table table-bordered ">
                                    <tr>
                                        <th>ชื่อสินค้า</th>
                                        <th class="text-center">ราคาต่อชิ้น</th>
                                        <th class="text-center">จำนวน</th>
                                    </tr>
                                    <?php foreach ($order_details as $data) : ?>
                                        <tr>
                                            <td><?= $data['product_name']; ?></td>
                                            <td class="text-center"><?= number_format($data['product_price']); ?></td>
                                            <td class="text-center"><?= $data['product_cart_qty']; ?></td>
                                            <?php $qty += $data['product_cart_qty']; ?>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr>
                                        <td></td>
                                        <td class="text-center"> รวม</td>
                                        <td class="text-center"> <?= $qty; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">ราคารวมของสินค้าทั้งหมด</td>
                                        <td class="text-center"><?= number_format($row['order_price']) ?> บาท</td>
                                    </tr>
                                </table>
                                <!-- <div class="form-group">
                                <label></label>
                                <input name="" type="email" class="form-control" placeholder="ไม่มี" value="" disabled>
                            </div> -->
                            </div>

                        </form>
                    </div> <!-- /.card -->
                </div>



                <?php
                $sql = "SELECT p.product_name,k.key_serial FROM key_tb k JOIN product_tb p USING(product_id) WHERE order_id = '$order_id2' ORDER BY product_id ASC;";
                $query =  mysqli_query($conn,$sql);
                ?>
                <div class="col">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">KEY ที่จำหน่าย</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form action="" method="POST">
                            <div class="card-body">
                                <table class="table table-bordered ">
                                    <tr>
                                        <th>ชื่อสินค้า</th>
                                        <th class="text-center">KEY</th>
                                    </tr>
                                    <?php while($rowkey = mysqli_fetch_assoc($query)): ?>
                                        <tr>
                                            <td><?= $rowkey['product_name']; ?></td>
                                            <td class="text-center"><?= $rowkey['key_serial']; ?></td>
                                        </tr>
                                    <?php endwhile ?>
                                </table>
                                <!-- <div class="form-group">
                                <label></label>
                                <input name="" type="email" class="form-control" placeholder="ไม่มี" value="" disabled>
                            </div> -->
                            </div>

                        </form>
                    </div> <!-- /.card -->
                </div>
            </div>
        </div>
</section>