import {
    placeImages,
    loadImagesIfNeeded,
    loadMoreImages,
    confirmDelete
} from './imageUtils.js';

import {
    state
} from './state.js';

const windowWidth = window.innerWidth
const countOfCols = Math.ceil(windowWidth/initialData.imageLoadingConfig.image_max_width)
for (let i = 0; i<countOfCols; i++) {
    const colDiv = document.createElement('div');
    colDiv.classList.add('col');
    colDiv.id = `col-${i}`;
    colDiv.style.marginRight = '16px';
    colDiv.style.height = 'min-content'
    const imageContainer = document.getElementById('image-container')
    imageContainer.appendChild(colDiv);
}


state.hasMorePages = initialData.images.hasMorePages;
document.addEventListener('DOMContentLoaded', async () => {
    const images = initialData.images.images;

    if (images.length === 0) {
        const loadingLabel = document.getElementById('loading');
        loadingLabel.textContent = initialData.noImagesMessage;
        loadingLabel.style.display = 'block'; // Show the message
        return;
    }

    await placeImages(images);
    await loadImagesIfNeeded();

    let isLoading = false;

    window.addEventListener('scroll', async () => {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight;
        const clientHeight = document.documentElement.clientHeight;

        // Check if near the bottom of the page
        if (!isLoading && scrollTop + clientHeight >= scrollHeight - 100) {
            if (state.hasMorePages) {
                isLoading = true;
                await loadMoreImages();
                isLoading = false;
            }
        }
    });
});
if(initialData.mine) {
    const deleteConfirmButton = document.getElementById('delete-confirm-button');
    deleteConfirmButton.addEventListener('click', confirmDelete)
}

