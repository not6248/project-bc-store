<?php
    if (isset($_GET['order_id']) && !empty($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $sql = mysqli_query($conn,"UPDATE key_tb SET key_status = '0',order_id = NULL WHERE order_id = $order_id;");
    $sql2 = mysqli_query($conn,"UPDATE order_tb SET order_status = '2' WHERE order_tb.order_id = $order_id;");
        if ($sql and $sql2 ) {
            $alert = '<script>';
            $alert .= 'alert("ยกเลิก Order เรียบร้อย");';
            $alert .= 'window.location.href = "?page='.$_GET['page'].'";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
