<?php
session_start();

if (isset($_SESSION['student_id']) && isset($_SESSION['student_name'])) {
    echo json_encode([
        'student_id' => $_SESSION['student_id'],
        'student_name' => $_SESSION['student_name']
    ]);
} else {
    // ❌ No session found (user not logged in)
    echo json_encode(['error' => 'Not logged in']);
}
?>
