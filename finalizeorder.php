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
            flex-direction: column;
        }
        h1 {
            margin: 3vw 25vw 1vw 25vw;
            font-family:'kaisei-tokumin';
            text-align:center;
            font-weight:400;
            font-size: 3.5vw;
        }
        h2 {
            margin: 2.5vw 0vw 2vw 3.5vw;
            font-family:'kaisei-tokumin';
            font-weight:300;
            font-size:4vw;
        }
        h3 {
            width:100%;
            height:4vw;
            margin:0;
            padding: 0;
            font-family:'courgette';
            background-color:brown;
            text-align:center;
            color:yellow;
            font-style:italic;
            font-weight:400;
            font-size:3vw;
        }
        
        .text1 {
            margin-left: 2.6vw;
            font-family:'kaisei-tokumin';
            font-size:2vw;
            padding: 0;
            height:100%;
            display: flex;
            justify-content: left;
            flex-direction: column;
        }
        .text2 {
            margin-top: 1.5vw;
            margin-left: 1vw;
            font-family:'kaisei-tokumin';
            font-size:2vw;
            font-style:bold;
            padding: 0;
            height:100%;
            display: flex;
            justify-content: left;
            flex-direction: column;
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
        .table1 {
            margin-left: 37vw; 
            border: 0.5vw solid black;
            border-radius: 1.5vw 1.5vw 0vw 0vw;
            background: whitesmoke;
            width: 24vw;
            height: 24vw;
        }
        .table2 {
            margin-left: 36.99vw; 
            border-radius: 0vw 0vw 1.5vw 1.5vw;
            background: whitesmoke;
            width: 24.32vw;
            height: 4vw;
        }
        .totalPrice {
            position: absolute;
            text-align: right;
        }
    </style>
</head>
<body>
<?php
    session_start();
    include 'pdoconnect.php';

    if (isset($_SESSION['history']) && !empty($_SESSION['history'])) {
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
            echo "<h3>Receipt</h3><br>";
            echo "<div class='table1'>";
            echo "<h2>No. ".$customerData['id']."</h2><br>";
            echo "<div class='text1'>Name: ".$customerData['cName']."<br><br><br>";
            echo $customerData['transactionOrder']."<br></div>";
            echo "</div>";
            echo "<div class='table2'>";
            echo "<div class='text2 totalPrice'>Total Price: $".$total."<br><br></div>";
            echo "<img src='receipt.png' style='width:102.5%'>";
            echo "</div>";
            // Destroy the session after displaying the order details
            session_destroy();
        } else {
            echo "<h2>Your order history is empty.</h2>";
        }
        echo "<h1>THANK YOU</h1>";
        echo "<div class='button-container'>";
        echo "<form method='POST' action='menurestaurant.php'>"; // Added action attribute
        echo "<input type='submit' class='button' name='checkout' value='Return'>";
        echo "</form>";
        echo "</div>";
    } else {
        header("Location: menurestaurant.php");
        exit();
    }
?>
</body>
</html>
