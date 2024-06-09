<?php
include 'phpqrcode/qrlib.php';
$ipAddress = $_SERVER['SERVER_ADDR'];

$content = 'http://'. $ipAddress .'/menurestaurant.php';

QRcode::png($content);

?>
