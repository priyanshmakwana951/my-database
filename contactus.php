<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Enter your MySQL root password here if you have one
$dbname = "taxi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");

    // Check if prepare() was successful
    if ($stmt === false) {
        // Handle the error (e.g., log it, display an error message)
        echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
        $conn->close();
        exit; // Stop execution
    }

    $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!');</script>";
    } else {
        echo "<script>alert('Error sending message: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>

    <style>
        /* Your CSS styles here (same as before) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, textarea {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="text"], input[type="email"], input[type="tel"] {
            height: 40px;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .contact-info {
            margin-top: 30px;
        }

        .contact-info div {
            margin-bottom: 10px;
        }

        .contact-info i {
            margin-right: 10px;
        }

        .contact-info a {
            color: #4CAF50;
            text-decoration: none;
        }
        .footer{
            background-color: black;
            padding: 10px;
        }

    </style>
</head>
<body>

    <header>
        <h1>Contact Us</h1>
        <p>We're here to help! Fill out the form below or get in touch through our contact info.</p>
    </header>

    <div class="container">
        <h2>City Taxi</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="tel" name="phone" placeholder="Your Phone Number">
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>

        <div class="contact-info">
            <h3>Our Contact Information</h3>
            <div>
                <i class="fas fa-map-marker-alt"></i>
                <strong>Address:</strong> 1234 Main Street, City, Country
            </div>
            <div>
                <i class="fas fa-phone-alt"></i>
                <strong>Phone:</strong> +123 456 7890
            </div>
            <div>
                <i class="fas fa-envelope"></i>
                <strong>Email:</strong> <a href="mailto:info@example.com">info@example.com</a>
            </div>
        </div>
    </div>

    <div class="footer">
        <center><p style="color: white;">&copy; 2025 Company Name. All Rights Reserved.</p></center>
    </div>

</body>
</html>