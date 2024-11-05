<?php
// Database connection (update with your credentials)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $name = htmlspecialchars($_POST['name']);
    $rating = (int)$_POST['rating']; // Assuming rating is an integer
    $comments = htmlspecialchars($_POST['comments']);
    $course = htmlspecialchars($_POST['course']);
    
    // Check if feedback is submitted
    if (empty($name) || empty($comments)) {
        echo "Please provide your name and feedback.";
    } else {
        // Prepare and bind statement for database insertion
        $stmt = $conn->prepare("INSERT INTO feedback (name, rating, comments, course) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $name, $rating, $comments, $course);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Feedback submitted successfully!";
            
            // Send email confirmation (optional)
            $to = "youremail@example.com";  // Replace with your email
            $subject = "New Feedback Submission";
            $message = "Name: $name\nCourse: $course\nRating: $rating\n\nFeedback:\n$comments";
            $headers = "From: no-reply@yourdomain.com";
            
            // Send the email
            if(mail($to, $subject, $message, $headers)) {
                echo " and email notification sent!";
            } else {
                echo " but failed to send the email notification.";
            }

        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>
