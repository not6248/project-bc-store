<!-- Content Header (Page header) -->
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
            <div class="col-md-5">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <p class="card-title">ฟอร์มสำหรับแก้ไขข้อมูล</p>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    // ($_POST);
                    if (isset($_POST['add_pro']) && !empty($_POST['add_pro'])) {
                        $product_name = $_POST['product_name'];
                        $product_detail = mysqli_real_escape_string($conn, $_POST['product_detail']);
                        $product_price = $_POST['product_price'];
                        $product_status = $_POST['product_status'];
                        $product_id = $_GET['product_id'];
                        $protype_id = $_POST['protype_id'];
                        $oldimg = $_POST['oldimg'];

                        //check

                        if (isset($_FILES['product_img']['name']) && !empty($_FILES['product_img']['name'])) {
                            $extension = array("jpeg", "jpg", "png");
                            $target = 'upload/product/';
                            $filename = $_FILES['product_img']['name'];
                            $filetmp = $_FILES['product_img']['tmp_name'];
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                            if (in_array($ext, $extension)) {
                                if (!file_exists($target . $filename)) {
                                    if (move_uploaded_file($filetmp, $target . $filename)) {
                                        $filename = $filename;
                                        if ($filename !== $oldimg && $oldimg !== '') {
                                            unlink('upload/product/' . $oldimg);
                                            // echo 'ไฟล์ใหม่แทนที่ไฟล์เก่า ไฟล์เก่าโดนลบ';
                                        }
                                        // echo 'เพิ่มไฟล์ได้ตามปกติ';
                                    } else {
                                        echo 'เพิ่มไฟล์ไม่สำเร็จ';
                                        exit();
                                    }
                                } else {
                                    $newfilename = time() . $filename;
                                    if (move_uploaded_file($filetmp, $target . $newfilename)) {
                                        $filename = $newfilename;
                                    } else {
                                        echo 'เพิ่มไฟล์ไม่สำเร็จ';
                                        exit();
                                    }
                                }
                            } else {
                                $alert = '<script>';
                                $alert .= 'alert("ประเภทไฟล์รูปไม่ถูกต้อง กรุณาใช้เป็น jpeg jpg png");';
                                $alert .= 'window.location.href = "?page=' . $_GET['page'] . '&function=update&product_id=' . $product_id . '";';
                                $alert .= '</script>';
                                echo $alert;
                                exit();
                            }
                        } else {
                            if (empty($filename)) {
                                // echo 'filename ยังเป็นภาพเดิม';
                                $filename = $oldimg;
                            }
                        }

                        if (!empty($product_name)) {
                            $sql_check = "SELECT * FROM product_tb
                            WHERE product_name = '$product_name' AND product_id != '$product_id'";
                            $query_check = mysqli_query($conn, $sql_check);
                            $row_check = mysqli_num_rows($query_check);
                            if ($row_check > 0) {
                                $alert = '<script>';
                                $alert .= 'alert("' . $product_name . ' ชื่อสินค้าซ้ำ กรุณากรอกใหม่อีกครั้ง");';
                                $alert .= 'window.location.href = "?page=' . $_GET['page'] . '&function=update&product_id=' . $product_id . '";';
                                $alert .= '</script>';
                                echo $alert;
                                exit();
                            } else {
                                $sql = "UPDATE product_tb SET 
                                product_name='$product_name',
                                product_detail='$product_detail',
                                product_price='$product_price',
                                product_status='$product_status',
                                product_img='$filename',
                                protype_id='$protype_id'
                                WHERE product_id=" . $product_id;
                                if (mysqli_query($conn, $sql)) {
                                    $alert = '<script>';
                                    $alert .= 'alert("แก้ไขสำเร็จ");';
                                    $alert .= 'window.location.href = "?page=product";';
                                    $alert .= '</script>';
                                    echo $alert;
                                    exit();
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                            }
                        }
                    }
                    ?>
                    <?php
                    if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
                        $sql = "SELECT product_id, protype_id, product_name, product_detail, product_price, product_img, product_status, product_create_datetime, protype_name, COUNT(key_status) AS product_qty FROM product_tb JOIN protype_tb USING (protype_id) LEFT JOIN key_tb USING(product_id) WHERE product_id = '".$_GET['product_id']."' AND key_status != '2' OR key_status IS NULL GROUP BY product_id;";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                    }
                    ?>

                    <?php
                    $sql1 = 'SELECT * FROM protype_tb';
                    $query1 = mysqli_query($conn, $sql1);
                    ?>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body col-lg-12">
                            <div class="form-group">
                                <div id="preview"><img src="upload/product/<?= $row['product_img'] ?>" width="225" height="150"><br><br></div>
                                <button class="btn btn-success" onclick="return triggerFile();">เลือกรูปภาพ</button><br><br>
                                <input name="product_img" type="file" id="img" value="<?= $row['product_img'] ?>" style="display:none;">
                                <input type="hidden" name="oldimg" value="<?= $row['product_img'] ?>">
                                <div class="form-group">
                                    <label>ประเภทสินค้า</label>
                                    <select name="protype_id" class="form-control" required="required">
                                        <option value="" disabled>ประเภทสินค้า</option>
                                        <?php foreach ($query1 as $data) : ?>
                                            <option value="<?= $data['protype_id'] ?>" <?= $row['protype_id'] == $data['protype_id'] ? 'selected' : '' ?>><?= $data['protype_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ชื่อสินค้า</label>
                                    <input name="product_name" type="text" class="form-control" placeholder="ใส่ ชื่อสินค้า" value="<?= $row['product_name'] ?>" autocomplete="off" required="required">
                                </div>
                                <div class="form-group mb-4">
                                    <label>ลายละเอียดสินค้า</label>
                                    <textarea style="resize: none;" maxlength="700" name="product_detail" rows="8" class="form-control" placeholder="ใส่ ลายละเอียด (สูงสุด 700ตัวอักษร)" required="required"><?= $row['product_detail'] ?></textarea>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>ราคา</label>
                                    <input name="product_price" type="number" class="form-control" placeholder="฿฿฿" value="<?= $row['product_price'] ?>" required="required">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label>จำนวนสินค้า</label>
                                    <input name="product_qty" disabled type="number" class="form-control" value="<?= $row['product_qty'] ?>" required="required">
                                </div>
                                <div class="form-group">
                                    <label>สถานะ</label>
                                    <input name="product_status" type="radio" value="0" <?= ($row['product_status'] == "0" ? 'checked' : '') ?> required="required"> แสดงสินค้า
                                    <input name="product_status" type="radio" value="1" <?= ($row['product_status'] == "1" ? 'checked' : '') ?>> ซ่อนรายการสินค้า
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input name="add_pro" value="ยืนยันการแก้ไข" type="submit" class="btn btn-warning">
                        </div>
                    </form>
                </div> <!-- /.card -->
            </div>

            <?php $key = mysqli_query($conn, "SELECT * FROM key_tb WHERE product_id = '" . $_GET['product_id'] . "'");
            ?>
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <p class="card-title">Key ในระบบ</p>
                    </div>
                    <div class="card-body col-lg-12">
                        <div class="form-group">
                            <table class="table" id="example">
                                <thead>
                                    <tr>
                                        <th>KEY</th>
                                        <th>สถานะ</th>
                                        <th>เมนู</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($key as $data_k) : ?>
                                        <?php if ($data_k['key_status'] == 0) : ?>
                                            <tr>
                                                <td width="40%"><?= $data_k['key_serial'] ?></td>
                                                <td> ยังไม่ขาย </td>
                                                <td>
                                                    <a class="btn btn-warning" href="?page=product&function=update&product_id=<?= $_GET['product_id'] ?>&key_id=<?= $data_k['key_id'] ?>">แก้ไข</a>
                                                    <a class="btn btn-danger"  href="?page=product&function=update&product_id=<?= $_GET['product_id'] ?>&key_remove=<?= $data_k['key_id'] ?>" onclick='confirm("ต้องการลบ Key นี้หรือไม่");' >ลบ</a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <p class="card-title">Key ที่อยู่ระหว่างการทำ Order/จำหน่ายแล้ว</p>
                    </div>
                    <div class="card-body col-lg-12">
                        <div class="form-group">
                            <table class="table" id="example">
                                <thead>
                                    <tr>
                                        <th>KEY</th>
                                        <th>สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($key as $data_k) : ?>
                                        <?php if ($data_k['key_status'] != 0) : ?>
                                            <tr>
                                                <td><?= $data_k['key_serial'] ?></td>
                                                <td><?= $data_k['key_status'] == 1 ? 'อยู่ระหว่างการทำ Order' : 'จำหน่ายแล้ว' ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(isset($_POST['submit_add_key']) && !empty($_POST['submit_add_key'])){
                $sql = mysqli_query($conn,"INSERT INTO key_tb (key_id,key_serial,key_status,order_id,product_id) VALUES (NULL, '".$_POST['add_key']."', '0', NULL, '".$_GET['product_id']."');");
                if ($sql) {
                    $alert = '<script>';
                    $alert .= 'alert("เพิ่ม Key สำเร็จ");';
                    $alert .= 'window.location.href = "?page=product&function=update&product_id=' . $_GET['product_id'] . '";';
                    $alert .= '</script>';
                    echo $alert;
                    exit();
                } else {
                    echo 'ERROR';
                }
            } 
            ?>

            <div class="col-md-3">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <p class="card-title">เพิ่ม Key เข้าสู่ระบบ</p>
                    </div>
                    <div class="card-body col-lg-12">
                        <div class="form-group">
                            <label for="">ช่องสำหรับกรอก Key</label>
                            <form action="" method="post">
                                <input name="add_key" type="text"><br><br>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="เพิ่ม Key" name="submit_add_key" class="btn btn-success"></input>
                    </div>
                    </form>
                </div>

                <?php if (isset($_POST['form_key_edit']) && !empty($_POST['form_key_edit'])) {
                    $sql = mysqli_query($conn, "UPDATE key_tb SET key_serial = '" . $_POST['keyedit'] . "' WHERE key_tb.key_id = '" . $_POST['key_id'] . "';");
                    if ($sql) {
                        $alert = '<script>';
                        $alert .= 'alert("แก้ไขสำเร็จ");';
                        $alert .= 'window.location.href = "?page=product&function=update&product_id=' . $_GET['product_id'] . '";';
                        $alert .= '</script>';
                        echo $alert;
                        exit();
                    } else {
                        echo 'ERROR';
                    }
                }
                ?>

                <?php if(isset($_GET['key_remove']) && !empty($_GET['key_remove'])) {
                    $sql = mysqli_query($conn,"DELETE FROM key_tb WHERE key_tb.key_id = '".$_GET['key_remove']."'");
                    if ($sql) {
                        $alert = '<script>';
                        $alert .= 'alert("ลบ Key สำเร็จ");';
                        $alert .= 'window.location.href = "?page=product&function=update&product_id=' . $_GET['product_id'] . '";';
                        $alert .= '</script>';
                        echo $alert;
                        exit();
                    } else {
                        echo 'ERROR';
                    }
                }
                
                ?>


                <?php
                if (isset($_GET['key_id']) && !empty($_GET['key_id'])) :
                    $keyedit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM key_tb WHERE key_id = '" . $_GET['key_id'] . "' "))
                ?>
                    <div class="card card-primary">
                        <div class="card-header">
                            <p class="card-title">แก้ไข Key ในระบบ</p>
                        </div>
                        <div class="card-body col-lg-12">
                            <div class="form-group">
                                <form action="" method="POST">
                                    <label for="">เปลี่ยน Key : <?= $keyedit['key_serial'] ?></label><br>
                                    <input type="hidden" value="<?= $_GET['key_id'] ?>" name="key_id">
                                    <input type="text" value="<?= $keyedit['key_serial'] ?>" name="keyedit" id="">
                                    <div class="card-footer">
                                        <input type="submit" name="form_key_edit" value="แก้ไข" class="btn btn-warning"></input>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif;  ?>

            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function triggerFile() {
        $("#img").trigger("click");
        return false;
    }
</script>
<script>
    function imagePreview(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                $('#preview').html('<img src="' + event.target.result + '" width="225" height="150"/><br><br>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }
    $("#img").change(function() {
        imagePreview(this);
    });
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "ไม่มีข้อมูลในตาราง",
                "info": "แสดง _START_ - _END_ จาก _TOTAL_ รายการ",
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
<!-- /.content -->