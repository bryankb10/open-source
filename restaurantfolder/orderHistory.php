<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: bisque;
            font-family: 'Verdana', sans-serif;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: brown;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
</html>
<?php
include 'pdoconnect.php';

// Retrieve order history data
$query = "
    SELECT 
        b.id AS orderID, 
        b.cName AS customerName, 
        GROUP_CONCAT(CONCAT(a.quantityOrder, 'x ', c.mName) SEPARATOR ', ') AS itemsPurchased,
        MAX(a.price) AS totalPrice,
        b.dateOrder AS dateOrder
    FROM orderDetail a
    JOIN customerData b ON a.idOrder = b.id
    JOIN menu c ON a.idMenu = c.id
    GROUP BY b.id, b.cName, b.dateOrder
    ORDER BY b.dateOrder DESC
";
$stmt = $pdo->query($query);
$orderHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<h2>Order History</h2>";
if (!empty($orderHistory)) {
    foreach ($orderHistory as $order) {
        echo "Order ID: " . $order['orderID'] . "<br>";
        echo "Customer Name: " . $order['customerName'] . "<br>";
        echo "Items Purchased: " . $order['itemsPurchased'] . "<br>";
        echo "Total Price: $" . $order['totalPrice'] . "<br>";
        echo "Date of Transaction: " . $order['dateOrder'] . "<br><br>";
    }
} else {
    echo "No order history found.\n";
}
?>

