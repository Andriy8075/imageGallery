import {
    state
} from '../state.js';

import {
    svgIcons
} from './icons.js'
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
    const aspectRatio = img.naturalWidth / img.naturalHeight;

    img.width = initialData.imageMaxWidth;
    img.height = Math.round(initialData.imageMaxWidth / aspectRatio);
};

const addImage = async (image) => {
    return new Promise((resolve) => {
        const cols = document.getElementsByClassName('col');
        const imageDiv = document.createElement('div');
        imageDiv.style.marginBottom = '16px';
        imageDiv.style.position = 'relative'; // For positioning hover buttons
        imageDiv.id = image.id;
        const imgElement = document.createElement('img');

        imgElement.src = image.url;
        imgElement.addEventListener('click', () => {
            window.location.href=`${initialData.indexUrl}/images/${image.id}`;
        })
        imgElement.classList.add('image-item');
        imgElement.style.cursor = 'pointer';
        imageDiv.appendChild(imgElement);

        const buttonsDiv = document.createElement('div');
        buttonsDiv.style.display = state.isMobile ? 'flex' : 'none';
        buttonsDiv.style.justifyContent = 'space-around';
        buttonsDiv.style.width = '100%';
        buttonsDiv.style.marginTop = '8px';
        buttonsDiv.style.position = state.isMobile ? 'static' : 'absolute';
        buttonsDiv.style.bottom = '8px';
        buttonsDiv.style.left = '50%';
        buttonsDiv.style.transform = state.isMobile ? 'translateX(-0%)' : 'translateX(-50%)';
        buttonsDiv.style.background = 'rgba(0, 0, 0, 0.6)';
        buttonsDiv.style.padding = '8px';
        buttonsDiv.style.borderRadius = '8px';
        buttonsDiv.style.zIndex = '10';
        buttonsDiv.dataset.imageId = image.id;

        Object.keys(svgIcons).forEach((actionName) => {
            const button = document.createElement('button');
            const action = svgIcons[actionName];
            button.innerHTML = actionName === 'Like' ? action.icon(image) : action.icon;
            button.style.color = 'white';
            button.style.background = 'transparent';
            button.style.border = 'none';
            button.style.cursor = 'pointer';
            button.style.fontSize = '14px';

            buttonsDiv.appendChild(button);

            if (actionName === 'More') {
                button.dataset.imageId = image.id;
                button.addEventListener('click', svgIcons[actionName].onClick(button));
            }
            else if (actionName === 'Edit' || actionName === 'Like') {
                button.addEventListener('click', svgIcons[actionName].onClick(image.id, button));
            }
            else {
                button.addEventListener('click', svgIcons[actionName].onClick);
            }
        });

        imageDiv.appendChild(buttonsDiv);

        if (!state.isMobile) {
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
            resolve();
        };
    })
};

export const placeImages = async (images) => {
    const imageLoadPromises = [];

    for (const image of images) {
        const loadPromise = addImage(image);
        imageLoadPromises.push(loadPromise);
    }

    await Promise.all(imageLoadPromises);
    if (!state.hasMorePages.images) {
        const loadingLabel = document.getElementById('loading');
        loadingLabel.innerText = 'No more images'
        loadingLabel.style.display = 'block'
    }
}

export const loadMoreImages = async () => {
    const loadingLabel = document.getElementById('loading');
    loadingLabel.style.display = 'block'

    try {
        const response = await fetch(initialData.loadMoreUrl, { method: 'GET' });
        const data = await response.json();

        if (data.images) {
            console.log("data images", data.images)
            state.hasMorePages.images = data.hasMorePages.images;
            await placeImages(data.images.images);
        }
    } catch (error) {
        console.error('Error fetching images:', error);
    } finally {
        console.log(4444)
        if (state.hasMorePages.images) loadingLabel.style.display = 'none';
        else loadingLabel.textContent = 'No more images'
    }
};

export async function confirmDelete() {
    const idOfImageToDelete = state.lastClickedButton.dataset.imageId;

    try {
        const response = await fetch(`/images/${idOfImageToDelete}/destroy`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Laravel CSRF token
            },
        });

        if (response.ok) {
            closePopup();
            const dropdownTrigger = document.getElementById('dropdown-trigger');
            dropdownTrigger.click();
            const imageDiv = document.getElementById(idOfImageToDelete);
            imageDiv.onclick = null;

            // Remove all child elements
            while (imageDiv.firstChild) {
                imageDiv.removeChild(imageDiv.firstChild);
            }

            // Replace the content with a success message
            imageDiv.innerHTML = '<p>Image deleted successfully.</p>';
            // Optionally, remove the image from the DOM or update UI
        } else {
            console.error('Failed to delete image:', response.status, response.statusText);
        }
    } catch (error) {
        console.error('Error during deletion:', error);
    }
}


