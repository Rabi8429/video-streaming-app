<?php
session_start(); // Start the session to handle login session

// Include the database connection file
include ('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to check if email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    // Fetch user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and verify password
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start the session
        $_SESSION['user_id'] = $user['id'];  // Store user ID in session
        $_SESSION['user_name'] = $user['name'];  // Optionally store user name
        
        // Redirect to a dashboard or courses page
        header("Location: dashboard.php");
        exit;
    } else {
        // Login failed
        $error_message = "Invalid email or password.";
    }
}
?>

<!-- HTML Form for login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php
    // Show error message if login failed
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <form action="login.php" method="POST">
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>

