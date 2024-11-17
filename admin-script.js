document.addEventListener('DOMContentLoaded', () => {
    const wallpaperList = document.getElementById('wallpaper-list');

    // Fetch wallpapers from the server
    fetch('get_wallpapers.php')
        .then(response => response.json())
        .then(wallpapers => {
            wallpapers.forEach(wallpaper => {
                const wallpaperElement = createAdminWallpaperElement(wallpaper);
                wallpaperList.appendChild(wallpaperElement);
            });
        })
        .catch(error => console.error('Error fetching wallpapers:', error));

    function createAdminWallpaperElement(wallpaper) {
        const element = document.createElement('div');
        element.classList.add('admin-wallpaper-item');
        element.innerHTML = `
            <img src="${wallpaper.image_url}" alt="${wallpaper.title}">
            <h3>${wallpaper.title}</h3>
            <p>Category: ${wallpaper.category}</p>
            <button onclick="deleteWallpaper(${wallpaper.id})">Delete</button>
        `;
        return element;
    }
});

function deleteWallpaper(id) {
    if (confirm('Are you sure you want to delete this wallpaper?')) {
        fetch(`delete_wallpaper.php?id=${id}`, { method: 'DELETE' })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Wallpaper deleted successfully');
                    location.reload();
                } else {
                    alert('Error deleting wallpaper');
                }
            })
            .catch(error => console.error('Error deleting wallpaper:', error));
    }
}