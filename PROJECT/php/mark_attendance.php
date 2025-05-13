<?php
session_start();  // Start the session


// Continue with your existing code...

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // Use uppercase 'POST'
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    // Simple validation
    if (empty($student_id) || empty($subject_id) || empty($date) || empty($status)) {
        echo "<script>
                alert('Please fill all fields properly!');
                window.history.back();
              </script>";
        exit();
    }

    // Prepare & insert
    $stmt = $conn->prepare("INSERT INTO attendance (student_id, subject_id, date, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $student_id, $subject_id, $date, $status);

    if ($stmt->execute()) {
        // ✅ Successful insert: Show popup then redirect
        echo " Attendance marked successfully!✅";
    } else {
        // ❌ Error case
        echo "<script>
                alert('Error saving attendance: " . $stmt->error . "');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
