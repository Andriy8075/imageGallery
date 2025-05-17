import {state} from "../state.js";

export const svgIcons = {
    Like: {
        icon: (image) => {
            return `<svg class="like-button" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="${image.liked ? "red" : "white"}"/>
            </svg>`;
        },
        onClick: function(imageId, likeButton) {
            return async function() {
                if(!initialData.logged) {
                    window.location.href = `${initialData.indexUrl}/login`
                }
                else {
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
        }
    },
    // Repost: {
    //     icon: `<svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="30" height="30" viewBox="0 0 337.000000 262.000000" preserveAspectRatio="xMidYMid meet">
    //                 <g transform="translate(0.000000,262.000000) scale(0.071222,-0.091603)" fill="#ffffff" stroke="none">
    //                     <path d="M2072 2298 c-9 -9 -12 -73 -12 -228 0 -246 -1 -250 -76 -250 -85 0 -305 -32 -419 -60 -558 -141 -978 -457 -1185 -892 -81 -171 -149 -438 -120 -473 25 -30 49 -16 123 78 213 266 517 465 875 572 202 59 373 89 616 105 133 9 151 8 168 -6 16 -15 18 -40 20 -257 3 -215 5 -241 20 -251 25 -15 39 -5 229 165 90 81 290 259 444 396 169 150 281 257 283 269 2 16 -38 58 -175 180 -98 87 -214 190 -258 230 -355 317 -490 434 -505 434 -9 0 -21 -5 -28 -12z"/>
    //                 </g>
    //             </svg>`,
    //     onClick: function() {
    //     }
    // },
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
    Delete: {
        // icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        //             <path d="M12 8c1.1 0 2-0.9 2-2s-0.9-2-2-2-2 0.9-2 2 0.9 2 2 2zm0 2c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zm0 6c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2z" fill="white"/>
        //         </svg>`,
        icon: `<svg fill="#ffffff" width="24" height="24" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 290 290" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_24_"> <g id="XMLID_29_"> <path d="M265,60h-30h-15V15c0-8.284-6.716-15-15-15H85c-8.284,0-15,6.716-15,15v45H55H25c-8.284,0-15,6.716-15,15s6.716,15,15,15 h5.215H40h210h9.166H265c8.284,0,15-6.716,15-15S273.284,60,265,60z M190,60h-15h-60h-15V30h90V60z"></path> </g> <g id="XMLID_86_"> <path d="M40,275c0,8.284,6.716,15,15,15h180c8.284,0,15-6.716,15-15V120H40V275z"></path> </g> </g> </g></svg>`,
        onClick: function (button) {
            return function() {
                state.lastClickedButton = button;
                openPopup()
            }
            // button.addEventListener('click', (event) => {
            //     event.stopPropagation();
            // });
            // return function () {
            //     const dropdown = document.getElementById('dropdown');
            //     const dropdownTrigger = document.getElementById('dropdown-trigger');
            //
            //     const isDropdownOpen = dropdown.style.display !== 'none' && dropdown.style.visibility !== 'hidden';
            //     if (isDropdownOpen) {
            //         const dropdownRect = dropdown.getBoundingClientRect();
            //         const buttonRect = button.getBoundingClientRect();
            //         if(state.lastClickedButton === button) {
            //             dropdownTrigger.click()
            //         }
            //         else {
            //             dropdown.style.left = `${buttonRect.left - dropdownRect.width / 2 + buttonRect.width / 2 + scrollX}px`;
            //             dropdown.style.top = `${buttonRect.top - dropdownRect.height - 16 + scrollY}px`;
            //         }
            //     }
            //     else {
            //         dropdown.style.visibility = 'hidden';
            //         dropdown.style.display = 'block';
            //         const dropdownRect = dropdown.getBoundingClientRect();
            //         const buttonRect = button.getBoundingClientRect();
            //         dropdown.style.display = '';
            //         dropdown.style.visibility = '';
            //         dropdown.style.left = `${buttonRect.left - dropdownRect.width / 2 + buttonRect.width / 2 + scrollX}px`;
            //         dropdown.style.top = `${buttonRect.top - dropdownRect.height - 16 + scrollY}px`;
            //         dropdownTrigger.click();
            //     }
            //     state.lastClickedButton = button;
            // };
        },
    },
};
