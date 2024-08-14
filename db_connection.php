<?php
// db_connection.php

$dsn = 'mysql:host=localhost;dbname=pre_entry'; // Replace with your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

//testuser -- password123
