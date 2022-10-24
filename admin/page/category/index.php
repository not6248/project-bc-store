<?php
$sql = 'SELECT * FROM protype_tb';
$query = mysqli_query($conn, $sql);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">จัดการประเภทสินค้า</h1>
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
                    <a href="?page=<?=$_GET['page']?>&function=add" class="btn btn-success mb-3">เพิ่มประเภทสินค้า</a>
                    </div>
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">ตารางประเภทสินค้า</h3>
                    </div>
                    <div class="card-body">
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ประเภทสินค้า</th>
                                    <th scope="col">เมนู</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($query as $data) : ?>
                                    <tr>
                                        <td><?= $data['protype_id'] ?></td>
                                        <td><?= $data['protype_name'] ?></td>
                                        <td>
                                        <a href="?page=<?=$_GET['page']?>&function=update&protype_id=<?=$data['protype_id']?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                        <a href="?page=<?=$_GET['page']?>&function=delete&protype_id=<?=$data['protype_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('คุณต้องการลบประเภทสินค้า <?=$data['protype_name']?>')" >ลบ</a>
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

