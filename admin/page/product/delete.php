<?php
    if (isset($_GET['product_id']) && !empty($_GET['product_id'])) {
        $sql = "DELETE FROM product_tb WHERE product_id=" . $_GET['product_id'];
        try {
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
        } catch (\Throwable $e) {
            $alert = '<script>';
            $alert .= 'alert("เกิดข้อผิดพลาด");';
            $alert .= 'window.location.href = "?page=product";';
            $alert .= '</script>';
            echo $alert;
            exit();
        }

    }
    mysqli_close($conn);
?>