<?php
    require_once 'connection/pdo.php';

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body class="d-flex flex-column min-vh-100">
<?php include 'includes/navbar.php'; ?>   <!-- Navigation-->
<?php 

?>
    <section class="py-5" id="pageMain">
        <div class="container px-4  mt-4">
            <div class="row justify-content-center">
                <div class="col col-8 col-sm-6 col-lg-4 col-xl-3">
                    <h3>สมัครสามาชิก</h3>
                    <hr>
                <form action="signup_db.php" method="post">
                <?php if(isset($_SESSION['error'])){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                            echo $_SESSION['error']; 
                            unset($_SESSION['error']);
                        ?>
                    </div>
                <?php }?>
                <?php if(isset($_SESSION['warning'])){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                            echo $_SESSION['warning']; 
                            unset($_SESSION['warning']);
                        ?>
                    </div>
                <?php }?>
                <?php if(isset($_SESSION['success'])){ ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                            echo $_SESSION['success']; 
                            unset($_SESSION['success']);
                        ?>
                    </div>
                <?php }?>
                <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" aria-describedby="username">
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First name</label>
                        <input type="text" class="form-control" name="firstname" aria-describedby="firstname">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="lastname" aria-describedby="lastname">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" aria-describedby="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="confirm password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="c_password">
                    </div>
                    <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
                </form>
                </div>
            </div>
        </div>
    </section>
    

        <!-- Footer-->
        <?php include './includes/footer.php' ?>
        <!-- script -->
        <?php include './includes/scripts.php' ?>
</body>

</html>