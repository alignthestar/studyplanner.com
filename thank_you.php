<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Feedback</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Thank You for Your Feedback!</h1>
    </header>

    <main>
        <section>
            <h2>Your Feedback</h2>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($_GET['name']); ?></p>
            <p><strong>Rating:</strong> <?php echo htmlspecialchars($_GET['rating']); ?> / 5</p>
            <p><strong>Comments:</strong> <?php echo htmlspecialchars($_GET['comments']); ?></p>
        </section>

        <section>
            <h3>View All Feedback</h3>
            <p><a href="view_feedback.php">Click here to see all feedback</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Your Website Name. All rights reserved.</p>
    </footer>
</body>
</html>
