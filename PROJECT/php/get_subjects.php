<?php
include 'db_connect.php';

$sql = "SELECT subject_id, subject_name FROM subjects";
$result = $conn->query($sql);

$subjects = [];

while ($row = $result->fetch_assoc()) {
    $subjects[] = $row;
}

header('Content-Type: application/json');
echo json_encode($subjects);

$conn->close();
?>
