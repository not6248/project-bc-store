<!DOCTYPE html>
<html lang="en">
<?php include './includes/head.php'; ?>
<?php
if (!isset($_SESSION['user_login'])) {
    header('location: ./');
}
?>
<?php $sql = mysqli_query($conn, "SELECT * FROM user_tb WHERE user_id = '" . $_SESSION['user_login'] . "'");
$row = mysqli_fetch_assoc($sql);

// $url = $_SERVER['REQUEST_URI'];
// $url = explode('/',$url);
// print_r($url);
?>



<body>
    <?php include 'includes/navbar.php'; ?>
    <section class="d-flex flex-column min-vh-100" style="background-color: #DADCE5;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a style="text-decoration: none;" href="./">หน้าแรก</a></li>
                            <li class="breadcrumb-item <?= !isset($_GET['page']) && empty($_GET['page']) ? 'active' : '' ?>" aria-current="page"><a style="text-decoration: none;" href="profile.php">โปรไฟล์</a></li>
                            <?php if (isset($_GET['page']) && $_GET['page'] == 'order_details') : ?>
                                <li class="breadcrumb-item active" aria-current="page">ออเดอร์</li>
                            <?php endif; ?>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"><?= $row['username'] ?></h5>
                            <p class="text-muted text-start mb-1">User ID : #<?= $_SESSION['user_login'] ?></p>
                            <p class="text-muted text-start mb-1">Name : <?= $row['firstname'] . '&nbsp' . $row['lastname'] ?></p>
                            <p class="text-muted text-start mb-4">Email : <?= $row['email'] ?></p>
                            <div class="d-flex justify-content-center float-start mb-2">
                                <!-- <button type="button" class="btn btn-primary">Follow</button> -->
                                <a href="?page=profile_edit&user_id=<?=$_SESSION['user_login']?>" type="button" class="btn btn-outline-primary ms-1"><i class="bi bi-gear"></i></a> 
                                <!-- <p>การตั้งค่าบัญชี <br>Comming Soon..</p> -->
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <?php
                    if (!isset($_GET['page']) && empty($_GET['page'])) {
                        include 'includes/profile/order.php';
                    }elseif(isset($_GET['page']) && $_GET['page'] == 'profile_edit'){
                        include 'includes/profile/profile_edit.php';
                    } elseif (isset($_GET['page']) && $_GET['page'] == 'order_details') {
                        if (isset($_GET['function']) && $_GET['function'] == 'pay') {
                            include 'includes/profile/pay.php';
                        } else {
                            include 'includes/profile/order_details.php';
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
        <?php include 'cart_sql.php';  ?>
    </section>
    <!-- Footer-->
    <?php include './includes/footer.php' ?>
    <!-- script -->
    <?php include './includes/scripts.php' ?>
</body>

</html>