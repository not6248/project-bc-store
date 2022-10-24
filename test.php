<!DOCTYPE html>
<html lang="en">
    
<?php include 'includes/head.php'; ?>

<?php $sql =  mysqli_query($conn,"SELECT product_name,product_price,product_qty FROM `view_product_qty`;");
while($row = mysqli_fetch_assoc($sql)){
    $test[] = $row;
};
$SS = serialize($test);
echo $SS;
// serialize($test); 

// $recoar = serialize($test);
// echo $recoar;

// $u = unserialize($recoar );
// echo print_r($u);

// $test = mysqli_query($conn,"SELECT order_details FROM order_tb  WHERE order_id = '20' and cart_id = '2';");
// $row1 = mysqli_fetch_assoc($test);
// $detal =$row1['order_details'];
// echo $detal;

// echo '<br>';
// echo '<br>';
// echo '<br>';
// echo '<br>';
// $u = unserialize($detal);
// foreach($u as $row){
//     echo $row['product_name'].' ';
//     echo $row['product_price'].'      ';
//     echo $row['product_qty'];
//     echo '<br>';
// }
// foreach($row1 as $row2){
//     echo $row2['product_name'];
//     echo $row2['product_price'];
// }
// foreach($test as $lol){
//     echo $lol['product_name'].'    ';
//     echo $lol['product_price'].'    ';
//     echo $lol['product_qty'];
//     echo '<br>';
// }
// echo '<pre>';
echo print_r(unserialize($SS));
// echo '</pre>';
?>


<?php include './includes/scripts.php' ?>
</body>
</html>