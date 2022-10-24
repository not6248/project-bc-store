<?php
if (isset($_SESSION['user_login'])) {
    $sql = "SELECT * FROM product_cart JOIN product_tb USING(product_id) WHERE cart_id ='" . $_SESSION['user_login'] . "'";
    $cart = mysqli_query($conn, $sql);   //สินค้าในตะกล้า
    $carts = mysqli_query($conn,"SELECT SUM(product_cart_qty) as sum FROM product_cart JOIN product_tb USING(product_id) WHERE cart_id = '" . $_SESSION['user_login'] . "'");
    $cartss = mysqli_fetch_assoc($carts); //รวมราคา รวมจำนวนสินค้า
}
if(isset($_POST['product_update']) && !empty($_POST) && !empty($_POST['product_id'])){
    $sql  = "UPDATE product_cart SET product_cart_qty='".$_POST['proqty']."' WHERE product_id ='".$_POST['product_id']."' AND cart_id = '" . $_SESSION['user_login'] . "';";
    if(mysqli_query($conn,$sql)){
        echo '<script>
        alert("Update จำนวนสำเร็จ");
        window.location.href="index.php";
        </script>';
        // header("location:admin.php");
    }else{
        echo '<script>
        alert("ERROR");
        window.location.href="index.php";
        </script>';
        // header("location:admin.php");
    }
}elseif(isset($_POST['product_update']) && empty($_POST['product_id'])){
    echo '<script>
    alert("ไม่มีสินค้าภายในตะกล้า");
    window.location.href="index.php";
    </script>';
    // header("location:admin.php");
}

?>

<body>
    <form class="d-flex" action="" method="post">
        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#cartModal">
            <i class="bi-cart-fill me-1"></i>
            &nbsp;รถเข็น <span class="badge bg-dark text-white ms-1 rounded-pill"><?= isset($_SESSION['user_login']) && !empty($cartss['sum']) ? $cartss['sum'] : '0' ?></span>
        </button>

        <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" data-bs-dismiss="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">

                            <?= isset($_SESSION['user_login']) ? 'สินค้าในตะกล้าของคุณ' : 'กรุณา Login' ?>
                        </h5>
                        <button class="btn btn-outline-light" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php if (isset($_SESSION['user_login'])) : ?>
                        <div class="modal-body">
                            <table class="table table-image" style="font-size: 15px">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">สินค้า</th>
                                        <th scope="col">ราคา</th>
                                        <th scope="col">จำนวน</th>
                                        <th scope="col">รวม</th>
                                        <th scope="col">คำสั่ง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php $price_sum = '0';
                                    while ($cartrow = mysqli_fetch_assoc($cart)) : ?>
                                        <tr>

                                            <td class="w-25">
                                                <img src="admin/upload/product/<?= $cartrow['product_img'] ?>" class="img-fluid img-thumbnail" alt="Sheep">
                                            </td>
                                            <td><?= $cartrow['product_name'] ?></td>
                                            <td><?= number_format($cartrow['product_price']) ?> ฿</td>
                                            <td class="qty"><input name="proqty" type="number" class="form-control" id="input1" min="1" max="<?= mysqli_fetch_assoc(mysqli_query($conn, "SELECT *,COUNT(*) as product_qty FROM product_tb JOIN protype_tb USING (protype_id) JOIN key_tb USING(product_id) WHERE key_status < 1 AND product_id = '".$cartrow['product_id']."' GROUP BY product_id"))['product_qty']?>" value="<?= $cartrow['product_cart_qty'] ?>"></td>
                                            <td><?= number_format($cartrow['product_price'] * $cartrow['product_cart_qty']); ?> ฿</td>
                                            <?php $price_sum += ($cartrow['product_price'] * $cartrow['product_cart_qty']) ?>
                                            <td>
                                                <a href="index.php?remove_item_cart=<?= $cartrow['product_id'] ?>" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-x-lg"></i>
                                                </a>
                                                <input type="hidden" name="product_id" value="<?=$cartrow['product_id']?>">
                                            </td>
                                        </tr>
                                    <?php endwhile ?>

                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                <h5>ราคารวม: <span class="price text-success"><?= isset($_SESSION['user_login']) && !empty($cartss['sum']) ? number_format($_SESSION['cartpricesum'] = $price_sum) . ' ฿' : 'ไม่มีสินค้าในตะกล้านี้' ?></span></h5>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <span class="text-danger">โปรดกดปุ่ม Reload เพื่อ Update จำนวนสินค้า   </span>
                            <input type="submit" name="product_update" id="" class="btn btn-success" value="Reload">
                            <button type="button" id="c_out" class="btn btn-success c_out">Checkout</button>
                        <?php endif ?>
                        </div>
                </div>
            </div>
        </div>
    </form>