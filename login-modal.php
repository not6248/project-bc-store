<form class="d-flex" action="login_db.php" method="post">
    <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal-form-login">
        &nbsp;Login
    </button>

    <div class="modal fade" id="modal-form-login">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เข้าสู่ระบบ</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Username -->
                    <!-- <form action="login_db.php" method="post"> -->
                    <?php $url = $_SERVER['REQUEST_URI'];
                    if ('/wgs/register.php' !== $url) : ?>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            
                            ?>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php } ?>
                    <?php endif ?>
                    <label for="username">Email</label>
                    <input class="form-control" type="text" name="email">
                    <!-- Password -->
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password">
                    <hr>
                    <p>ยังไม่เป็นสมาชิก? <a href="register.php" class="text-primary">สมัครสมาชิก</a></p>
                    <!-- <p>Forgot <a href="#" class="text-primary">Password?</a></p>    -->
                    <!-- ระบบรีรหัสผ่านเมื่อลืม -->
                    <button class="btn btn-primary float-end wave-ef" name="login" type="submit">เข้าสู่ระบบ</button>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</form>