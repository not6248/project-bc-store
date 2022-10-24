<head>
    <?php
    require 'connection/connection.php';
    session_start();
    ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>BC Game Store</title>
    <!--======ICON======================================================================================-->
    <link type="image/png" sizes="16x16" rel="icon" href="admin/Upload/icon/favicon-16x16.png">
    <link type="image/png" sizes="32x32" rel="icon" href="admin/Upload/icon/favicon-32x32.png">
    <!--===============================================================================================-->
    <!--====Favicon-===================================================================================-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!--====Bootstrap icons============================================================================-->
    <link href="css/bootstrap-icons-1.9.1/bootstrap-icons.css" rel="stylesheet" />
    <!--====Core theme CSS (includes Bootstrap)========================================================-->
    <link href="css/styles.css" rel="stylesheet" />
    <!--=======Bootstrap  v5.2.0=======================================================================-->
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.min.css">
    <!--=========w3.css================================================================================-->
    <link href="css/w3.css" rel="stylesheet" />
    <!--=========particles=============================================================================-->
    <link href="css/particles.css" rel="stylesheet" />
    <!--=========jQuery================================================================================-->
    <script src="admin/js/jquery.min.js"></script>
    <!--=======sweetalert2=============================================================================-->
    <script src="admin/js/sweetalert2.all.min.js"></script>
    <!--========Custom=================================================================================-->
    <link rel="stylesheet" href="css/custom.css">
    <!--===============================================================================================-->
    <script src="js/fa.js" crossorigin="anonymous"></script>
    <!--===============================================================================================-->

    <script>

        $(document).ready(function() {
            $("#cartModal").modal('hide');
        });

        $(document).ready(function() {
            <?php $url = $_SERVER['REQUEST_URI'];
            if (isset($_SESSION['error']) && $url !== "/wgs/register.php") : ?>
                $("#modal-form-login").modal('show');
            <?php endif; ?>

        });
    </script>
    <!--===============================================================================================-->
    <?php
    // if (isset($_SESSION['admin_login'])) {
    //     unset($_SESSION['admin_login']);
    // }

    if (isset($_SESSION['user_login'])) {
        $sql = "SELECT cart_id FROM cart_tb WHERE cart_id =" . $_SESSION['user_login'];
        $result = mysqli_query($conn, $sql);
        $numrow = mysqli_num_rows($result);
        if ($numrow == 0) {
            $cartinsert = "INSERT INTO cart_tb(cart_id,user_id) VALUES ('" . $_SESSION['user_login'] . "','" . $_SESSION['user_login'] . "')";
            $result = mysqli_query($conn, $cartinsert);
        } else {
        }
    }
    ?>


</head>