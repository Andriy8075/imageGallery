import {
    placeImages,
    loadImagesIfNeeded,
    loadMoreImages,
} from './imageUtils.js';

import {
    heights,
} from './state.js';

const windowWidth = window.innerWidth
const countOfCols = Math.ceil(windowWidth/initialData.imageLoadingConfig.image_max_width)
for (let i = 0; i<countOfCols; i++) {
    const colDiv = document.createElement('div');
    colDiv.classList.add('col');
    colDiv.id = `col-${i}`;
    colDiv.style.marginRight = '16px';
    const imageContainer = document.getElementById('image-container')
    imageContainer.appendChild(colDiv);
    heights[i] = 0;
}


let hasMorePages = initialData.images.hasMorePages;
$(document).ready(function () {
    (async () => {
        const images = initialData.images.images;
        await placeImages(images, heights);
        await loadImagesIfNeeded();

        let isLoading = false;

        $(window).scroll(async function () {
            if (!isLoading && $(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                if (hasMorePages) {
                    isLoading = true;
                    await loadMoreImages();
                    isLoading = false;
                }
            }
        });
    })();
});
