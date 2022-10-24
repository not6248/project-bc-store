    <!--$cart = mysqli_query($conn,$sql);   //สินค้าในตะกล้า
        $carts = mysqli_query($conn,$sql);
        $cartss = mysqli_fetch_assoc($carts); //รวมราคา รวมจำนวนสินค้า 
        cartpricesum = ราคารวมทุกสินค้า
    -->
        
<?php
// เพิ่มสินค้า ----------------------------------------------------------------------------------------------------------------------------------
if(isset($_POST['add_to_cart']) && isset($_SESSION['user_login'])){
        
        $product_id = $_POST['add_to_cart'];
        $cart_id = $_SESSION['user_login'];
        $product_cart_qty = '1';

        $select_cart = mysqli_query($conn,"SELECT * FROM product_cart WHERE product_id ='$product_id' AND cart_id = '$cart_id' ") or die('query failed');
        
        if(mysqli_num_rows($select_cart) > 0){    //ถ้าสินค้ามีอยู่แล้วให้ขึ้นแจ้งเตือน
            echo ' <script>localStorage.setItem("swal",
                    Swal.fire("สินค้านี้มีอยู่ในตะกล้าแล้ว ","กรุณากดกดที่ตะกล้าเพื่อแก้ไขจำนวน","error")
                );
                    </script>';
                    
         }else{   //ถ้ายังไม่มีให้ทำการเพิ่มสินค้าจำนวน 1 ชิ้น
            mysqli_query($conn, "INSERT INTO product_cart(product_id,cart_id,product_cart_qty) VALUES('$product_id','$cart_id','$product_cart_qty')") or die('query failed');
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'เพิ่มสินค้าเรียบร้อย',
                text: 'กดปุ่มเพื่อปิดหน้าต่าง!',
              }).then((result) =>{
                document.location.href = 'index.php';
            })
            </script>";
            // echo '<script>window.location.href = index.php</script>';
                // echo '<meta http-equiv="refresh" content="1;">';
         }
              
    }elseif(isset($_POST['add_to_cart']) && !isset($_SESSION['user_login'])){  //ถ้าไม่ได้ Login ให้ขึ้นแจ้งเตือน
        echo ' <script>localStorage.setItem("swal",
        Swal.fire("กรุณา LOGIN ","กดปุ่มเพื่อปิดหน้าต่าง","error"));
        </script>';
        
    }
// ลบสินค้าในตะกล้า ----------------------------------------------------------------------------------------------------------------------------------
if(isset($_GET['remove_item_cart']) && isset($_SESSION['user_login'])){
    $remove_id = $_GET['remove_item_cart'];
    mysqli_query($conn, "DELETE FROM product_cart WHERE product_id = '$remove_id' AND cart_id = '".$_SESSION['user_login']."'") or die('query failed');
    // header('location:index.php');
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'ลบสินค้าเรียบร้อย',
                text: 'กดปุ่มเพื่อปิดหน้าต่าง!',
              }).then((result) =>{
                document.location.href = 'index.php';
            })
            </script>";
 }
?>
