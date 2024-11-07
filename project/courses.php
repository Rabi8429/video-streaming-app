<!-- public/courses.php -->
<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<?php include '../includes/header.php'; ?>
<h2>Available Courses</h2>
<ul>
    <?php while ($course = $result->fetch_assoc()): ?>
        <li>
            <?php echo $course['title']; ?> - $<?php echo $course['price']; ?>
            <a href="cart.php?course_id=<?php echo $course['id']; ?>">Add to Cart</a>
        </li>
    <?php endwhile; ?>
</ul>
</body>
</html>

