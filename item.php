<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; 
?>



<?php
$sql = "SELECT product_tb.product_id,
product_tb.protype_id,
product_tb.product_name,
product_tb.product_detail,
product_tb.product_price,
product_tb.product_img,
product_tb.product_status,
product_tb.product_create_datetime,
protype_tb.protype_name,COUNT(*) as product_qty 
FROM product_tb 
JOIN protype_tb USING (protype_id) 
JOIN key_tb USING(product_id) 
WHERE product_id = '".$_GET['product_id']."' 
GROUP BY product_id  ";
$query_product = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query_product);
?>

<?php if($row['product_status'] > 0 || $row['product_qty'] < 1){
  header('location: ./');
} ?>

<body class="d-flex flex-column min-vh-100">
  <!-- Navigation-->
  <?php include 'includes/navbar.php'; ?>

  <section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="admin/upload/product/<?= $row['product_img'] ?>" alt="..." /></div>
        <div class="col-md-6">
          <h1 class="display-5 fw-bolder"><?= $row['product_name'] ?></h1>
          <div class=" mb-1">ประเภทสินค้า : <?= $row['protype_name'] ?></div>
          <div class=" mb-1">สินค้าคงเหลือ : <?= $row['product_qty'] ?></div>
          <div class="fs-5 mb-5"> <span><?= $row['product_price'] . '.00 ฿' ?></span></div>
          <p class="lead"><?= $row['product_detail'] ?></p>
          <br><br>
          <div class="d-flex">
            <!-- <input disabled class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" /> -->
            <form action="" method="post">
            <input type="hidden" name="add_to_cart" value="<?=$row['product_id'] ?>">
              <button class="btn btn-outline-dark flex-shrink-0" type="submit"> <i class="bi-cart-fill me-1"></i>เพิ่มใส่รถเข็น</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php //include 'includes/related.php'; 
  ?>
  <!-- Header-->
  <!-- Section-->

  <!-- Footer-->
  <?php include './includes/footer.php' ?>
  <!-- script -->
  <?php include './includes/scripts.php' ?>
  <?php include 'cart_sql.php'; ?>
  
</body>

</html>