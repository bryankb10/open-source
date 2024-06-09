<?php
include 'phpqrcode/qrlib.php';
$ipAddress = $_SERVER['SERVER_ADDR'];

$content = 'http://'. $ipAddress .'/open-source/menurestaurant.php';

QRcode::png($content);

?>
