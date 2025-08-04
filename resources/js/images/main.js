import {
    placeImages,
    confirmDelete,
    loadMoreImages
} from './imageUtils.js';

import {
    addListenersToLoadMore
} from "../loadingUtils.js";

import {
    state,
} from '../state.js';

import {
    Album
} from "./Album.js";

if(initialData.images.length === 0) {

}

const numberOfColumns = Math.ceil(windowWidth/initialData.imageMaxWidth)
Album = new Album(numberOfColumns);
(async ()=>{
  await Album.placeImages(initialData.images.images);
  Album.listenForMore('images');
})();
document.addEventListener('DOMContentLoaded', async () => {
    const images = initialData.images.images;

    if (images.length === 0) {
        const loadingLabel = document.getElementById('loading');
        loadingLabel.textContent = initialData.noImagesText;
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

