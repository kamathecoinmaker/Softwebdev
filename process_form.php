<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize input data
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and sanitize input data
    $name = sanitize_input($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = sanitize_input($_POST["subject"]);
    $message = sanitize_input($_POST["message"]);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Invalid email format
        header("Location: error.html");
        exit();
    }

    // Set recipient email address
    $recipient_email = 'your-email@example.com';

    // Set email subject
    $email_subject = "New Contact Form Submission: $subject";

    // Build email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n";
    $email_content .= "Message:\n$message";

    // Set additional headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($recipient_email, $email_subject, $email_content, $headers)) {
        // Email sent successfully
        header("Location: thank_you.html");
        exit();
    } else {
        // Error sending email
        header("Location: error.html");
        exit();
    }
} else {
    // Invalid request method
    header("Location: error.html");
    exit();
}
?>