<?php
require_once 'db_connection.php';

$query = "SELECT * FROM wallpapers ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

$wallpapers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $wallpapers[] = $row;
}

header('Content-Type: application/json');
echo json_encode($wallpapers);

mysqli_close($conn);
?>