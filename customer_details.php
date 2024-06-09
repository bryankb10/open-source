<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <style>
        
    </style>
</head>
</html>
<?php
session_start();
include 'pdoconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $name = $_POST['name'];
    $phone = $_POST['phoneNo'];
    $order_type = $_POST['order_type'];

    $date = new DateTime("now", new DateTimeZone('UTC'));
    $stmt = $pdo->prepare("INSERT INTO customerData (cName, phoneNo, transactionOrder, dateOrder) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $phone, $order_type, $date->format('Y-m-d H:i:s')]);
    header("Location: finalizeorder.php");
    exit();
}

echo "<h2>Enter Your Details</h2>
<form method='POST'>
    Name: <input type='text' name='name' placeholder='Name' required>
    Phone number: <input type='tel' name='phoneNo' placeholder='Phone Number' required>
    LineID: <input type='text' name='lineid' placeholder='LineID' required>
    <div class='radio-group'>
        <label><input type='radio' name='order_type' id='dine_in' value='Dine In' required> Dine In</label>
        <label><input type='radio' name='order_type' id='take_away' value='Take Away' required> Take Away</label>
    </div><br>
    <input type='submit' name='save' value='Submit'>
</form>";
?>
