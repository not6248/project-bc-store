<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">เพิ่มสินค้า</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=<?= $_GET['page'] ?>">จัดการสินค้า</a></li>
                    <li class="breadcrumb-item active">เพิ่มสินค้า</li>
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
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">ฟอร์มสำหรับกรอกข้อมูลสินค้า</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    // ($_POST);
                    if (isset($_POST) && !empty($_POST)) {
                        // echo '<pre>';
                        // print_r($_FILES);
                        // echo '</pre>';
                        // exit();
                        $product_name = $_POST['product_name'];
                        $product_detail = mysqli_real_escape_string($conn,$_POST['product_detail']);
                        $product_price = $_POST['product_price'];
                        $product_status = $_POST['product_status'];
                        $protype_id = $_POST['protype_id'];

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
                                    } else {
                                        echo 'เพิ่มไฟล์ไม่สำเร็จ';
                                    }
                                } else {
                                    $newfilename = time() . $filename;
                                    if (move_uploaded_file($filetmp, $target . $newfilename)) {
                                        $filename = $newfilename;
                                    } else {
                                        echo 'เพิ่มไฟล์ไม่สำเร็จ';
                                    }
                                }
                            } else {
                                $alert = '<script>';
                                $alert .= 'alert("ประเภทไฟล์รูปไม่ถูกต้อง กรุณาใช้เป็น jpeg jpg png");';
                                $alert .= 'window.location.href = "?page=product&function=add";';
                                $alert .= '</script>';
                                echo $alert;
                                exit();
                            }
                        } else {
                            $filename = '';
                        }
                        // echo $filename;
                        //check
                        if (!empty($product_name)) {
                            $sql1 = "SELECT * FROM product_tb WHERE product_name = '$product_name'";
                            $query1 = mysqli_query($conn, $sql1); //product_name
                            $row1 = mysqli_num_rows($query1);
                            if ($row1 > 0) {
                                $alert = '<script>';
                                $alert .= 'alert("มีชื่อสินค้านี้แล้ว");';
                                $alert .= 'window.location.href = "?page=product&function=add";';
                                $alert .= '</script>';
                                echo $alert;
                                exit();
                            } else {
                                $sql = "INSERT INTO product_tb (product_name, product_detail,product_price,product_status,product_img,protype_id)
                                VALUES ('$product_name','$product_detail','$product_price','$product_status','$filename','$protype_id')";
                                if (mysqli_query($conn, $sql)) {
                                    $alert = '<script>';
                                    $alert .= 'alert("เพิ่มข้อมูลสินค้า");';
                                    $alert .= 'window.location.href = "?page=product";';
                                    $alert .= '</script>';
                                    echo $alert;
                                    exit();
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                                mysqli_close($conn);
                            }
                        }
                    }
                    ?>
                    <?php
                    $sql = 'SELECT * FROM protype_tb';
                    $query = mysqli_query($conn, $sql);
                    ?>


                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body col-lg-12">
                            <div class="form-group">
                            <div id="preview"><img width="225" height="150"><br><br></div>
                                <button class="btn btn-success" onclick="return triggerFile();">เลือกรูปภาพ</button><br><br>
                                <input name="product_img" type="file" id="img" value="<?= $row['product_img'] ?>" style="display:none;">
                            </div>
                            <div class="form-group">
                                <label>ประเภทสินค้า</label>
                                <select name="protype_id" class="form-control" required="required">
                                    <option value="" selected disabled>ประเภทสินค้า</option>
                                    <?php foreach ($query as $data) : ?>
                                        <option value="<?=$data['protype_id']?>"><?=$data['protype_name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>ชื่อสินค้า</label>
                                <input name="product_name" type="text" class="form-control" placeholder="ใส่ ชื่อสินค้า" value="<?php echo isset($_POST['username']) && !empty($_POST['username']) ? ($_POST['username']) : ''; ?>" required="required">
                            </div>
                            <div class="form-group mb-4">
                                    <label>ลายละเอียดสินค้า</label>
                                    <textarea style="resize: none;" maxlength="700" name="product_detail" rows="8" class="form-control" placeholder="ใส่ ลายละเอียด (สูงสุด 700ตัวอักษร)" required="required"></textarea>
                                </div>
                            <hr>
                            <div class="form-group">
                                <label>ราคา</label>
                                <input name="product_price" type="number" class="form-control" placeholder="฿฿฿" value="<?php echo isset($_POST['firstname']) && !empty($_POST['firstname']) ? ($_POST['firstname']) : ''; ?>" required="required">
                            </div>
                            <div class="form-group">
                                    <label>สถานะ</label>
                                    <input name="product_status" type="radio" value="0"  required="required"> แสดงสินค้า
                                    <input name="product_status" type="radio" value="1"> ซ่อนรายการสินค้า
                                </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button name="add_product" type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
                </div> <!-- /.card -->
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
<!-- /.content -->