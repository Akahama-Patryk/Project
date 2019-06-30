<?php

include('../App/libs/phpqrcode/qrlib.php');
include_once('../App/Autoloader.php');

$data = new Coupon();
$dataCoupon = $data->GetCoupon($_GET['Q_ID']);

// how to build raw content - QRCode with simple Business Card (VCard)

$tempDir = $_SERVER['DOCUMENT_ROOT'] . '/Projects2019/helden/Project/QR-code/img/';
$rng = rand(00000000, 99999999999);
// here our data
foreach ($dataCoupon as $data) {
    $couponcode = $data['coupon_code'];
    $valid = $data['expire_date'];

// we building raw data
    $codeContents = 'BEGIN:VCARD' . "\n";
    $codeContents .= 'FN:'.'Coupon code:'.$couponcode."\n";
    $codeContents .= 'TEL;WORK;VOICE:'.'Valid until:'.$valid."\n";
    $codeContents .= 'END:VCARD';
}
// generating
QRcode::png($codeContents, $tempDir.$rng.'.png', QR_ECLEVEL_L, 3);

// displaying
echo "<td><img class='img-thumbnail align-self-center' style='width:100px;height:100px;'
                             alt='Missing image data' src=QR-code/img/" . $rng . ".png></td>";


