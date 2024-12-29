const windowWidth = window.innerWidth
const countOfCols = Math.ceil(windowWidth/initialData.imageLoadingConfig.image_max_width)
const heights = [];
for (let i = 0; i<countOfCols; i++) {
    const colDiv = document.createElement('div');
    colDiv.classList.add('col');
    colDiv.id = `col-${i}`;
    colDiv.style.marginRight = '16px';
    const imageContainer = document.getElementById('image-container')
    imageContainer.appendChild(colDiv);
    heights[i] = 0;
}
const addImage = (link) => {
    const cols = document.getElementsByClassName('col');
    const imageDiv = document.createElement('div');
    imageDiv.style.marginBottom = '16px'
    const imgElement = document.createElement('img');

    imgElement.src = link.url;
    imgElement.classList.add('image-item');
    imageDiv.appendChild(imgElement);

    const resizeImage = (img) => {
        const maxWidth = initialData.imageLoadingConfig.image_max_width;
        const aspectRatio = img.naturalWidth / img.naturalHeight;

        img.width = maxWidth;
        img.height = Math.round(maxWidth / aspectRatio);
    };

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

async function placeImages(images) {
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
let hasMorePages = initialData.images.hasMorePages;

$(document).ready(function () {
    (async () => {
        const images = initialData.images.images;
        await placeImages(images);
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

async function loadImagesIfNeeded() {
    while (true) {
        if ($(document).height() <= $(window).height()) {
            await loadMoreImages();
        } else {
            break;
        }
    }
}


const {loadMoreUrl} = initialData;
async function loadMoreImages() {
    const loadingLabel = $('#loading');
    loadingLabel.show();

    try {
        const response = await $.ajax({
            url: loadMoreUrl,
            type: 'GET',
        });

        if (response.images) {
            await placeImages(response.images)
        }
    } catch (error) {
        console.error('Could not load more images.', error);
    } finally {
        loadingLabel.hide();
    }
}
