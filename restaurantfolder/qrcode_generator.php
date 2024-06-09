<?php
include 'phpqrcode/qrlib.php';
$ipAddress = $_SERVER['SERVER_ADDR'];

$content = 'http://'. $ipAddress .'/restaurantfolder/menurestaurant.php';

QRcode::png($content);

?>
