<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Awesome Wallpapers</title>
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>

    <main>
        <section id="upload-form">
            <h2>Upload New Wallpaper</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="wallpaper" accept="image/*" required>
                <input type="text" name="title" placeholder="Wallpaper Title" required>
                <textarea name="description" placeholder="Wallpaper Description"></textarea>
                <select name="category">
                    <option value="nature">Nature</option>
                    <option value="abstract">Abstract</option>
                    <option value="animals">Animals</option>
                    <!-- Add more categories as needed -->
                </select>
                <button type="submit">Upload</button>
            </form>
        </section>

        <section id="wallpaper-list">
            <!-- List of uploaded wallpapers will be dynamically loaded here -->
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Awesome Wallpapers Admin. All rights reserved.</p>
    </footer>

    <script src="admin-script.js"></script>
</body>
</html>