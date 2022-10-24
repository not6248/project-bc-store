<?php
    if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
        $sql2 = "DELETE FROM cart_tb WHERE cart_id=". $_GET['user_id'];
        $result2 = mysqli_query($conn, $sql2);
        $sql = "DELETE FROM user_tb WHERE user_id=" . $_GET['user_id'];
        $result = mysqli_query($conn, $sql);
        if ($result && $result2) {
            $alert = '<script>';
            $alert .= 'alert("ลบข้อมูลสำเร็จ");';
            $alert .= 'window.location.href = "?page=user";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            $alert = '<script>';
            $alert .= 'alert("ไม่สามารถลบผู้ใช้ได้ เนื่องจากผู้ใช้มีการทำ Order แล้ว");';
            $alert .= 'window.location.href = "?page=user";';
            $alert .= '</script>';
            echo $alert;
            exit();
            // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
?>