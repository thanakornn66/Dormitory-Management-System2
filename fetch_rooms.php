<?php
include 'config.php';

$sql = "
    SELECT 
        rooms.room_number, 
        room_types.name AS type_name,
        room_types.price_monthly,
        room_types.price_daily,
        rooms.status
    FROM rooms
    JOIN room_types ON rooms.type_id = room_types.id
";

$result = $conn->query($sql);

$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

header('Content-Type: application/json');
echo json_encode($rooms);
?>
