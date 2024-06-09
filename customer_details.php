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
            font-size:2vw;
        }
        form {
            text-align: center;
            margin-top: 2vw;
        }
        input[type=text], input[type=tel], input[type=number] {
            display: block;
            margin: 0.5vw auto;
            padding: 0.5vw;
            font-size: 1.5vw;
        }
        input[type=submit] {
            padding: 0.5vw 1vw;
            margin-top: 1vw;
            font-size: 2vw;
        }
        h2 {
            width:100%;
            height:4vw;
            background-color:brown;
            font-family:'Verdana';
            font-weight:bold;
            font-size: 3vw;
            text-align:center;
            color:yellow;
            margin:0;
        }
        .table {
            margin-left: 37vw; 
            border: 0.5vw solid black;
            border-radius: 1.5vw 1.5vw 1.5vw 1.5vw;
            background: whitesmoke;
            width: 24vw;
            height: 24vw;
        }
        .button-container {
            display: flex;
            margin-top: 1vw;
            margin-left: 44.1vw;
        }
        .button {
            font-family:'kaisei-tokumin';
            font-size:2vw;
            width: 10vw;
            padding: 0.1vw;
            cursor: pointer;
            text-align: center;
            background-color: #d3d3d3;
            border: none;
            border-radius: 0.5vw;
            position:absolute;
            left: 
        }
        .button:hover {
            background-color: #c0c0c0;
        }
        .button-container {
            display: flex;
            margin-top: 1vw;
            margin-left: 44.1vw;
        }
        .textbox {
            font-family: 'kaisei-tokumin';
            font-size: 2vw;
            width: 19vw; /* Adjust width to fit a single word */
            text-align: center;
            background-color: #d3d3d3;
            border: none;
            border-radius: 0.5vw;
        }

        .textbox-container {
            justify-content: center; /* Center the textbox */
            margin-top: 1vw;
            align: center;
        }
        .container {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 2vw;
            user-select: none;
        }

        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .checkmark {
            display: inline-block;
            width: 1.5vw;
            height: 1.5vw;
            background-color: #eee;
            border-radius: 50%;
            margin-top: 1vw;
            margin-left: 2vw;
            position: relative;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
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

    $date = new DateTime("now", new DateTimeZone('Asia/Taipei'));
    $stmt = $pdo->prepare("INSERT INTO customerData (cName, phoneNo, transactionOrder, dateOrder) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $phone, $order_type, $date->format('Y-m-d H:i:s')]);
    header("Location: finalizeorder.php");
    exit();
}

echo "<h2>Enter Your Details</h2>
<form method='POST'>
    <div class='table textbox-container'>
    Name: <input type='text' class='textbox' name='name' placeholder='Name' required>
    Phone number: <input type='tel' class='textbox' name='phoneNo' placeholder='Phone Number' required>
    LineID: <input type='text' class='textbox' name='lineid' placeholder='LineID' required>
    <div class='radio-group container'>
        <label><input type='radio' name='order_type' id='dine_in' value='Dine In' required><span class='checkmark'></span> Dine In</label>
        <label><input type='radio' name='order_type' id='take_away' value='Take Away' required><span class='checkmark'></span> Take Away</label>
    </div></div><br>
    <div class='button-container'>
    <input type='submit' class='button' name='save' value='Submit'>
    </div>
</form>";
?>

