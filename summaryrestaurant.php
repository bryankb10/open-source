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
            height:100%;
            background-color:bisque;
            display: flex;
            justify-content:center;
            text-align:center;
            flex-direction: column;
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
        table {
            border-collapse: collapse;
            margin: 30px 500px 0 500px;
            text-align:center;
        }
        table, th, td {
            border: 1px solid black;
            text-align:center;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        form {
            text-align: center;
            margin-top: 20px;
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
        echo "<form method='POST' action='customer_details.php'>"; // Added action attribute
        echo "<input type='submit' name='checkout' value='Checkout'>";
        echo "</form>";
} else {
    header("Location: finalizeorder.php"); // Redirect to finalizeorder.php if no history is found
    exit();
}
?>


