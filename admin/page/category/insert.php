<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">เพิ่มประเภทสินค้า</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=<?=$_GET['page']?>">จัดการประเภทสินค้า</a></li>
                    <li class="breadcrumb-item active">เพิ่มประเภทสินค้า</li>
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
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">ฟอร์มสำหรับเพิ่มประเภทสินค้า</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    // ($_POST);
                    if (isset($_POST) && !empty($_POST)) {
                        $protype_name = $_POST['protype_name'];

                        //check
                        if (!empty($protype_name)) {
                            $sql1 = "SELECT * FROM protype_tb WHERE protype_name = '$protype_name'";
                            $query1 = mysqli_query($conn, $sql1); //Protype_name
                            $row_protype_name = mysqli_num_rows($query1);
                            if ($row_protype_name > 0) {
                                echo '<script>
                                alert("มีประเภทสินค้านี้แล้ว");
                                window.location.href = "?page=user&function=add";
                                </script>';
                                exit();
                            } else {
                                $sql = "INSERT INTO protype_tb (protype_name)
                                VALUES ('$protype_name')";
                                if (mysqli_query($conn, $sql)) {
                                    $alert = '<script>';
                                    $alert .= 'alert("เพิ่มประเภทสินค้าสำเร็จ");';
                                    $alert .= 'window.location.href = "?page=category";';
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

                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>ชื่อประเภทสินค้า</label>
                                <input name="protype_name" type="text" class="form-control" placeholder="ตัวอย่าง: สวมบทบาท" value="<?php echo isset($_POST['protype_name']) && !empty($_POST['protype_name']) ? ($_POST['protype_name']) : ''; ?>" required="required">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button name="add_protype" type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
                </div> <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>