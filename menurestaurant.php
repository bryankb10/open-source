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
        }
        .menuBar {
            width:100%;
            height:40px;
            background-color:brown;
            font-size:18px;
            font-family:'Courier New',Courier,monospace;
            font-weight:bold;
            text-align:center;
            text-shadow:4px 2px 10px yellow;
        }
        ul {
            padding:8px 0px;
            margin:0px;
        }
        .menuBar li {
            padding:5px 20px 5px 20px;
            list-style:none;
            display:inline;
        }
        li:hover{
            color:brown;
            background-color:white;
            cursor:pointer;
        }
        .menuTable {
            float:left;
            margin-left:250px;
        }
        .menuTable td {
            font-family:'Verdana';
            text-align:center;
            font-weight:bold;
            font-size:20px;
            padding:20px 50px 20px 50px;
        }
        .box{
            width:250px;
            height:350px;
            border: 2px solid black;
            border-radius: 10pt;
            margin-top:25px;
            color:white;
            background-color:brown;
            margin-left:1000px;
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
                echo "<td> <form method='POST' action=''><a href=http://www.google.com><img src='$pic' style='max-width: 200px; max-height: 200px;'></a>"."<br>".$row['mName']."<br>".$row['price']."<br><input type=submit name='btnadd' value='add'>";
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
    echo "<div class='orderList'>";
    echo "   <h2>Order List</h2>";
    echo "</div>";
    echo "<form method='POST' action = 'summaryrestaurant.php'>";
    echo "<div class='box'>";
    echo "<table border='0' style='border-spacing:5pt; text-align:center;'>";
    foreach ($history as $h) {
        echo "<tr style=font-size:18px;>";
        echo "<td>".$h[0]."</td><td>$".$h[1]."</td><td>".$h[2]."x</td></tr>";
    }
    echo "</table>";
    echo "<div class=btn-holder>";
    echo "<input type='submit' name='checkout' value='Checkout'>";
    echo "</div>";
    echo "</div>";
    echo "</form>";
?>
