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
            justify-content: center;
            text-align:center;
            flex-direction: column;
        }
        h1 {
            margin: 250px 250px 250px 250px;
            font-family:'Verdana';
            text-align:center;
            font-weight:bold;
            font-size:30px;
        }
    </style>
</head>
<body>
<?php
    session_start();
    include 'pdoconnect.php';

    if (isset($_SESSION['history']) && !empty($_SESSION['history'])) {
        echo "<h1>THANK YOU</h1>";
        $newstmt = $pdo->prepare("INSERT INTO orderDetail (idMenu, idOrder, price, quantityOrder) VALUES (?, ?, ?, ?)");
        $total = 0;
        $quantity = 0;
        $query = "SELECT MAX(id) as max_id FROM customerData"; // Modify the query to retrieve the 'id'
        $stmt = $pdo->query($query);
        $customerData = $stmt->fetch(PDO::FETCH_ASSOC);
        $customerID = $customerData['max_id']; // Retrieve the 'id' from the fetched result
        foreach ($_SESSION['history'] as $item) {
            $total += $item[1] * $item[2];
            $quantity += $item[2];
            $newstmt->execute([$item[3], $customerID, $total, $quantity]); // Use the retrieved 'id'
        }
        $newquery = "SELECT * FROM customerData ORDER BY id DESC LIMIT 1";
        $newstmt = $pdo->query($newquery);
        $customerData = $newstmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($customerData)) {
            echo "Name: ".$customerData['cName']."<br>";
            echo "Queue No.: ".$customerData['id']."<br>";
            echo $customerData['transactionOrder']."<br>";
            echo "Total Price: $".$total."<br><br>";
            // Destroy the session after displaying the order details
            session_destroy();
        } else {
            echo "<h2>Your order history is empty.</h2>";
        }
        echo "<form method='POST' action='menurestaurant.php'>"; // Added action attribute
        echo "<input type='submit' name='checkout' value='Return'>";
        echo "</form>";
    }
    else {
        header("Location: menurestaurant.php");
        exit();
    }
    ?>

