<?php
    if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
        $sql = "DELETE FROM product_tb WHERE product_id=" . $_GET['product_id'];
        $result = mysqli_query($conn, $sql);
        $img = $_GET['img'];
        if ($result) {
            if(!empty($img)){
                unlink('upload/product/' . $img);
            }
            $alert = '<script>';
            $alert .= 'alert("ลบข้อมูลสำเร็จ");';
            $alert .= 'window.location.href = "?page=product";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
?>