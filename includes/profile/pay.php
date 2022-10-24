<?php
if (isset($_POST) && !empty($_POST)) {
    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';
    // exit();


    $bankname = $_POST['bankname'];
    $order_id = $_GET['order_id'];

    if (isset($_FILES['img']['name']) && !empty($_FILES['img']['name'])) {
        $extension = array("jpeg", "jpg", "png");
        $target = './admin/upload/pay_slip/';
        $filename = $_FILES['img']['name'];
        $filetmp = $_FILES['img']['tmp_name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($ext, $extension)) {
            if (!file_exists($target . $filename)) {
                $orderimgname = "Order_id_".$order_id .".".$ext;
                if (move_uploaded_file($filetmp, $target . $orderimgname)) {
                    $filename = $orderimgname;
                } else {
                    $alert = '<script>';
                    $alert .= 'alert("เพิ่มไฟล์ไม่สำเร็จ");';
                    // $alert .= 'window.location.href = "?page=order_details&function=pay&order_id='.$_GET['order_id'].'";';
                    $alert .= '</script>';
                    echo $alert;
                    exit();
                }
            } else {
                $newfilename = time() . $filename;
                if (move_uploaded_file($filetmp, $target . $newfilename)) {
                    $filename = $newfilename;
                } else {
                    $alert = '<script>';
                    $alert .= 'alert("เพิ่มไฟล์ไม่สำเร็จ");';
                    // $alert .= 'window.location.href = "?page=order_details&function=pay&order_id='.$_GET['order_id'].'";';
                    $alert .= '</script>';
                    echo $alert;
                    exit();
                }
            }
        } else {
            $alert = '<script>';
            $alert .= 'alert("ประเภทไฟล์รูปไม่ถูกต้อง กรุณาใช้เป็น jpeg jpg png");';
            // $alert .= 'window.location.href = "?page=order_details&function=pay&order_id='.$_GET['order_id'].'";';
            $alert .= '</script>';
            echo $alert;
            exit();
        }
    } else {
        // $filename = '';
    }
    //check
    if (!empty($bankname)) {
        $sql = "INSERT INTO paymentdetail_tb (bankname, pay_slip,order_id)
                VALUES ('$bankname','$filename','$order_id')";
        if (mysqli_query($conn, $sql)) {
            $alert = '<script>';
            $alert .= 'alert("เพิ่มข้อมูลสำเร็จ");';
            $alert .= 'window.location.href = "./profile.php";';
            $alert .= '</script>';
            echo $alert;
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4 mb-md-0">
            <div class="card-body">
                <h3 class="card-title mb-4 ">ฟอร์มสำหรับกรอกข้อมูลการชำระเงิน</h3>
                <!-- --------------------------------------------------------------------------------------- -->
                <form action="" method="POST" enctype="multipart/form-data" onsubmit="return submitForm(this);">
                    <div class="card-body col-lg-12">
                        <div class=" form-group">
                            <label for="">ORDER ID #<?= $_GET['order_id']?></label>
                        </div>
                        <br>
                        <div class="form-group">
                            <input class="form-control" name="img" type="file" required="required">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>ตัวเลือกธนาคาร</label>
                            <select name="bankname" class="form-control" required="required">
                                <option value="" selected disabled>เลือกธนาคาร</option>
                                <option value="กรุงไทย">กรุงไทย</option>
                                <option value="กสิกร">กสิกร</option>
                                <option value="พร้อมเพย์">พร้อมเพย์</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <!-- <button name="" type="submit" onclick="return confirm('ต้องการส่งข้อมูลนี้หรือไม่ !! ไม่สามารถแก้ไขได้ โปรดตรวจสอบภาพให้ถูกต้อง?');" class="btn btn-primary">บันทึก</button> -->
                        <button name="" type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4 mb-md-0">
            <div class="card-body">
                <img src="./admin/upload/bank_name.png" alt="" srcset="">
            </div>
        </div>
    </div>
</div>