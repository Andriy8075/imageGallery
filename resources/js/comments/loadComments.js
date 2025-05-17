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
        commentUser.textContent = `${comment.user.name}:`;

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
    state.nextPage = initialData.nextPage
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
        const urlWithPage = `${initialData.loadMoreUrl}?page=${state.nextPage}&image=${initialData.imageId}`
        const response = await fetch(urlWithPage, { method: 'GET' });
        const data = await response.json();
        placeComments(data.data)
        state.nextPage = data.nextPage;
    } catch (error) {
        console.error('Error fetching images:', error);
    }
}
