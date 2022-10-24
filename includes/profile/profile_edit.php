<div class="row">
    <div class="col-md-12">
        <div class="card mb-4 mb-md-0">
            <div class="card-body">
                <h3 class="card-title mb-4 ">แก้ไขโปรไฟล์</h3>
                <table class="table" id="example">
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
                            $user_id = $_GET['user_id'];
                            //check
                            if (!empty($email)) {
                                $sql_check = "SELECT * FROM user_tb
                            WHERE email= '$email' AND user_id != '$user_id'";
                                $query_check = mysqli_query($conn, $sql_check);
                                $row_check = mysqli_num_rows($query_check);
                                if ($row_check > 0) {
                                    $alert = '<script>';
                                    $alert .= 'alert("' . $email . ' มีผู้ใช้แล้ว กรุณากรอกใหม่อีกครั้ง");';
                                    $alert .= 'window.location.href = "?page=profile_edit&user_id=' . $user_id . '";';
                                    $alert .= '</script>';
                                    echo $alert;
                                    exit();
                                } else {
                                    $sql = "UPDATE user_tb SET firstname='$firstname',lastname='$lastname',password='$password',user_type='2',email='$email'
                                WHERE user_id=" . $user_id;
                                    if (mysqli_query($conn, $sql)) {
                                        $alert = '<script>';
                                        $alert .= 'alert("แก้ไขสำเร็จ");';
                                        $alert .= 'window.location.href = "profile.php";';
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
                                    <label>รหัสผ่าน (ลบออกทั้งหมด แล้วกรอกใหม่ได้เลยครับ)</label>
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
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button name="add_user" type="submit" class="btn btn-warning">ยืนยันการแก้ไข</button>
                            </div>
                        </form>
                    </div>
                </table>
            </div> <!-- /.card -->
        </div>
    </div>
</div>