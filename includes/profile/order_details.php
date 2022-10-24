<?php
if (isset($_GET['order_id']) && !empty($_GET['order_id'])) {
    $sql = "SELECT * FROM order_tb LEFT JOIN paymentdetail_tb USING (order_id) WHERE order_id=" . $_GET['order_id'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $pay = mysqli_query($conn,"SELECT * FROM paymentdetail_tb WHERE order_id = '".$_GET['order_id']."';");
    $pay_numrow = mysqli_num_rows($pay);


    if ($row['order_status'] == 2 && empty($row['pay_id'])){
        echo "<script>
        document.location.href = 'profile.php';
        </script>";
        } 


}
?>
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">ออเดอร์</h3>
    </div>
    <div class="card-body">
        <?php
        $sql = "SELECT * FROM order_tb WHERE order_id = '" . $row['order_id'] . "' ";
        $query = mysqli_query($conn, $sql);
        ?>
        <form method="post" target="_blank" action="pdf/pdf.php">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>สถานะ</th>
                    <?php if(mysqli_fetch_assoc($query)['order_status'] == 1) : ?>
                    <th>เอกสาร</th>
                    <?php else : ?>
                        <?php if($pay_numrow == 0) : ?>
                        <th>การชำระเงิน</th>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                </tr>
                <?php foreach ($query as $data) : ?>
                    <tr>
                        <td><?= $data['order_id'] ?></td>
                        <?php if ($pay_numrow == 0 || $data['order_status'] == 1 ):?>
                        <td><?= $data['order_status'] == 0 ? 'รอการชำระเงิน <img src="admin/upload/timer.gif" width="18px" height="18px" alt="noimg">' : 'ยืนยันแล้ว <img src="admin/upload/star.gif" width="20px" height="20px" alt="noimg">' ?></td>
                        <?php else : ?> 
                        <td width="35%"> 
                                <button disabled class="btn btn-warning"  href=""> กำลังรอการตรวจสอบการชำระเงิน <i class="fa-solid fa-circle-notch fa-spin"></i></button>
                        </td>
                        <?php endif; ?> 
                        <?php if ($data['order_status'] == 1) : ?>
                            <td width="20%"><button type="submit" class="btn btn-outline-secondary">ดาวโหลดใบเสร็จ</button></td>
                        <?php else : ?>
                            <?php if ($pay_numrow == 0):?>
                            <td width="20%"><a class="btn btn-secondary" href="?page=order_details&function=pay&order_id=<?= $data['order_id'] ?>">ชำระเงิน</a></td>
                            <?php endif; ?>    
                        <?php endif; ?>
                        
                    </tr>
                <?php endforeach; ?>
                <input type="hidden" name="order_id" value="<?= $data['order_id'] ?>">
                <?php //$order_details = $row['order_details'];
                $order_details = unserialize($row['order_details']);
                $qty = 0;
                ?>
            </table>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">ลายละเอียดสินค้า</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card-body">
        <form action="" method="POST">

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
        </form>
    </div>
</div>


<?php if ($row['order_status'] == 1) : ?>
    <!--  KEY -->
    <?php
    $sql = "SELECT p.product_name,k.key_serial FROM key_tb k JOIN product_tb p USING(product_id) WHERE order_id = '" . $row['order_id'] . "' ORDER BY product_id ASC;";
    $query =  mysqli_query($conn, $sql);
    ?>
    <div class="col">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">KEY</h3>
            </div>
            <form action="" method="POST">
                <div class="card-body">
                    <table class="table table-bordered ">
                        <tr>
                            <th>ชื่อสินค้า</th>
                            <th class="text-center">KEY</th>
                        </tr>
                        <?php while ($rowkey = mysqli_fetch_assoc($query)) : ?>
                            <tr>
                                <td><?= $rowkey['product_name']; ?></td>
                                <td class="text-center"><?= $rowkey['key_serial']; ?></td>
                            </tr>
                        <?php endwhile ?>
                    </table>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>