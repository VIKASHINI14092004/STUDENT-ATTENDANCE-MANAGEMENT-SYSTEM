<?php
session_start(); // ✅ Start session at the top
include 'db_connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM students WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        // ✅ Save student ID and name in session
        $_SESSION['student_id'] = $row['id'];
        $_SESSION['student_name'] = $row['name'];

        // ✅ Redirect same as before (no functionality broken)
        header('Location: ../dashboard.html?id=' . $row['id'] . '&name=' . urlencode($row['name']));
        exit();

    } else {
        echo "<script>alert('Incorrect password!'); window.location.href='../login.html';</script>";
    }

} else {
    echo "<script>alert('No user found with this email!'); window.location.href='../login.html';</script>";
}

$conn->close();
?>
