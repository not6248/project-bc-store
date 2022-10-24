<?php
$sql = 'SELECT * FROM user_tb';
$query = mysqli_query($conn, $sql);
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">จัดการข้อมูลผู้ใช้</h1>
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
                    <a href="?page=<?=$_GET['page']?>&function=add" class="btn btn-success mb-3">เพิ่มข้อมูลผู้ใช้</a>
                    </div>
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">ตารางข้อมูลผู้ใช้</h3>
                    </div>
                    <div class="card-body">
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">ชื่อ - นามสกุล</th>
                                    <th scope="col">อีเมล</th>
                                    <th scope="col">ระดับสิทธิ์</th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">เมนู</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($query as $data) : ?>
                                    <tr>
                                        <td><?= $data['user_id'] ?></td>
                                        <td><?= $data['username'] ?></td>
                                        <td><?= $data['firstname'] . ' ' . $data['lastname'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= ($data['user_type'] == 1
                                                ? '<span class="text-primary">[ADMIN]</span>'
                                                : '<span class="text-success">USER</span>') ?></td>
                                        <td><?= ($data['status'] == 0
                                                ? '<span class="text-success">เปิดใช้งาน</span>'
                                                : '<span class="font-weight-bold text-danger">*ปิดใช้งาน*</span>') ?></td>
                                        <td>
                                            <a href="?page=<?=$_GET['page']?>&function=update&user_id=<?=$data['user_id']?>" class="btn btn-sm btn-warning">แก้ไข</a>
                                            <a href="?page=<?=$_GET['page']?>&function=delete&user_id=<?=$data['user_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('คุณต้องการลบข้อมูลของ <?=$data['username']?> หรือไม่')" >ลบ</a>
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
