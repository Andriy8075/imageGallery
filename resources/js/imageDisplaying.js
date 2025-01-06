import {
    placeImages,
    loadImagesIfNeeded,
    loadMoreImages,
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
$(document).ready(function () {
    (async () => {
        const images = initialData.images.images;
        if(images.length === 0) {
            const loadingLabel = $('#loading');
            loadingLabel.text(initialData.noImagesMessage);
            loadingLabel.show();
            return;
        }
        await placeImages(images);
        await loadImagesIfNeeded();

        let isLoading = false;

        $(window).scroll(async function () {
            if (!isLoading && $(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                if (state.hasMorePages) {
                    isLoading = true;
                    await loadMoreImages();
                    isLoading = false;
                }
            }
        });
    })();
});
