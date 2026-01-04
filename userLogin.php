<!doctype html>
<?php
include 'config.php';
session_start();

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Get the login credential (could be username or email)
    $login_credential = $_POST['username']; // Form sends 'username' field
    $password = $_POST['password'];

    try {
        // Check if the credential looks like an email or username
        $field_name = (filter_var($login_credential, FILTER_VALIDATE_EMAIL)) ? 'email' : 'username';
        
        // Get user from DB using PDO
        $stmt = $pdo->prepare("SELECT id, username, password FROM user31 WHERE $field_name = ?");
        $stmt->execute([$login_credential]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: home1.html"); // Redirect to homepage
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        echo "Login failed. Please try again.";
    }
}
?>
