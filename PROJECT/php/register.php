<?php
include 'db_connect.php'; // connect to the database

// Get form data
$name = $_POST['name'];
$roll_no = $_POST['roll_no'];
$class = $_POST['class'];
$email = $_POST['email'];
$password = $_POST['password'];

// Encrypt password (good practice)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepared statement to insert student
$sql = "INSERT INTO students (name, roll_no, class, email, password) 
        VALUES (?, ?, ?, ?, ?)";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $roll_no, $class, $email, $hashed_password);

// Execute the statement and check if it's successful
if ($stmt->execute()) {
    // Get the last inserted student ID (auto-incremented)
    $student_id = $conn->insert_id;  
    // Redirect to login page with a success message
    echo "<script>alert('Registration successful!  Please login now.'); window.location.href='../login.html';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='../register.html';</script>";
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>
