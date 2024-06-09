<?php
    $host = "localhost";
    $dbname = "mydb";
    $username = "myapp";
    $password = "1234";

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
