<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php'); // Redirect to login page
    exit;
}

// Database connection parameters
$dsn = 'mysql:host=your_host;dbname=your_database;charset=utf8';
$username = 'your_username';
$password = 'your_password';

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to select all feedback
    $stmt = $pdo->query("SELECT * FROM feedback ORDER BY created_at DESC");
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Feedback</h1>
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="feedback-list">
            <h2>Collected Feedback</h2>
            <?php if (count($feedbacks) > 0): ?>
                <ul>
                    <?php foreach ($feedbacks as $feedback): ?>
                        <li>
                            <strong>Name:</strong> <?php echo htmlspecialchars($feedback['name']); ?><br>
                            <strong>Course:</strong> <?php echo htmlspecialchars($feedback['course']); ?><br>
                            <strong>Rating:</strong> <?php echo htmlspecialchars($feedback['rating']); ?> / 5<br>
                            <strong>Comments:</strong> <?php echo htmlspecialchars($feedback['comments']); ?><br>
                            <strong>Date:</strong> <?php echo htmlspecialchars($feedback['created_at']); ?><br>
                        </li>
                        <hr>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No feedback available.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Your Website Name. All rights reserved.</p>
    </footer>
</body>
</html>
