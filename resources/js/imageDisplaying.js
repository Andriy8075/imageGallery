import {
    placeImages,
    confirmDelete,
    addListenersToLoadMore, loadMoreImages
} from './imageUtils.js';

import {
    state,
} from './state.js';

const windowWidth = window.innerWidth
const countOfCols = Math.ceil(windowWidth/initialData.imageMaxWidth)
for (let i = 0; i<countOfCols; i++) {
    const colDiv = document.createElement('div');
    colDiv.classList.add('col');
    colDiv.id = `col-${i}`;
    colDiv.style.margin = '8px';
    colDiv.style.height = 'min-content'
    const imageContainer = document.getElementById('image-container')
    imageContainer.appendChild(colDiv);
}

state.hasMorePages = initialData.images.hasMorePages;
document.addEventListener('DOMContentLoaded', async () => {
    const images = initialData.images.images;

    if (images.length === 0) {
        const loadingLabel = document.getElementById('loading');
        loadingLabel.textContent = initialData.images.noImagesText;
        loadingLabel.style.display = 'block';
        return;
    }

    await placeImages(images);

    addListenersToLoadMore('images', loadMoreImages)
});

if(initialData.query === 'uploaded') {
    const deleteConfirmButton = document.getElementById('delete-confirm-button');
    deleteConfirmButton.addEventListener('click', confirmDelete)
}

