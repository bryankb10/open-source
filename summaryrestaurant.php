<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
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


