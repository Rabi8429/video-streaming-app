<?php
// Start session (if using sessions)
session_start();

// Include your database connection file
include ('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password before saving

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

    // Check if the prepare method succeeded
    if ($stmt === false) {
        die('Error preparing the statement: ' . implode(' ', $conn->errorInfo()));
    }

    // Bind the parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    // Execute the statement
    if ($stmt->execute()) {
        // Check if the insertion was successful
        echo "Registration successful!";
        // You can redirect to the login page or set session variables here
    } else {
        // Error during execution
        echo "Error: " . implode(' ', $stmt->errorInfo());
    }
} else {
    // Display the registration form (if not a POST request)
    ?>
    <form action="register.php" method="post">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
    <?php
}
?>

