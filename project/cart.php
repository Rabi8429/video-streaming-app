<!-- public/cart.php -->
<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$course_id = $_GET['course_id'] ?? null;

if ($course_id) {
    $sql = "SELECT * FROM courses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $course = $stmt->get_result()->fetch_assoc();
}
?>

<?php include '../includes/header.php'; ?>
<h2>Your Cart</h2>
<p>Course: <?php echo $course['title']; ?></p>
<p>Price: $<?php echo $course['price']; ?></p>
<a href="payment.php">Proceed to Payment</a>
</body>
</html>

