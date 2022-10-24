<!DOCTYPE html>
<html lang="en">
<?php include './includes/head.php'; ?>

<?php //$sql = mysqli_query($conn, "SELECT * FROM user_tb WHERE user_id = '" . $_SESSION['user_login'] . "'");
//$row = mysqli_fetch_assoc($sql);

// $url = $_SERVER['REQUEST_URI'];
// $url = explode('/',$url);
// print_r($url);
?>



<body class="">
    <?php include 'includes/navbar.php'; ?>
    <section class="d-flex flex-column min-vh-100">
        <div class="content py-5">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-5 mr-auto">
                        <div class="contactus-des">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h1 class="contact-name">ติดต่อเรา</h1>
                                </div>
                                <div class="col-xs-12">
                                    <h3>ติดต่อฝ่ายบริการ</h3>
                                    <i class="las la-headset"></i>
                                    <img src="https://www.myaccount-cloud.com/upload/8567/EEtam2w74T.png" alt="">
                                    <p>สอบถามทุกเรื่อง ขอคำแนะนำการใช้งาน <br><strong>โทรศัพท์ :</strong> <span class="tel">
                                            <a href="tel:+66621188722">062-118-8722</a>,
                                        </span><br>
                                        <strong>
                                            อีเมล์ : </strong><a href="mailto:not-6248@hotmail.com">not-6248@hotmail.com</a> <br>
                                        <strong>Facebook : </strong><a href="http://m.me/Not6248" target="_blank" rel="noopener">เอกภพ</a>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h3>วัน เวลา ทำการ</h3>
                                    <i class="las la-clock"></i>
                                    <img src="https://www.myaccount-cloud.com/upload/8567/pwz6DyFCUG.png" alt="">
                                    <p>วันจันทร์ - วันศุกร์ เวลา 08:30-17:45 น.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="contact-name" style="margin-top: 25px;">
                                        <h3>สถานที่ตั้ง</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-unstyled pl-md-5 mb-5">
                            <li class="d-flex text-black mb-2">
                                <span class="mr-3"><span class="icon-map"></span></span>
                                744 Student dormitory, Thammasat University, Nai Mueang Subdistrict
                                Mueang Nakhon Ratchasima <br> District, Nakhon Ratchasima Province, 30000 <br> Thailand
                            </li>
                            <li class="d-flex text-black mb-2"><span class="mr-3"><span class="icon-phone"></span></span> +66 62 118 8722</li>
                            <li class="d-flex text-black"><span class="mr-3"><span class="icon-envelope-o"></span></span> not-6248@hotmail.com </li>
                        </ul>
                    </div>

                    <div class="col-md-7">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d681.3305672793733!2d102.11871278242184!3d14.982281442837644!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31194c7e0ba48b2b%3A0x4f2ecc528e4d47ea!2zUk1VVEkgRG9ybWl0b3J5IOC4q-C4reC4nuC4seC4geC4meC4seC4geC4qOC4tuC4geC4qeC4siDguKHguJfguKMu4Lit4Li14Liq4Liy4LiZ!5e0!3m2!1sth!2sth!4v1666065575579!5m2!1sth!2sth" width="750" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <!-- <form class="mb-5" method="post" id="contactForm" name="contactForm">
                            <div class="row">

                                <div class="col-md-12 form-group">
                                    <label for="name" class="col-form-label">ชื่อ</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="message" class="col-form-label">ข้อความ</label>
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="7"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" value="ส่งข้อความ" class="btn btn-primary rounded-0 py-2 px-4">
                                    <span class="submitting"></span>
                                </div>
                            </div>
                        </form> -->
                    </div>
                    
                </div>
            </div>
    </section>




    <?php include './includes/footer.php' ?>
    <!-- script -->
    <?php include './includes/scripts.php' ?>

</body>
<!-- Footer-->

</body>

</html>