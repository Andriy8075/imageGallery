import {
    state
} from './state.js';

const findShortestColumn = () => {
    let shortestHeight = -1;
    let shortestIndex = 0;

    const cols = document.getElementsByClassName('col');
    for (let i = 0; i < cols.length; i++) {
        const height = cols[i].offsetHeight;
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


const addImage = (image) => {
    const cols = document.getElementsByClassName('col');
    const imageDiv = document.createElement('div');
    imageDiv.style.marginBottom = '16px';
    imageDiv.style.position = 'relative'; // For positioning hover buttons
    const imgElement = document.createElement('img');

    imgElement.src = image.url;
    imgElement.classList.add('image-item');
    imageDiv.appendChild(imgElement);

    // Create buttons container
    const buttonsDiv = document.createElement('div');
    buttonsDiv.style.display = state.isMobile ? 'flex' : 'none'; // Show for mobile by default
    buttonsDiv.style.justifyContent = 'space-around';
    buttonsDiv.style.width = '100%'
    buttonsDiv.style.marginTop = '8px'; // Margin for buttons under the image
    buttonsDiv.style.position = state.isMobile ? 'static' : 'absolute'; // Static for mobile, absolute for desktop
    buttonsDiv.style.bottom = '8px'; // Position on hover for desktop
    buttonsDiv.style.left = '50%';
    buttonsDiv.style.transform = state.isMobile ? 'translateX(-0%)' : 'translateX(-50%)';
    buttonsDiv.style.background = 'rgba(0, 0, 0, 0.6)'; // Background for hover buttons
    buttonsDiv.style.padding = '8px';
    buttonsDiv.style.borderRadius = '8px';
    buttonsDiv.style.zIndex = '10';

    // Add buttons
    const actions = ['Like', 'Comment', 'Repost', 'More'];
    actions.forEach((action) => {
        const button = document.createElement('button');
        button.textContent = action;
        button.style.color = 'white';
        button.style.background = 'transparent';
        button.style.border = 'none';
        button.style.cursor = 'pointer';
        button.style.fontSize = '14px';
        buttonsDiv.appendChild(button);

        // Add functionality for each button (optional)
        button.addEventListener('click', () => {
            console.log(`${action} button clicked for image: ${image.url}`);
        });
    });

    imageDiv.appendChild(buttonsDiv);

    if (!state.isMobile) {
        // Show buttons on hover for desktop
        imageDiv.addEventListener('mouseenter', () => {
            buttonsDiv.style.display = 'flex';
        });

        imageDiv.addEventListener('mouseleave', () => {
            buttonsDiv.style.display = 'none';
        });
    }

    imgElement.onload = () => {
        resizeImage(imgElement);

        const shortestColIndex = findShortestColumn();
        cols[shortestColIndex].appendChild(imageDiv);
    };

    imgElement.onerror = () => {
        console.error('Image failed to load:', imgElement.src);
    };
};

// const addImage = (image) => {
//     const cols = document.getElementsByClassName('col');
//     const imageDiv = document.createElement('div');
//     imageDiv.style.marginBottom = '16px'
//     const imgElement = document.createElement('img');
//
//     imgElement.src = image.url;
//     imgElement.classList.add('image-item');
//     imageDiv.appendChild(imgElement);
//
//     imgElement.onload = () => {
//         resizeImage(imgElement);
//
//         const shortestColIndex = findShortestColumn();
//         cols[shortestColIndex].appendChild(imageDiv);
//     };
//
//     imgElement.onerror = () => {
//         console.error('Image failed to load:', imgElement.src);
//     };
// };

export const placeImages = async (images) => {
    const imageLoadPromises = [];

    for (const image of images) {
        const loadPromise = new Promise((resolve) => {
            const imgElement = document.createElement('img');
            imgElement.src = image.url;
            imgElement.onload = resolve;
            imgElement.onerror = resolve;
        });
        imageLoadPromises.push(loadPromise);

        addImage(image);
    }

    await Promise.all(imageLoadPromises);
    if (!state.hasMorePages) {
        const loadingLabel = $('#loading');
        loadingLabel.text('No more images')
        loadingLabel.show()
    }
}

export const loadMoreImages = async () => {
    const loadingLabel = $('#loading');
    loadingLabel.show();

    try {
        const response = await $.ajax({
            url: initialData.loadMoreUrl,
            type: 'GET',
        });

        if (response.images) {
            state.hasMorePages = response.hasMorePages;
            await placeImages(response.images)
        }

    } finally {
        if(state.hasMorePages) {
            loadingLabel.hide();
        }
    }
}

export const loadImagesIfNeeded = async () =>{
    while (true) {
        if ($(document).height() <= $(window).height() && state.hasMorePages) {
            await loadMoreImages();
        } else {
            break;
        }
    }
}
