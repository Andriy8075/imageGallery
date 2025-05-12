import {state} from "@/state.js";
// import {placeImages} from "@/imageUtils.js";

import {addListenersToLoadMore} from "@/loadingUtils.js";

const commentsDiv = document.getElementById("comments-div");

function placeComments(comments) {
    for (const comment of comments) {
        const commentDiv = document.createElement("div");
        commentDiv.classList.add("m-4");

        const commentUser = document.createElement("strong");
        commentUser.classList.add("text-2xl");
        commentUser.textContent = `${comment.name}:`;

        const commentText = document.createElement("p");
        commentText.classList.add("text-xl", "break-words");
        commentText.innerHTML = nl2br(escapeHtml(comment.text));

        commentDiv.appendChild(commentUser);
        commentDiv.appendChild(commentText);

        commentsDiv.appendChild(commentDiv);
    }
}
document.addEventListener("DOMContentLoaded", function() {
    placeComments(initialData.comments);
    state.hasMorePages.comments = initialData.hasMorePages
    addListenersToLoadMore('comments', loadMoreComments)
})

function nl2br(str) {
    return str.replace(/\n/g, '<br>');
}

function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

async function loadMoreComments() {
    try {
        const response = await fetch(initialData.loadMoreUrl, { method: 'GET' });
        const data = await response.json();
        console.log(data)
        //
        // if (data.images) {
        //     state.hasMoreCommentsPages = data.hasMoreCommentsPages;
        //     await placeImages(data.images);
        // }
    } catch (error) {
        console.error('Error fetching images:', error);
    }
}
