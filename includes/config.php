<?php

    // Edit these to work for your DataBase
    $host = "localhost";
    $username = "root";
    $password = "***REMOVED***";
    $dbname = "cs424";

try {
    // Create a new PDO instance with a DSN (Data Source Name)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Set some common PDO attributes (error reporting mode and fetch mode)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Enable exceptions on errors
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  // Set the default fetch mode to associative arrays

    // echo "Connected successfully to the database!";
} catch (PDOException $e) {
    // If connection fails, display the error message
    echo "Connection failed: " . $e->getMessage();
}


