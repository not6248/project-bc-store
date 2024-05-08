<!-- Content Header (Page header) -->
<?php
$sql = 'SELECT product_id, protype_id, product_name, product_detail, product_price, product_img, product_status, product_create_datetime, protype_name, COUNT(key_status) AS product_qty FROM product_tb JOIN protype_tb USING (protype_id) LEFT JOIN key_tb USING(product_id) WHERE key_status != "2" OR key_status IS NULL GROUP BY product_id;';
$query = mysqli_query($conn, $sql);
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">จัดการสินค้า</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">หน้าหลัก</a></li>
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
            <div class="col-12 text-right">
                <a href="?page=<?= $_GET['page'] ?>&function=add" class="btn btn-success mb-3">เพิ่มสินค้า</a>
            </div>
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">ตารางข้อมูลสินค้า</h3>
                    </div>
                    <div class="card-body">
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">รูปภาพ</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                    <th scope="col">ประเภทสินค้า</th>
                                    <th scope="col">รายละเอียดสินค้า</th>
                                    <th scope="col">ราคา</th>
                                    <th scope="col">จำนวน</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">เมนู</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($query as $data) : ?>
                                    <tr>
                                        <td width="2%"><?= $data['product_id'] ?></td>
                                        <td><?php if (!empty($data['product_img'])) {
                                                echo '<img src="upload/product/' . $data['product_img'] . '" width="90" height="60"</td>';
                                            } else {
                                                echo '<span>ไม่มีรูป</span>';
                                            }
                                            ?>
                                        <td width="15%"><?= $data['product_name'] ?></td>
                                        <td width="10%"><?= $data['protype_name']?></td>
                                        <td width="30%"><?= mb_strimwidth($data['product_detail'], 0, 120, '...') ?></td>
                                        <td><?= $data['product_price'] ?></td>
                                        <td><?= $data['product_qty'] ?></td>
                                        <td><?= ($data['product_qty'] > '0' && $data['product_status'] == '0' )
                                                ? '<span class="text-success">มีสินค้า</span>'
                                                : ($data['product_status'] == '0' && $data['product_qty'] < '1'  ? '<span class="font-weight-bold text-danger">*สินค้าหมด*</span>' : '<span class="font-weight-bold text-secondary">=ซ่อนรายการสินค้า=</span>'); ?></td>
                                        <td>
                                            <a href="?page=<?= $_GET['page'] ?>&function=update&product_id=<?= $data['product_id'] ?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                            <a href="?page=<?= $_GET['page'] ?>&function=delete&product_id=<?= $data['product_id']?>&img=<?=$data['product_img']?> " class="btn btn-sm btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลของ <?= $data['product_name'] ?> หรือไม่')">ลบ</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "ไม่มีข้อมูลในตาราง",
                "info": "กำลังแสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "กำลังแสดง 0 ถึง 0 จาก 0 รายการ",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง _MENU_ รายการ",
                "loadingRecords": "กำลังโหลด...",
                "processing": "",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบบันทึกที่ตรงกัน",
                "paginate": {
                    "first": "อันดับแรก",
                    "last": "ล่าสุด",
                    "next": "ต่อไป",
                    "previous": "ก่อนหน้า"
                },
                "aria": {
                    "sortAscending": ": เปิดใช้งานเพื่อจัดเรียงคอลัมน์จากน้อยไปมาก",
                    "sortDescending": ": เปิดใช้งานเพื่อจัดเรียงคอลัมน์จากมากไปน้อย"
                }
            }
        });
    });
</script>