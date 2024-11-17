document.addEventListener('DOMContentLoaded', () => {
    const gallery = document.getElementById('gallery');

    // Fetch wallpapers from the server
    fetch('get_wallpapers.php')
        .then(response => response.json())
        .then(wallpapers => {
            wallpapers.forEach(wallpaper => {
                const wallpaperElement = createWallpaperElement(wallpaper);
                gallery.appendChild(wallpaperElement);
            });
        })
        .catch(error => console.error('Error fetching wallpapers:', error));

    function createWallpaperElement(wallpaper) {
        const element = document.createElement('div');
        element.classList.add('wallpaper-item');
        element.innerHTML = `
            <img src="${wallpaper.image_url}" alt="${wallpaper.title}">
            <div class="info">
                <h3>${wallpaper.title}</h3>
                <p>${wallpaper.description}</p>
                <a href="download.php?id=${wallpaper.id}" class="download-btn">Download</a>
            </div>
        `;
        return element;
    }
});
