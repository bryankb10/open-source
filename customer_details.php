<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <style>
        body {
            margin:0;
            padding:0;
            height:100%;
            background-color:bisque;
            display: flex;
            justify-content: center;
            text-align:center;
            flex-direction: column;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        input[type=text], input[type=tel], input[type=number] {
            display: block;
            margin: 10px auto;
            padding: 10px;
        }
        input[type=submit] {
            padding: 10px 20px;
            margin-top: 20px;
        }
        h2 {
            width:100%;
            height:40px;
            background-color:brown;
            font-family:'Verdana';
            font-weight:bold;
            text-align:center;
            color:yellow;
            margin:0;
        }
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
