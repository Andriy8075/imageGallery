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

const svgIcons = {
    Like: {
        icon: (image) => {
            return `<svg class="like-button" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="${image.liked ? "red" : "white"}"/>
            </svg>`;
        },
        onClick: function(imageId, likeButton) {
            return async function() {
                try {
                    const response = await fetch(`/images/${imageId}/like`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                    });
                    if (!response.ok) {
                        throw new Error('Failed to like the image.');
                    }

                    const result = await response.json();
                    const likeButtonPath = likeButton.querySelector('path');

                    if (result.liked) {
                        likeButtonPath.setAttribute('fill', 'red')
                    }
                    else {
                        likeButtonPath.setAttribute('fill', 'white')
                    }
                } catch (error) {
                    console.error("An error occurred:", error);
                }
            }
        }
    },
    Repost: {
        icon: `<svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="30" height="30" viewBox="0 0 337.000000 262.000000" preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0.000000,262.000000) scale(0.071222,-0.091603)" fill="#ffffff" stroke="none">
                        <path d="M2072 2298 c-9 -9 -12 -73 -12 -228 0 -246 -1 -250 -76 -250 -85 0 -305 -32 -419 -60 -558 -141 -978 -457 -1185 -892 -81 -171 -149 -438 -120 -473 25 -30 49 -16 123 78 213 266 517 465 875 572 202 59 373 89 616 105 133 9 151 8 168 -6 16 -15 18 -40 20 -257 3 -215 5 -241 20 -251 25 -15 39 -5 229 165 90 81 290 259 444 396 169 150 281 257 283 269 2 16 -38 58 -175 180 -98 87 -214 190 -258 230 -355 317 -490 434 -505 434 -9 0 -21 -5 -28 -12z"/>
                    </g>
                </svg>`,
        onClick: function() {
        }
    },
    Edit: {
        icon: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25ZM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83Z" fill="white"/>
                </svg>`,
        onClick: function (imageId) {
            return () => {
                window.location.href = `/images/${imageId}/edit`;
            }
        }
    },
    More: {
        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 8c1.1 0 2-0.9 2-2s-0.9-2-2-2-2 0.9-2 2 0.9 2 2 2zm0 2c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zm0 6c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2z" fill="white"/>
                </svg>`,
        onClick: function (button) {
            button.addEventListener('click', (event) => {
                event.stopPropagation();
            });
            return function () {
                const dropdown = document.getElementById('dropdown');
                const dropdownTrigger = document.getElementById('dropdown-trigger');

                const isDropdownOpen = dropdown.style.display !== 'none' && dropdown.style.visibility !== 'hidden';
                if (isDropdownOpen) {
                    const dropdownRect = dropdown.getBoundingClientRect();
                    const buttonRect = button.getBoundingClientRect();
                    if(state.lastClickedButton === button) {
                        dropdownTrigger.click()
                    }
                    else {
                        dropdown.style.left = `${buttonRect.left - dropdownRect.width / 2 + buttonRect.width / 2 + scrollX}px`;
                        dropdown.style.top = `${buttonRect.top - dropdownRect.height - 16 + scrollY}px`;
                    }
                }
                else {
                    dropdown.style.visibility = 'hidden';
                    dropdown.style.display = 'block';
                    const dropdownRect = dropdown.getBoundingClientRect();
                    const buttonRect = button.getBoundingClientRect();
                    dropdown.style.display = '';
                    dropdown.style.visibility = '';
                    dropdown.style.left = `${buttonRect.left - dropdownRect.width / 2 + buttonRect.width / 2 + scrollX}px`;
                    dropdown.style.top = `${buttonRect.top - dropdownRect.height - 16 + scrollY}px`;
                    dropdownTrigger.click();
                }
                state.lastClickedButton = button;
            };
        },
    },
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
        imgElement.classList.add('image-item');
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
    if (!state.hasMorePages) {
        const loadingLabel = document.getElementById('loading');
        loadingLabel.text('No more images')
        loadingLabel.show()
    }
}

export const loadMoreImages = async () => {
    const loadingLabel = document.getElementById('loading');
    loadingLabel.style.display = 'block'

    try {
        const response = await fetch(initialData.loadMoreUrl, { method: 'GET' });
        const data = await response.json();

        if (data.images) {
            state.hasMorePages = data.hasMorePages;
            await placeImages(data.images);
        }
    } catch (error) {
        console.error('Error fetching images:', error);
    } finally {
        if (state.hasMorePages) loadingLabel.style.display = 'none';
        else loadingLabel.textContent = 'No more images'
    }
};

export const loadImagesIfNeeded = async () => {
    while (true) {
        const documentHeight = document.documentElement.scrollHeight;
        const windowHeight = window.innerHeight;

        if (documentHeight <= windowHeight && state.hasMorePages) {
            await loadMoreImages();
        } else {
            break;
        }
    }
};

// resources/js/deleteHandler.js
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
            const result = await response.json();
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


