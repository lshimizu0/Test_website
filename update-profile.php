<?php
// Database connection settings
$host = 'localhost';
$db = '';
$user = '';
$pass = '';

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize inputs
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password']; // Will hash if not empty
    $preferred_name = trim($_POST['preferred_name']);
    $notes = trim($_POST['notes']);

    // Prepare the SQL statement
    $sql = "UPDATE users SET username = :username, email = :email, preferred_name = :preferred_name, notes = :notes";

    if (!empty($password)) {
        $sql .= ", password = :password";
    }

    // Prepare statement
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':preferred_name', $preferred_name);
    $stmt->bindParam(':notes', $notes);

    if (!empty($password)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile. Please try again.";
    }
}
?>
