<!-- Content Header (Page header) -->
<?php
$sql = 'SELECT o.*,p.pay_id FROM order_tb o LEFT JOIN paymentdetail_tb p USING(order_id);';
$query = mysqli_query($conn, $sql);
?>



<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">รายการสั่งซื้อ</h1>
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
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">ตารางข้อมูล Order</h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table" >
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="18%">หมายเลขตะกล้า</th>
                                    <th >ราคารวม</th>
                                    <th >สถานะ</th>
                                    <th class="text-right" width="32%" scope="col">เมนู</th>
                                </tr>
                            </thead>
                            <!-- 
                                0 -1 รอการชำระเงิน และ ไม่มีการอัพโหลดภาพสลีป  = รอการชำระเงิน order_status == 0 && empty pay_id
                                0    รอการชำระเงิน และ มีการอัพโหลดภาพสลีป  = รอการตรวจสอบการชำระเงิน  order_status == 0 !empty pay_id
                                1    ยืนยันแล้ว          order_status == 1
                                2 -1 การชำระเงินไม่สมบูรณ์ order_status == 2 && !empty pay_id
                                2    ยกเลิก Order       order_status == 2
                                
                            -->
                            <tbody>
                                <?php foreach ($query as $data) : ?>
                                    <?php if($data['order_status'] != 2) :?>
                                    <tr>
                                        <td><?= $data['order_id'] ?></td>
                                        <td><?= $data['cart_id'] ?></td>
                                        <td><?= $data['order_price']?></td>
                                        <td><?php if($data['order_status']== 0 && empty($data['pay_id'])) {
                                            echo 'รอการชำระเงิน <img src="upload/timer.gif" width="18px" height="18px" alt="noimg">'; 
                                        }elseif($data['order_status'] == 0){
                                            echo '<span>รอการตรวจสอบการชำระเงิน </span> <i class="fa-solid fa-circle-notch fa-spin"></i>';
                                        }elseif($data['order_status'] == 1){
                                            echo 'ยืนยันแล้ว <img src="upload/star.gif" width="20px" height="20px" alt="noimg">';
                                        }else{
                                            echo '<span class="font-weight-bold text-danger">=ยกเลิก Order แล้ว=</span>';
                                        }
                                        ?>
                                        </td>
                                        <td class="text-right">
                                        <?php if($data['order_status']== 0 && empty($data['pay_id'])) :?>
                                            <a href="?page=<?= $_GET['page'] ?>&function=cancel_order&order_id=<?= $data['order_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('คุณต้องการยกเลิก ORDER #<?= $data['order_id'] ?> หรือไม่')">ยกเลิกออเดอร์</a>
                                            <?php elseif($data['order_status']== 0) : ?>
                                            <a href="?page=<?= $_GET['page'] ?>&function=cancel_order&order_id=<?= $data['order_id']?>" class="btn btn-sm btn-warning" onclick="return confirm('คุณต้องการยกเลิก ORDER #<?= $data['order_id'] ?> หรือไม่')"><span class="font-weight-bold text-dark">การชำระเงินไม่สมบูรณ์ <i class="fa-solid fa-triangle-exclamation"></i></span></a>
                                            <?php endif; ?>
                                            <a href="?page=<?= $_GET['page'] ?>&function=detail&order_id=<?= $data['order_id']?>" class="btn btn-sm btn-info">ดูรายละเอียด</a>

                                        </td>
                                    </tr>
                                        <?php endif; ?>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.card -->
            </div>
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Order ที่ยกเลิก</h3>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th >หมายเลขตะกล้า</th>
                                    <th >ราคารวม</th>
                                    <th >สถานะ</th>
                                    <th class="text-right" width="20%" scope="col">เมนู</th>
                                </tr>
                            </thead>
                            <!-- 
                                0 และ ไม่มีการอัพโหลดภาพสลีป  = รอการชำระเงิน order_status == 0 && empty pay_id
                                0 และ มีการอัพโหลดภาพสลีป  = รอการตรวจสอบการชำระเงิน  order_status == 0
                                1 ยืนยันแล้ว
                                2 ยกเลิก Order
                            -->
                            <tbody>
                                <?php foreach ($query as $data) : ?>
                                    <?php if($data['order_status'] == 2) :?>
                                    <tr>
                                        <td><?= $data['order_id'] ?></td>
                                        <td><?= $data['cart_id'] ?></td>
                                        <td><?= $data['order_price']?></td>
                                        <td><?php if($data['order_status'] == 2 && !empty($data['pay_id'])) {
                                            echo '<span class="font-weight-bold bg-warning text-dark">การชำระเงินไม่สมบูรณ์ <i class="fa-solid fa-triangle-exclamation"></i></span>';
                                        }else{
                                            echo '<span class="font-weight-bold bg-gradient-warning text-danger">=ยกเลิก Order แล้ว=</span>';
                                        }
                                        ?>
                                        </td>
                                        <td class="text-right">
                                        <?php if($data['order_status'] == 0) :?>
                                            <a href="?page=<?= $_GET['page'] ?>&function=cancel_order&order_id=<?= $data['order_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('คุณต้องการยกเลิก ORDER #<?= $data['order_id'] ?> หรือไม่')">ยกเลิกออเดอร์</a>
                                            <?php endif; ?>
                                            <a href="?page=<?= $_GET['page'] ?>&function=detail&order_id=<?= $data['order_id']?>" class="btn btn-sm btn-info">ดูรายละเอียด</a>

                                        </td>
                                    </tr>
                                    <?php endif; ?>
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
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example thead');
 
    var table = $('#example').DataTable({
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
            },
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});
</script>
<script>
$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example2 thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example2 thead');
 
    var table = $('#example2').DataTable({
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
            },
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});
</script>
