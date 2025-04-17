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
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // Store the password in plain text

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert('SIGNUP COMPLETE');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fc;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.gfg-logo {
    background: url("logo.jpeg"); /* Ensure "logo.jpeg" is in the same directory */
    background-size: cover;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto;
    box-shadow: 0px 0px 2px #5f5f5f, 0px 0px 0px 5px #ecf0f3,
        8px 8px 15px #a7aaaf, -8px -8px 15px #ffffff;
}

.signup-container {
    background-color: #fff;
    padding: 40px;
    border-radius: 35px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

.signup-header {
    text-align: center;
    margin-bottom: 20px;
}

.signup-header h1 {
    font-size: 24px;
    color: #333;
}

.signup-header p {
    color: #666;
    font-size: 14px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Ensures padding and border are included in the element's total width and height */
}

.cta-btn {
    width: 100%;
    padding: 12px;
    background-color: #007BFF;
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

.cta-btn:hover {
    background-color: #0056b3;
}

.social-login {
    text-align: center;
    margin-top: 20px;
}

.social-login button {
    background-color: #ddd;
    border: none;
    padding: 10px 20px;
    margin: 5px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

.social-login button:hover {
    background-color: #ccc;
}

/* Optional: Add some spacing between form elements */
form input {
    margin-bottom: 15px;
}
        /* ... (Your CSS remains the same) ... */
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="gfg-logo"></div>
        <div class="signup-header">
            <h1>City Taxi</h1>
            <p>Sign-up Page</p>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="cta-btn">Create Account</button>
        </form>
        <div class="social-login">
            <button>Sign up with Google</button>
            <button>Sign up with Facebook</button>
        </div>
    </div>
</body>
</html>