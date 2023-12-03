<?php
// Database configuration
$dbHost     = "localhost";
$dbName     = "authentication";
$dbUsername = "root";
$dbPassword = "";

try {
    // Create a new PDO instance
    $dsn = "mysql:host=$dbHost;dbname=$dbName";
    $db = new PDO($dsn, $dbUsername, $dbPassword);

    // Set PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Connection successful
  //  echo "Connected to the database successfully.";
} catch (PDOException $e) {
    // Connection failed
    die("Connection failed: " . $e->getMessage());
}
?>
