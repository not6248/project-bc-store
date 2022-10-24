<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">แก้ไขประเภทสินค้า</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=<?= $_GET['page'] ?>">จัดการประเภทสินค้า</a></li>
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
                        <h3 class="card-title">ฟอร์มสำหรับแก้ไขประเภทสินค้า</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    $sql = "SELECT * FROM protype_tb WHERE protype_id=" . $_GET['protype_id'];
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <?php
                    // ($_POST);
                    if (isset($_POST) && !empty($_POST)) {
                        $protype_name = $_POST['protype_name'];
                        $protype_id = $_GET['protype_id'];
                        if (!empty($protype_name)) {
                            $sql_check = "SELECT * FROM protype_tb
                            WHERE protype_name= '$protype_name' AND protype_id != '$protype_id'";
                            $query_check = mysqli_query($conn, $sql_check);
                            $row_check = mysqli_num_rows($query_check);
                            if ($row_check > 0) {
                                $alert = '<script>';
                                $alert .= 'alert("ชื่อประเภทสินค้าซ้ำ กรุณากรอกใหม่อีกครั้ง");';
                                $alert .= 'window.location.href = "?page=' . $_GET['page'] . '&function=update&protype_id=' . $protype_id . '";';
                                $alert .= '</script>';
                                echo $alert;
                                exit();
                            } else {
                                $sql = "UPDATE protype_tb SET protype_name = '$protype_name'
                                WHERE protype_id=" . $_GET['protype_id'];
                                if (mysqli_query($conn, $sql)) {
                                    $alert = '<script>';
                                    $alert .= 'alert("แก้ไขสำเร็จ");';
                                    $alert .= 'window.location.href = "?page=' . $_GET['page'] . '";';
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
                                <input name="protype_name" type="text" class="form-control" placeholder="Ex: Steam" value="<?= $row['protype_name'] ?>" required="required">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button name="add_user" type="submit" class="btn btn-warning">ยืนยันการแก้ไข</button>
                            </div>
                    </form>
                </div> <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->