<!-- Content Header (Page header) -->
<?php
$sql = 'SELECT * FROM user_tb';
$query = mysqli_query($conn, $sql);
?>
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
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">ฟอร์มสำหรับแก้ไขข้อมูล</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    // ($_POST);
                    if (isset($_POST) && !empty($_POST)) {
                        $password = $_POST['password'];
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $email = $_POST['email'];
                        $user_type = $_POST['user_type'];
                        $status = $_POST['status'];
                        $user_id = $_GET['user_id'];
                        //check
                        if (!empty($email)) {
                            $sql_check = "SELECT * FROM user_tb
                            WHERE email= '$email' AND user_id != '$user_id'";
                            $query_check = mysqli_query($conn, $sql_check);
                            $row_check = mysqli_num_rows($query_check);
                            if ($row_check > 0) {
                                $alert = '<script>';
                                $alert .= 'alert("'.$email.' มีผู้ใช้แล้ว กรุณากรอกใหม่อีกครั้ง");';
                                $alert .= 'window.location.href = "?page=' . $_GET['page'] . '&function=update&user_id=' . $user_id . '";';
                                $alert .= '</script>';
                                echo $alert;
                                exit();
                            } else {
                                $sql = "UPDATE user_tb SET firstname='$firstname',lastname='$lastname',password='$password',email='$email',user_type='$user_type',status='$status'
                                WHERE user_id=".$user_id;
                                if (mysqli_query($conn, $sql)) {
                                    $alert = '<script>';
                                    $alert .= 'alert("แก้ไขสำเร็จ");';
                                    $alert .= 'window.location.href = "?page=user";';
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
                    if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
                        $sql = "SELECT * FROM user_tb WHERE user_id=" . $_GET['user_id'];
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                    }
                    ?>

                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>ชื่อผู้ใช้</label>
                                <input name="username" type="text" class="form-control" placeholder="Enter user" value="<?= $row['username'] ?>" disabled>
                            </div>
                            <div class="form-group mb-4">
                                <label>รหัสผ่าน</label>
                                <input name="password" type="text" class="form-control" placeholder="Enter password" value="<?= $row['password'] ?>" required="required">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>ชื่อ</label>
                                <input name="firstname" type="text" class="form-control" placeholder="ชื่อ" value="<?= $row['firstname'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>นามสกุล</label>
                                <input name="lastname" type="text" class="form-control" placeholder="นามสกุล" value="<?= $row['lastname'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control" placeholder="Email" value="<?= $row['email'] ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>สิทธิ์การใช้ระบบ</label>
                                <input name="user_type" type="radio" value="1" <?= ($row['user_type'] == "1" ? 'checked' : '') ?>> Admin
                                <input name="user_type" type="radio" value="2" <?= ($row['user_type'] == "2" ? 'checked' : '') ?>> User
                            </div>
                            <div class="form-group">
                                <label>สถานะ</label>
                                <input name="status" type="radio" value="0" <?= ($row['status'] == "0" ? 'checked' : '') ?>> เปิดใช้งาน
                                <input name="status" type="radio" value="1" <?= ($row['status'] == "1" ? 'checked' : '') ?>> ปิดใช้งาน
                            </div>
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