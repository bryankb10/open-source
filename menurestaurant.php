<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            margin:0;
            padding:0;
            height:100%;
            background-color:bisque;
            font-size:1vw;
        }
        .menuBar {
            width:100%;
            height:3vw;
            background-color:brown;
            font-size:1.6vw;
            font-family:'Courier New',Courier,monospace;
            font-weight:bold;
            text-align:center;
            text-shadow:0.2vw 0.1vw 0.5vw yellow;
            margin-bottom:1vw;
        }
        ul {
            padding:0.4vw 0;
            margin:0;
        }
        .menuBar li {
            padding:0.25vw 1vw 0.25vw 1vw;
            list-style:none;
            display:inline;
        }
        li:hover{
            color:brown;
            background-color:white;
            cursor:pointer;
        }
        .menuTable {
            padding:1vw 1vw 1vw 1vw;
            float:left;
            margin-left:12.5vw;
            font-size:1vw;
        }
        .menuTable td{
            font-family:'Verdana';
            text-align:center;
            font-weight:bold;
            padding:1vw 2vw 1vw 2vw;
            position: relative;
        }
        tr, th, td{
            padding: 0.2vw 0.5vw 0.2vw 0.5vw;
        }
        .box{
            width:19.5vw;
            height:17.5vw;
            border: 0.1vw solid black;
            border-radius: 1vw;
            margin-top:1.25vw;
            color:white;
            background-color:brown;
            margin-left:50vw;
            flex-direction: column;
            height: 34.3vw;
            display: flex;
        }
        .orderList {
            width:8vw;
            height:1.5vw;
            border: 0.1vw solid black;
            border-radius: 2vw;
            background-color:white;
            margin-left:5.9vw;
            text-align:center;
            font-size:1.3vw;
            font-weight: bold;
            color:darkorange;
        }
        .btn-holder {
            width: 7vw;
            height: 2vw;
            border-radius: 1vw;
            justify-content: center;
            display: inline-block;
            font-size:1vw;
            margin-left:3.1vw;
        }
        .add{
            width: 4vw;
            height: 2vw;
            border: 0.1vw solid black;
            border-radius: 1vw;
            justify-content: center;
            display: inline-block;
            font-size:1vw;
        }
    </style>
</head>
<?php
    session_start();
    include "pdoconnect.php";

    if (isset($_SESSION['history'])) {
        $history = $_SESSION['history'];
    } else {
        $history = array();
    }

    if (isset($_POST["btnadd"])) {
        $nama = $_POST['txtNama'];
        $harga = $_POST['txtHarga'];
        $id = $_POST['txtMenuID'];
        $found = false;
        foreach ($history as $key => $data) {
            if ($data[0] == $nama) {
                $history[$key][2]++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $history[] = array($nama, $harga, 1, $id);
        }

        $_SESSION['history'] = $history;
    }
    
    $query = "SELECT * FROM category";
    $stmt = $pdo->query($query);
    $category = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($category)) {
        echo "<header class='menuBar'><ul>";
        foreach ($category as $row) {
            $name = $row['catName'];
            echo "<li><a href='menurestaurant.php?cat=$name'>".$name."</a></li>";
        }
        echo "</ul></header>";
    }

    if (isset($_GET['cat'])) {
        $cat = $pdo->quote($_GET['cat']);
        $query = "SELECT a.id, a.mName, a.price, a.imagePath FROM menu a JOIN category b ON (a.idCat = b.id) WHERE b.catName = $cat";
        $stmt = $pdo->query($query);
        $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($menu)) {
            echo "<table border='0' class='menuTable'>";
            $i = 0;
            echo "<tr>";
            foreach ($menu as $row) {
                $pic = $row['imagePath'];
                echo "<td> <form method='POST' action=''><a href=http://www.google.com><img src='$pic' style='max-width: 16vw; max-height: 14vw;'></a>"."<br>".$row['mName']."<br>".$row['price']."<br><input type=submit class='add' name='btnadd' value='add'>";
                echo "<input type=hidden name=txtMenuID value='".$row['id']."'>";
                echo "<input type=hidden name=txtNama value='".$row['mName']."'>";
                echo "<input type=hidden name=txtHarga value='".$row['price']."'>";
                echo "</form></td>";
                if ($i == 1) {
                    echo "</tr><tr>";
                }
                $i++;
            }
            echo "</tr></table>";
        }
    }
    
    
    echo "<form method='POST' action = 'summaryrestaurant.php'>";
    echo "<div class='box'>";
    echo "<table border='0' style='border-spacing:1vw; text-align:left;'>";
    echo "<div class='orderList'>";
    echo "Order List";
    echo "</div>";
    foreach ($history as $h) {
        echo "<tr style=font-size:1vw;>";
        echo "<td>".$h[0]."</td><td>$".$h[1]."</td><td>".$h[2]."x</td></tr>";
    }
    
    echo "</div>";

    echo "<div class=btn-holder>";
    echo "<input type='submit' class='btn-holder' name='checkout' value='Checkout' style= 'margin-top:33.5vw;'>";
    echo "</div>";
    echo "</table>";
    echo "</form>";
?>
