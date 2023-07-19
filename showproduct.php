<?php
$sql = "SELECT product_tb.*, COUNT(key_tb.key_id) AS product_qty
        FROM product_tb
        JOIN protype_tb USING (protype_id)
        LEFT JOIN key_tb USING (product_id)
        WHERE (key_status = 0 OR key_tb.key_id IS NULL) AND product_status = 0 ";
if (isset($_GET['protype_id']) && !empty($_GET['protype_id'])) {
    $sql .= " AND protype_id = '" . $_GET['protype_id'] . "' ";
}
$sql .= "GROUP BY product_tb.product_id;";
$query_product = mysqli_query($conn, $sql);

 ?>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
            <?php while ($row = mysqli_fetch_assoc($query_product)) : ?>
                <?php if ($row['product_status'] !== '1') : ?>
                    <div class="col mb-5 hidden">
                        <div class="card hover-p h-100">
                            <!-- <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div> -->
                            <div>
                                <?php if ($row['product_qty'] !== '0') : ?>
                                    <a href="item.php?product_id=<?= $row['product_id'] ?>" title="<?= $row['product_name'] ?>">
                                    <?php endif; ?>
                                    <img width="270" height="180" class="card-img-top" src="admin/upload/product/<?= $row['product_img'] ?>" alt='...' />
                                    </a>
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">
                                        <?php if ($row['product_qty'] !== '0') : ?>
                                            <a class="text-decoration-none" href="item.php?product_id=<?= $row['product_id'] ?>" title="<?= $row['product_name'] ?>"><?= $row['product_name'] ?></a>
                                        <?php else : ?>
                                            <p class="text-decoration-none" title="<?= $row['product_name'] ?>"><?= $row['product_name'] ?></p>
                                        <?php endif; ?>
                                    </h5>
                                    <div><span>==============</span></div>
                                    <!-- <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div> -->
                                    <?php if ($row['product_status'] == '1' || $row['product_qty'] == '0') {
                                        echo '<br>';
                                        echo '<h3 class="text-danger"><b>*สินค้าหมด*</b></h3>';
                                    } else {

                                        echo $row['product_price'] . '.00 ฿';

                                        echo '<p>สินค้าคงเหลือ : ' . $row['product_qty'] . ' ชิ้น</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($row['product_qty'] !== '0') : ?>
                                    <div class="text-center">
                                        <form action="" method="post">
                                            <input type="hidden" name="add_to_cart" value="<?=$row['product_id'] ?>">
                                            <button class="btn btn-outline-dark mt-auto">เพิ่มใส่รถเข็น</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </div>
    


