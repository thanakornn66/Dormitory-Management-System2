<?php
include 'config.php';

$sql = "SELECT id, name FROM room_types";
$result = $conn->query($sql);

$types = [];
while ($row = $result->fetch_assoc()) {
    $types[] = $row;
}

header('Content-Type: application/json');
echo json_encode($types);
?>
