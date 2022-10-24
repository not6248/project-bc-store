<!-- Bootstrap core JS-->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- ----------------- -->
<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="js/particles.js"></script>
<!-- ----------------------------------- -->

<script>
    <?php if (!empty($cartss['sum'])) : ?>
        $(".c_out").click(function(e) {
            var cart_id = <?= $_SESSION['user_login'] ?>;
            e.preventDefault();
            orderConfirm(cart_id);
        })

        function orderConfirm(cart_id) {
            Swal.fire({
                title: 'ต้องการทำรายการหรือไม่',
                text: 'เป็นเงินทั้งหมด ' + '<?= number_format($_SESSION['cartpricesum']) ?>' + ' บาท',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ทำรายการเลย',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'checkout.php',
                                type: 'GET',
                                data: 'cart_id=' + cart_id,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'ทำรายการเสร็จเรียบร้อย!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'profile.php';
                                })
                            })
                            .fail(function() {
                                Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
    <?php else : ?>
        $(document).ready(function() {
            $("#c_out").click(function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'ไม่มีสินค้าในตะกล้า!'
                })
            });
        });
    <?php endif; ?>
</script>

<!-- GetButton.io widget -->
<script type="text/javascript">
    (function() {
        var options = {
            facebook: "100010178464228", // Facebook page ID
            facebook_frame: true, // Open Facebook chat at frame
            call_to_action: "หากมีปัญหาด้านการใช้งานโปรดติดต่อเรา!", // Call to action
            button_color: "#FF6550", // Color of button
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = 'https:',
            host = "getbutton.io",
            url = proto + '//static.' + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url + '/widget-send-button/js/init.js';
        s.onload = function() {
            WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->

<script>
    $(".o_cancel").click(function(e) {
        var order_id = $(this).data("id");
        e.preventDefault();
        cancelOrderConfirm(order_id);
    })

    function cancelOrderConfirm(order_id) {
        Swal.fire({
            title: 'ต้องการยกเลิก Order หรือไม่',
            text: 'ตัวเลือกนี้ไม่สามารถย้อนกลับได้',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่ ทำรายการเลย',
            cancelButtonText: 'ยกเลิก',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            url: 'includes/profile/cancel_order.php',
                            type: 'GET',
                            data: 'order_id=' + order_id,
                        })
                        .done(function() {
                            Swal.fire({
                                title: 'success',
                                text: 'ทำรายการเสร็จเรียบร้อย!',
                                icon: 'success',
                            }).then(() => {
                                document.location.href = './profile.php';
                            })
                        })
                        .fail(function() {
                            Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
                            window.location.reload();
                        });
                });
            },
        });
    }
</script>

<script>
    function submitForm(form) {
        Swal.fire({
                title: 'ต้องการส่งข้อมูลนี้หรือไม่?',
                text: "ไม่สามารถแก้ไขได้ โปรดตรวจสอบข้อมูลให้ถูกต้อง!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ทำรายการเลย',
                cancelButtonText: 'ยกเลิก',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
    }
</script>