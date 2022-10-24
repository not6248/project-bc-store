<?php
require '../connection/connection.php';
session_start();
//
if (isset($_POST['order_id'])) {
  $sql = "SELECT * FROM order_tb WHERE order_id=" . $_POST['order_id'];
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $order_details = unserialize($row['order_details']);


$sql = "SELECT p.product_name,k.key_serial FROM key_tb k JOIN product_tb p USING(product_id) WHERE order_id = '" . $row['order_id'] . "' ORDER BY product_id ASC;";
$query =  mysqli_query($conn, $sql);

$sql = mysqli_query($conn, "SELECT * FROM user_tb WHERE user_id = '" . $_SESSION['user_login'] . "'");
$user = mysqli_fetch_assoc($sql);
}



// ------------------------------------------------------------------------------------------------------
require_once("vendor/autoload.php");
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
  'mode' => 'utf-8',
  'orientation' => 'P',
  'fontDir' => array_merge($fontDirs, [
    __DIR__ . '/vendor/mpdf/mpdf/ttfonts',
  ]),
  'fontdata' => $fontData + [
    'frutiger' => [
      'R' => 'THSarabunNew.ttf',
      'I' => 'THSarabun-Italic.ttf',

    ]
  ],
  'default_font' => 'frutiger'
]);
ob_start();
?>
<h1>BC Game Store</h1>
<div id="project">
  <div><span>ORDER ID</span> # <?= $row['order_id']; ?></div>
  <div><span>EMAIL</span> <a href="mailto:<?=$user['email']?>"><?=$user['email']?></a></div>
  <div class="text-muted mb-1"><span>FULL NAME </span><?= $user['firstname'] . ' ' . $user['lastname'] ?></div>
  <div><span>วันที่สร้าง Order</span> <?=$row['order_create_date'] ?></div>
  <br>
</div>
</header>
<table>
  <tr>
    <th class="left">ชื่อสินค้า</th>
    <th>ราคาต่อชิ้น</th>
    <th>จำนวน</th>
  </tr>
  <?php foreach ($order_details as $data) : ?>
    <tr>
      <td class="left"><?= $data['product_name'] ?> </td>
      <td class="cen"><?= number_format($data['product_price']) ?> </td>
      <td ><?= $data['product_cart_qty'] ?></td>
      <td></td>
    </tr>
      <?php $qty += $data['product_cart_qty']; ?>
  <?php endforeach ?>
  <tr>
    <td></td>
    <td class="cen" class="text-center">รวม</td>
    <td> <?= $qty; ?></td>
  </tr>
  <tr>
    <td></td>
    <td>ยอดรวมทั้งสิ้น</td>
    <td ><?= number_format($row['order_price']) ?> บาท</td>
  </tr>
</table>
<div id="notices">
  <div class="notice">ขอบคุณที่ใช้บริการร้าน BC Game Store</div>
</div>
<footer>
  Invoice was created on a computer and is valid without the signature and seal.
</footer>
<?php
$content = ob_get_contents();
ob_end_clean();
$stylesheet = file_get_contents('style.css');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($content, 2);
$mpdf->Output("order_id_".$row['order_id'].".pdf","D");
exit;
