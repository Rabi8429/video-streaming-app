<?php
session_start();  // Start the session to access session variables

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirect to login page if the user is not logged in
    exit();
}

// Include the database connection
include('includes/db.php');

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // User found, display their details
    $user_name = $user['name'];
    $user_email = $user['email'];
} else {
    // If the user doesn't exist in the database (which should not happen)
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS here -->
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
        <p>Email: <?php echo htmlspecialchars($user_email); ?></p>
        
        <!-- Add any additional content for the user, such as courses, purchase options, etc. -->
        <h2>Available Courses</h2>
        <ul>
            <!-- Example of static courses; you can dynamically fetch from the database -->
            <li>Course 1 - $20</li>
            <li>Course 2 - $25</li>
            <li>Course 3 - $30</li>
        </ul>
        
        <a href="logout.php">Logout</a> <!-- Link to log out -->
    </div>
</body>
</html>

