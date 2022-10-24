
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4 mb-md-0">
            <div class="card-body">
                <h3 class="card-title mb-4 ">ออเดอร์</h3>
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ราคารวม</th>
                            <th>สถานะ</th>
                            <th class="text-end" width="25%">เมนู</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT o.*,p.pay_id FROM order_tb o LEFT JOIN paymentdetail_tb p USING(order_id)WHERE cart_id ='" . $_SESSION['user_login'] . "' AND order_status !='2' or order_status = '2' AND pay_id is not null AND cart_id ='" . $_SESSION['user_login'] . "'";
                        $query = mysqli_query($conn, $sql);

                        ?>
                        <?php foreach ($query as $data) : ?>
                            <tr>
                                <td><?= $data['order_id'] ?></td>
                                <td><?= $data['order_price'] ?></td>
                                <?php if (empty($data['pay_id']) || $data['order_status'] == 1) : ?>
                                    <td><?= $data['order_status'] == 0 ? 'รอการชำระเงิน <img src="admin/upload/timer.gif" width="18px" height="18px" alt="noimg">' : 'ยืนยันแล้ว <img src="admin/upload/star.gif" width="20px" height="20px" alt="noimg">' ?></td>
                                <?php elseif(!empty($data['pay_id']) && $data['order_status'] == 2 ) : ?>
                                    <td><span class="font-weight-bold bg-warning text-dark">การชำระเงินไม่สมบูรณ์ โปรดติดต่อ admin <a target="_bank" href="http://m.me/Not6248">Messenger</a> <i class="fa-solid fa-triangle-exclamation"></i></span></td>
                                <?php else : ?>    
                                    <td><span>รอการตรวจสอบการชำระเงิน </span> <i class="fa-solid fa-circle-notch fa-spin"></i></td>
                                <?php endif; ?>
                                    <td class="text-end">
                                <?php if (empty($data['pay_id']) && $data['order_status'] == 0) : ?>
                                    <a data-id="<?= $data['order_id'] ?>" href="?page=&funtion=cancel_order&order_id=<?= $data['order_id'] ?>" class="btn btn-sm btn-danger o_cancel">ยกเลิก</a>
                                <?php endif; ?>
                                <a href="?page=order_details&order_id=<?= $data['order_id'] ?>" class="btn btn-sm btn-warning">ดูรายละเอียด</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>