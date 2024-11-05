<?php
session_start();

// Check if user is an admin
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: login.php"); // Redirect to login page if not an admin
    exit();
}

// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>
</head>
<body>
    <h1>Feedback from Users</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Rating</th>
            <th>Comments</th>
            <th>Course</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['rating']) . "</td>
                        <td>" . htmlspecialchars($row['comments']) . "</td>
                        <td>" . htmlspecialchars($row['course']) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No feedback found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
