<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<!-- ------------------------------------------------------------------------------------------------------ -->
<?php
// query protype_tb
// CREATE VIEW view_protype_sum as 
// SELECT t.protype_name,
// t.protype_id,
// p.product_status,
// COUNT(p.protype_id) as Total,
// SUM(COUNT(p.protype_id))  OVER() AS SUM FROM product_tb p NATURAL JOIN protype_tb t 
// WHERE product_status != "1" 
// GROUP BY protype_name 
// ORDER BY protype_id; 
$sql1 = "SELECT pt.*,p.product_status,COUNT(*) AS Total FROM protype_tb pt JOIN product_tb p USING(protype_id) WHERE p.product_status =0 GROUP BY protype_id";
$query_protype = mysqli_query($conn, $sql1);
// $row1 = mysqli_fetch_assoc($query_protype);


?>
<!-- ------------------------------------------------------------------------------------------------------ -->
<body class="d-flex flex-column min-vh-100">
    <?php include 'includes/navbar.php'; ?>
    <!-- Navigation-->
    <!-- Header-->
    
    <div id="particles-js"></div>
    <header class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder text-5">ร้านขายเกมคุณภาพ</h1>
                <p class="lead fw-normal text-white-50 mb-0">เกมเยอะแยะ มาลองซื้อดู</p>
                
            </div>
        </div>
    </header>
    
    <!-- Section-->

    
    <section class="py-5" style="background-color: #263D58">
        <!-- -----ปุ่ม-------------------------------------------------------------------------------------------------- -->
        <div class="container px-4 px-lg-5">
            <a href="index.php" class="btn btn-dark">ทั้งหมด<span class="badge bg-info text-dark ms-1 rounded"></a>
            <?php //mysqli_data_seek($query_protype,0) ?>
            <?php while ($row1 = mysqli_fetch_assoc($query_protype)) : ?>
                <a  href="?protype_id=<?= $row1['protype_id'] ?>" class="btn btn-dark"><?= $row1['protype_name'] ?><span class="badge bg-info text-dark ms-1 rounded"><?= $row1['Total'] ?></span></a>
            <?php endwhile; ?>
        </div>
        <!-- ---------------------------------------------------------------------------------------------------------- -->
        
        <?php include 'showproduct.php' ?>
        <?php include 'cart_sql.php';  ?>
        


        <!-- ------------------------------------------------------------------------------------------------------ -->
    </section>
    
    <!-- Footer-->
    <?php include './includes/footer.php' ?>
    <!-- script -->
    <?php include './includes/scripts.php' ?>
</body>

</html>