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

// function toggleLike(element) {
//     const like = element.querySelector('.like');
//     like.classList.toggle('red');
// }

const svgIcons = {
    Like: {
        icon: `<svg class="like-button" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="white"/>
                </svg>`,
        onClick: function() {
            console.log("Like button clicked");
        }
    },
    Comment: {
        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 11.5C21 6.81 16.97 3 12 3S3 6.81 3 11.5c0 2.61 1.54 4.92 3.92 6.31.54.32.82.93.72 1.53l-.54 2.71c-.14.72.59 1.29 1.24.94L10.47 20c.4-.2.84-.31 1.28-.31 4.97 0 9-3.81 9-8.19z" fill="white" stroke="black" stroke-width="0"/>
                    <circle cx="8" cy="11" r="0.5" fill="none" stroke="black" stroke-width="1.2"/>
                    <circle cx="12" cy="11" r="0.5" fill="none" stroke="black" stroke-width="1.2"/>
                    <circle cx="16" cy="11" r="0.5" fill="none" stroke="black" stroke-width="1.2"/>
                </svg>`,
        onClick: function() {
            console.log("Comment button clicked");
        }
    },
    Repost: {
        icon: `<svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="30" height="30" viewBox="0 0 337.000000 262.000000" preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0.000000,262.000000) scale(0.071222,-0.091603)" fill="#ffffff" stroke="none">
                        <path d="M2072 2298 c-9 -9 -12 -73 -12 -228 0 -246 -1 -250 -76 -250 -85 0 -305 -32 -419 -60 -558 -141 -978 -457 -1185 -892 -81 -171 -149 -438 -120 -473 25 -30 49 -16 123 78 213 266 517 465 875 572 202 59 373 89 616 105 133 9 151 8 168 -6 16 -15 18 -40 20 -257 3 -215 5 -241 20 -251 25 -15 39 -5 229 165 90 81 290 259 444 396 169 150 281 257 283 269 2 16 -38 58 -175 180 -98 87 -214 190 -258 230 -355 317 -490 434 -505 434 -9 0 -21 -5 -28 -12z"/>
                    </g>
                </svg>`,
        onClick: function() {
            console.log("Repost button clicked");
        }
    },
    More: {
        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 8c1.1 0 2-0.9 2-2s-0.9-2-2-2-2 0.9-2 2 0.9 2 2 2zm0 2c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zm0 6c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2z" fill="white"/>
                </svg>`,
        onClick: function() {
            console.log("More button clicked");
        }
    }
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
    buttonsDiv.style.width = '100%';
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
        button.innerHTML = svgIcons[action].icon;
        button.style.color = 'white';
        button.style.background = 'transparent';
        button.style.border = 'none';
        button.style.cursor = 'pointer';
        button.style.fontSize = '14px';
        buttonsDiv.appendChild(button);

        // Add functionality for each button
        button.addEventListener('click', svgIcons[action].onClick);
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
//     imageDiv.style.marginBottom = '16px';
//     imageDiv.style.position = 'relative'; // For positioning hover buttons
//     const imgElement = document.createElement('img');
//
//     imgElement.src = image.url;
//     imgElement.classList.add('image-item');
//     imageDiv.appendChild(imgElement);
//
//     // Create buttons container
//     const buttonsDiv = document.createElement('div');
//     buttonsDiv.style.display = state.isMobile ? 'flex' : 'none'; // Show for mobile by default
//     buttonsDiv.style.justifyContent = 'space-around';
//     buttonsDiv.style.width = '100%'
//     buttonsDiv.style.marginTop = '8px'; // Margin for buttons under the image
//     buttonsDiv.style.position = state.isMobile ? 'static' : 'absolute'; // Static for mobile, absolute for desktop
//     buttonsDiv.style.bottom = '8px'; // Position on hover for desktop
//     buttonsDiv.style.left = '50%';
//     buttonsDiv.style.transform = state.isMobile ? 'translateX(-0%)' : 'translateX(-50%)';
//     buttonsDiv.style.background = 'rgba(0, 0, 0, 0.6)'; // Background for hover buttons
//     buttonsDiv.style.padding = '8px';
//     buttonsDiv.style.borderRadius = '8px';
//     buttonsDiv.style.zIndex = '10';
//     function toggleLike(element) {
//         const like = element.querySelector('.like');
//         like.classList.toggle('red');
//     }
//     // SVG icons
//     const svgIcons = {
//         Like: `<svg class="like-button" onclick="toggleLike(this)" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
//                 <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="white" onclick="toggleLike(this)"/>
//             </svg>`,
//         Comment: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
//   <!-- Speech bubble -->
//   <path d="M21 11.5C21 6.81 16.97 3 12 3S3 6.81 3 11.5c0 2.61 1.54 4.92 3.92 6.31.54.32.82.93.72 1.53l-.54 2.71c-.14.72.59 1.29 1.24.94L10.47 20c.4-.2.84-.31 1.28-.31 4.97 0 9-3.81 9-8.19z" fill="white" stroke="black" stroke-width="0"/>
//
//   <!-- Smaller circles -->
//   <circle cx="8" cy="11" r="0.5" fill="none" stroke="black" stroke-width="1.2"/>
//   <circle cx="12" cy="11" r="0.5" fill="none" stroke="black" stroke-width="1.2"/>
//   <circle cx="16" cy="11" r="0.5" fill="none" stroke="black" stroke-width="1.2"/>
// </svg>
//
// `,
//         Repost: `<svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="30" height="30" viewBox="0 0 337.000000 262.000000" preserveAspectRatio="xMidYMid meet">
//     <g transform="translate(0.000000,262.000000) scale(0.071222,-0.091603)" fill="#ffffff" stroke="none">
//         <path d="M2072 2298 c-9 -9 -12 -73 -12 -228 0 -246 -1 -250 -76 -250 -85 0 -305 -32 -419 -60 -558 -141 -978 -457 -1185 -892 -81 -171 -149 -438 -120 -473 25 -30 49 -16 123 78 213 266 517 465 875 572 202 59 373 89 616 105 133 9 151 8 168 -6 16 -15 18 -40 20 -257 3 -215 5 -241 20 -251 25 -15 39 -5 229 165 90 81 290 259 444 396 169 150 281 257 283 269 2 16 -38 58 -175 180 -98 87 -214 190 -258 230 -355 317 -490 434 -505 434 -9 0 -21 -5 -28 -12z"/>
//     </g>
// </svg>
//
//
// `,
//         More: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
//                 <path d="M12 8c1.1 0 2-0.9 2-2s-0.9-2-2-2-2 0.9-2 2 0.9 2 2 2zm0 2c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zm0 6c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2z" fill="white"/>
//             </svg>`
//     };
//
//     // Add buttons
//     const actions = ['Like', 'Comment', 'Repost', 'More'];
//     actions.forEach((action) => {
//         const button = document.createElement('button');
//         button.innerHTML = svgIcons[action];
//         button.style.color = 'white';
//         button.style.background = 'transparent';
//         button.style.border = 'none';
//         button.style.cursor = 'pointer';
//         button.style.fontSize = '14px';
//         buttonsDiv.appendChild(button);
//
//         // Add functionality for each button (optional)
//         button.addEventListener('click', () => {
//             console.log(`${action} button clicked for image: ${image.url}`);
//
//             if (action === 'Like') {
//                 button.firstElementChild.style.fill = 'red';
//                 button.classList.add('liked');
//             }
//         });
//     });
//
//     imageDiv.appendChild(buttonsDiv);
//
//     if (!state.isMobile) {
//         // Show buttons on hover for desktop
//         imageDiv.addEventListener('mouseenter', () => {
//             buttonsDiv.style.display = 'flex';
//         });
//
//         imageDiv.addEventListener('mouseleave', () => {
//             buttonsDiv.style.display = 'none';
//         });
//     }
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
// const addImage = (image) => {
//     const cols = document.getElementsByClassName('col');
//     const imageDiv = document.createElement('div');
//     imageDiv.style.marginBottom = '16px';
//     imageDiv.style.position = 'relative'; // For positioning hover buttons
//     const imgElement = document.createElement('img');
//
//     imgElement.src = image.url;
//     imgElement.classList.add('image-item');
//     imageDiv.appendChild(imgElement);
//
//     // Create buttons container
//     const buttonsDiv = document.createElement('div');
//     buttonsDiv.style.display = state.isMobile ? 'flex' : 'none'; // Show for mobile by default
//     buttonsDiv.style.justifyContent = 'space-around';
//     buttonsDiv.style.width = '100%'
//     buttonsDiv.style.marginTop = '8px'; // Margin for buttons under the image
//     buttonsDiv.style.position = state.isMobile ? 'static' : 'absolute'; // Static for mobile, absolute for desktop
//     buttonsDiv.style.bottom = '8px'; // Position on hover for desktop
//     buttonsDiv.style.left = '50%';
//     buttonsDiv.style.transform = state.isMobile ? 'translateX(-0%)' : 'translateX(-50%)';
//     buttonsDiv.style.background = 'rgba(0, 0, 0, 0.6)'; // Background for hover buttons
//     buttonsDiv.style.padding = '8px';
//     buttonsDiv.style.borderRadius = '8px';
//     buttonsDiv.style.zIndex = '10';
//
//     // Add buttons
//     const actions = ['Like', 'Comment', 'Repost', 'More'];
//     actions.forEach((action) => {
//         const button = document.createElement('button');
//         button.textContent = action;
//         button.style.color = 'white';
//         button.style.background = 'transparent';
//         button.style.border = 'none';
//         button.style.cursor = 'pointer';
//         button.style.fontSize = '14px';
//         buttonsDiv.appendChild(button);
//
//         // Add functionality for each button (optional)
//         button.addEventListener('click', () => {
//             console.log(`${action} button clicked for image: ${image.url}`);
//         });
//     });
//
//     imageDiv.appendChild(buttonsDiv);
//
//     if (!state.isMobile) {
//         // Show buttons on hover for desktop
//         imageDiv.addEventListener('mouseenter', () => {
//             buttonsDiv.style.display = 'flex';
//         });
//
//         imageDiv.addEventListener('mouseleave', () => {
//             buttonsDiv.style.display = 'none';
//         });
//     }
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
