<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #121213">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="./">BC Game Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <!-- --------------------------------------------------------------------------------------------------------------------------- -->
                <!-- <li class="nav-item "><a class="nav-link active" aria-current="page" href="#!">ร้านค้า&nbsp;</a></li> -->
                <!-- --------------------------------------------------------------------------------------------------------------------------- -->
                <!-- <li class="nav-item"><a class="nav-link" href="#!">เกี่ยวกับ</a></li> -->
                <!-- --------------------------------------------------------------------------------------------------------------------------- -->
                <li class="nav-item"><a class="nav-link" href="contact.php">ติดต่อ</a></li>
                <li class="nav-item"><a class="nav-link" href="manual.pdf">คู่มือการพัฒนาระบบ <i class="fa-solid fa-book"></i></a></li>
                <!-- --------------------------------------------------------------------------------------------------------------------------- -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">เพิ่มเติม&nbsp;</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">TEST1</a></li>
                        <li><a class="dropdown-item" href="#!">TEST2</a></li>
                        <li><a class="dropdown-item" href="#!">TEST3</a></li>
                    </ul>
                </li> -->
            </ul>
            <!-- --profile------------------------------------------------------------------------------------------------------------------ -->
            <?php if(isset($_SESSION['username'])): ?>
            <a href="profile.php" class="btn btn-outline-primary"><?=$_SESSION['username'] ?></a>&nbsp
            <?php endif ?>
            <!--cart Moale------------------------------------------------------------------------------------------------------------------- -->
                <?php include 'cart.php' ?>&nbsp
            <!--login Moale---------------------------------------------------------------------------------------------------------------- -->
            <?php if(!isset($_SESSION['username'])): ?>
                <?php include 'login-modal.php'?>&nbsp
            <?php else: ?>
                <!-- logout -->
                <div><a href="logout.php" class="btn btn-danger" onclick="return confirm('ต้องการออกจากระบบหรือไม่')">Logout</a>
            <?php endif ?>
            <!-- --------------------------------------------------------------------------------------------------------------------------- -->
        </div>
    </div>
</nav>