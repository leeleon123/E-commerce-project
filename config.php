<!doctype html>
<?php

$servername = "localhost";  
$username_db = "root";      
$password_db = "";          
$dbname = "brewit31";       
// Try to create a connection using PDO.
// This is the "bridge" between PHP and MySQL.
try {
    // PDO constructor: Connects to MySQL with the details above.
    
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
    
    // Set error mode to "exception" – if something goes wrong (e.g., bad query), it throws an error you can catch.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
// If connection fails (e.g., MySQL stopped, wrong password, DB doesn't exist), catch the error.
} catch(PDOException $e) {
    // Stop the script and show the error message (e.g., "Connection failed: Access denied").
  
    die("Connection failed: " . $e->getMessage());
}
?>