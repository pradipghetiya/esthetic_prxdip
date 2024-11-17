<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    // Use an absolute path for the upload directory
    $target_dir = __DIR__ . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
    
    // Create the directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["wallpaper"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["wallpaper"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["wallpaper"]["tmp_name"], $target_file)) {
            $image_url = "uploads/" . basename($_FILES["wallpaper"]["name"]);

            $query = "INSERT INTO wallpapers (title, description, category, image_url) VALUES ('$title', '$description', '$category', '$image_url')";
            if (mysqli_query($conn, $query)) {
                echo "Wallpaper uploaded successfully.";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file. Error: " . error_get_last()['message'];
        }
    } else {
        echo "File is not an image.";
    }
} else {
    echo "Invalid request method.";
}

mysqli_close($conn);
?>