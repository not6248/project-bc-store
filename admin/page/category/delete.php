<?php
    if (isset($_GET['protype_id']) && !empty($_GET['protype_id'])) {
        $sql = "DELETE FROM protype_tb WHERE protype_id=" . $_GET['protype_id'];
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $alert = '<script>';
            $alert .= 'alert("ลบข้อมูลสำเร็จ");';
            $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>