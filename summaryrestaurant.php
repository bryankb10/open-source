<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin:0;
            padding:0;
            background-color:bisque;
            display: flex;
            justify-content: center;
            text-align:center;
            flex-direction: column;
        }
        .container {
            text-align: center;
            margin-top: 1.8vw;
        }
        h2 {
            height:4vw;
            background-color:brown;
            font-family:'Courgette';
            font-style: italic;
            text-align:center;
            color:yellow;
            margin:0;
            font-size: 3vw;
            text-shadow: 0.2vw 0.2vw 0.3vw rgba(0, 0, 0, 0.5);
        }
        table {
            border-collapse: collapse;
            margin: 1.5vw 37vw 0 37vw;
            text-align:center;
            background-color:pink;
            font-family:'inter', sans-serif;
            border: 0.05vw solid black;
            box-shadow: 0.5vw 0.5vw 0.25vw rgba(0, 0, 0, 0.5);
        }
        tr, th, td{
            padding: 0.5vw;
            text-align: left;
            color: grey;
            font-size: 1.3vw;
        }
        td {
            color: black;
            border-bottom: 0.1vw solid black;
            position: relative;
        }
        .button-return {
            width: 7vw;
            height: 2vw;
            display: inline-block;
            background-color: #000;
            color: #FFF;
            font-family: 'Inter', sans-serif;
            text-align: center;
            line-height: 2vw;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-checkout {
            width: 7vw;
            height: 2vw;
            display: inline-block;
            background-color: #FFF;
            color: #000;
            font-family: 'Inter', sans-serif;
            text-align: center;
            line-height: 2vw;
            border-radius: 5px;
            cursor: pointer;
        }
            
        .container {
            display: flex;
            justify-content: center;
            gap: 2.5vw;
            cursor: pointer;
            font-size: 1vw;
            user-select: none;
        }

        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }
        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }
    </style>
</head>
</html>
<?php
session_start();
include 'pdoconnect.php';

if (isset($_SESSION['history']) && !empty($_SESSION['history'])) {
        echo "<h2>Order Summary</h2>";
        echo "<table>";
        echo "<tr><th>Item</th><th>Quantity</th><th>Price</th></tr>";
        $total = 0;
        foreach ($_SESSION['history'] as $item) {
            $total += $item[1] * $item[2];
            echo "<tr>";
            echo "<td>".$item[0]."</td>";
            echo "<td>".$item[2]."</td>";
            echo "<td>$".$item[1] * $item[2]."</td>";
            echo "</tr>";
        }
        
        echo '<tr><th colspan="2">Total</th><th>$' . $total . '</th></tr>';
        echo "</table>";
        echo "<div class='container'>";
        echo "<form method='POST' action='customer_details.php'>"; // Added action attribute
        echo "<label><input type='submit' name='checkout' value='Checkout'><span class='button-checkout'>Checkout</span></label>";
        echo "</form>";
        echo "<form method='POST' action='menurestaurant.php'>"; // Added action attribute
        echo "<label><input type='submit' name='return' value='Return'><span class='button-return'>Return</span></label>";
        echo "</form></div>";
} else {
    header("Location: finalizeorder.php"); // Redirect to finalizeorder.php if no history is found
    exit();
}
?>
