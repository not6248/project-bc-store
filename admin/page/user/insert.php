<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">เพิ่มข้อมูลผู้ใช้</h1>
            </div><!-- /.col -->

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=<?=$_GET['page']?>">จัดการข้อมูลผู้ใช้</a></li>
                    <li class="breadcrumb-item active">เพิ่มข้อมูลผู้ใช้</li>
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
                        <h3 class="card-title">ฟอร์มสำหรับกรอกข้อมูล</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    // ($_POST);
                    if (isset($_POST) && !empty($_POST)) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $email = $_POST['email'];
                        $user_type = $_POST['user_type'];

                        //check
                        if (!empty($username) && !empty($email)) {
                            $sql1 = "SELECT * FROM user_tb WHERE username = '$username'";
                            $sql2 = "SELECT * FROM user_tb WHERE email = '$email'";
                            $query1 = mysqli_query($conn, $sql1); //User
                            $query2 = mysqli_query($conn, $sql2);  //Email
                            $row_user = mysqli_num_rows($query1);
                            $row_email = mysqli_num_rows($query2);
                            if ($row_user > 0) {
                                echo '<script>
                                alert("Username มีผู้ใช้แล้ว");
                                window.location.href = "?page=user&function=add";
                                </script>';
                                exit();
                            }elseif ($row_email > 0) {
                                echo '<script>
                                alert("Email มีผู้ใช้แล้ว");
                                window.location.href = "?page=user&function=add";
                                </script>';
                                exit();
                            } else {
                                $sql = "INSERT INTO user_tb (firstname, lastname,username,password,email,user_type)
                                VALUES ('$firstname','$lastname','$username','$password','$email','$user_type')";
                                if (mysqli_query($conn, $sql)) {
                                    $alert = '<script>';
                                    $alert .= 'alert("เพิ่มข้อมูลพนักงานสำเร็จ");';
                                    $alert .= 'window.location.href = "?page=user";';
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
                                <label>ชื่อผู้ใช้</label>
                                <input name="username" type="text" class="form-control" placeholder="Enter user" value="<?php echo isset($_POST['username']) && !empty($_POST['username']) ? ($_POST['username']) : ''; ?>" required="required">
                            </div>
                            <div class="form-group mb-4">
                                <label>รหัสผ่าน</label>
                                <input name="password" type="text" class="form-control" placeholder="Enter password" value="<?php echo isset($_POST['password']) && !empty($_POST['password']) ? ($_POST['password']) : ''; ?>" required="required">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>ชื่อ</label>
                                <input name="firstname" type="text" class="form-control" placeholder="ชื่อ" value="<?php echo isset($_POST['firstname']) && !empty($_POST['firstname']) ? ($_POST['firstname']) : ''; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>นามสกุล</label>
                                <input name="lastname" type="text" class="form-control" placeholder="นามสกุล" value="<?php echo isset($_POST['lastname']) && !empty($_POST['lastname']) ? ($_POST['lastname']) : ''; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo isset($_POST['email']) && !empty($_POST['email']) ? ($_POST['email']) : ''; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>สิทธิ์การใช้ระบบ</label>
                                <input name="user_type" type="radio" value="1" required="required"> Admin
                                <input name="user_type" type="radio" value="2"> User
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button name="add_user" type="submit" class="btn btn-primary">บันทึก</button>
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