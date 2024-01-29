<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store validation errors
    $errors = [];

    // Validate and sanitize input data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $website = filter_var($_POST["website"], FILTER_SANITIZE_URL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Check for missing fields
    if (empty($name) || empty($email) || empty($message)) {
        $errors[] = "Please fill in all required fields.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Additional validation and security measures can be added here

    // If there are errors, display them and exit
    if (!empty($errors)) {
        echo "<h2>Error Posting Comment:</h2>";
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
        exit();
    }

    // Process and store the comment data as needed (e.g., save to a database)

    // For now, let's just display the submitted data
    echo "<h2>Comment Posted Successfully:</h2>";
    echo "<p>Name: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Website: $website</p>";
    echo "<p>Message: $message</p>";
} else {
    // Invalid request method
    header("Location: error.html");
    exit();
}
?>
