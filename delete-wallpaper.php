<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        // Get the image URL before deleting the record
        $query = "SELECT image_url FROM wallpapers WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $image_url = $row['image_url'];

        // Delete the record from the database
        $query = "DELETE FROM wallpapers WHERE id = $id";
        if (mysqli_query($conn, $query)) {
            // Delete the image file
            if (file_exists($image_url)) {
                unlink($image_url);
            }
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No ID provided']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

mysqli_close($conn);
?>