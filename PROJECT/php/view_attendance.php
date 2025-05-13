<?php
header('Content-Type: application/json');  // So browser knows it's JSON

include 'db_connect.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    $query = "
        SELECT attendance.date, subjects.subject_name, attendance.status 
        FROM attendance 
        JOIN subjects ON attendance.subject_id = subjects.subject_id 
        WHERE attendance.student_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $attendance = [];
    while ($row = $result->fetch_assoc()) {
        $attendance[] = $row;
    }

    echo json_encode($attendance);  // ✅ Send clean JSON

    $stmt->close();
} else {
    echo json_encode(["error" => "Student ID missing"]);
}

$conn->close();
?>
