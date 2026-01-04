<!doctype html>
<?php
include 'config.php';
session_start();

// Only process registration if it's a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Collect form values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Insert into database using PDO
        $stmt = $pdo->prepare("INSERT INTO user31 (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);

        echo "Registration successful! <a href='Login.html'>Login here</a>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry error
            echo "⚠️ Username or Email already exists!";
        } else {
            echo "Registration failed: " . $e->getMessage();
        }
    }
}
?>
