<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
require 'connection/connection.php';
//เลือกสินค้า จำนวนต่อสินค้ารวม  ราคาทั้งหมดรวม
$sqlcartsum = mysqli_query($conn,"SELECT * FROM product_cart JOIN product_tb USING(product_id) WHERE cart_id ='".$_GET['cart_id']."' ORDER BY product_id");

$od = array();
$order_dateils = mysqli_query($conn,"SELECT c.product_cart_qty,p.product_name,p.product_price FROM product_cart c JOIN product_tb p USING(product_id) WHERE c.cart_id = '".$_GET['cart_id']."' ORDER BY product_id ASC;");
while($rowod = mysqli_fetch_assoc($order_dateils)){
    array_push($od,$rowod);
};
$ods = serialize($od); 
print_r($_SESSION['cartpricesum']);

// date_default_timezone_set("Asia/Bangkok");
// $date = date("Y-m-d H:i:s");
//สร้าง Order
$sqlorder = "INSERT INTO order_tb(order_price,order_details,order_status,cart_id) VALUES ('".$_SESSION['cartpricesum']."','$ods',0,'".$_GET['cart_id']."');";
$order_query = mysqli_query($conn,$sqlorder);
if($order_query){
    echo 'ทำงาน';
}else{
    echo 'ไม่ทำงาน';
}



$last_id = mysqli_insert_id($conn);
//เช็คเวลาที่สร้าง Order
// $order = mysqli_query($conn,"SELECT * FROM order_tb WHERE order_id = $last_id AND cart_id ='".$_GET['cart_id']."';");
// $orderassoc = mysqli_fetch_assoc($order);  
// $orderid = $orderassoc['order_id'];


//เปลี่ยนสถานะ Key จะตะกล้า ที่ Order $orderid 
while($row = mysqli_fetch_assoc($sqlcartsum)){
    mysqli_query($conn,"UPDATE key_tb SET key_status = '1',order_id='$last_id' WHERE product_id = '".$row['product_id']."' AND key_status = '0' LIMIT ".$row['product_cart_qty']);
};

// $lID = mysqli_query($conn,"SELECT * FROM order_tb WHERE order_id = '$last_id ';");
// $locationid = mysqli_fetch_assoc($lID)['order_id'];

//ลบสินค้าในตะกล้า 
$cartempty = mysqli_query($conn,"DELETE FROM product_cart WHERE cart_id ='".$_GET['cart_id']."';");

if($cartempty){
    unset($_SESSION['cartpricesum']);
    //header("location:./");
}

?>