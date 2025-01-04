import {
    heights,
} from './state.js';

const findShortestColumn = () => {
    let shortestHeight = -1;
    let shortestIndex = 0;

    for (let i = 0; i < heights.length; i++) {
        const height = heights[i];
        if (shortestHeight < 0 || height < shortestHeight) {
            shortestHeight = height;
            shortestIndex = i;
        }
    }
    return shortestIndex;
};

const resizeImage = (img) => {
    const maxWidth = initialData.imageLoadingConfig.image_max_width;
    const aspectRatio = img.naturalWidth / img.naturalHeight;

    img.width = maxWidth;
    img.height = Math.round(maxWidth / aspectRatio);
};

const addImage = (link) => {
    const cols = document.getElementsByClassName('col');
    const imageDiv = document.createElement('div');
    imageDiv.style.marginBottom = '16px'
    const imgElement = document.createElement('img');

    imgElement.src = link.url;
    imgElement.classList.add('image-item');
    imageDiv.appendChild(imgElement);

    imgElement.onload = () => {
        resizeImage(imgElement);

        const shortestColIndex = findShortestColumn();
        cols[shortestColIndex].appendChild(imageDiv);

        const marginBottom = parseFloat(imageDiv.style.marginBottom)
        heights[shortestColIndex] += (imgElement.height+marginBottom);
    };

    imgElement.onerror = () => {
        console.error('Image failed to load:', imgElement.src);
    };
};

export const placeImages = async (images) => {
    const links = images;
    const imageLoadPromises = [];

    for (const link of links) {
        const loadPromise = new Promise((resolve) => {
            const imgElement = document.createElement('img');
            imgElement.src = link.url;
            imgElement.onload = resolve;
            imgElement.onerror = resolve;
        });
        imageLoadPromises.push(loadPromise);

        addImage(link);
    }

    await Promise.all(imageLoadPromises);
}

export const loadMoreImages = async () => {
    const loadingLabel = $('#loading');
    loadingLabel.show();

    try {
        const response = await $.ajax({
            url: initialData.loadMoreUrl,
            type: 'GET',
        });

        console.log(response)

        if (response.images) {
            await placeImages(response.images)
        }
    } finally {
        loadingLabel.hide();
    }
}

export const loadImagesIfNeeded = async () =>{
    while (true) {
        if ($(document).height() <= $(window).height()) {
            await loadMoreImages();
        } else {
            break;
        }
    }
}
