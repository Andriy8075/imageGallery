import {state} from "@/state.js";
// import {placeImages} from "@/imageUtils.js";

import {addListenersToLoadMore} from "@/loadingUtils.js";

const commentsDiv = document.getElementById("comments-div");
// function placeComments(comments) {
//     for (const comment of comments) {
//         const commentDiv = document.createElement("div");
//         commentDiv.classList.add("m-4");
//
//         const commentUser = document.createElement("strong");
//         commentUser.classList.add("text-2xl");
//         commentUser.textContent = `${comment.user.name}:`;
//
//         const commentText = document.createElement("p");
//         commentText.classList.add("text-xl", "break-words");
//         commentText.innerHTML = nl2br(escapeHtml(comment.text));
//
//         commentDiv.appendChild(commentUser);
//         commentDiv.appendChild(commentText);
//
//         commentsDiv.appendChild(commentDiv);
//     }
// }

function placeComments(comments) {

    for (const comment of comments) {
        const commentDiv = document.createElement("div");
        commentDiv.classList.add("m-4", "border", "p-4", "relative");
        commentDiv.dataset.commentId = comment.id; // Store comment ID for reference

        // User info
        const commentUser = document.createElement("strong");
        commentUser.classList.add("text-2xl", "block");
        commentUser.textContent = `${comment.user.name}:`;

        // Comment text
        const commentText = document.createElement("p");
        commentText.classList.add("text-xl", "break-words", "my-2");
        commentText.innerHTML = nl2br(escapeHtml(comment.text));
        commentText.id = `comment-text-${comment.id}`;

        // Action buttons container
        const actionsDiv = document.createElement("div");
        actionsDiv.classList.add("flex", "gap-2", "mt-2");

        // Edit button
        const editBtn = document.createElement("button");
        editBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" /></svg>';
        editBtn.classList.add("text-blue-500", "hover:text-blue-700");
        editBtn.addEventListener('click', () => showEditForm(comment));
        editBtn.title = "Edit comment";

        // Delete button
        const deleteBtn = document.createElement("button");
        deleteBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>';
        deleteBtn.classList.add("text-red-500", "hover:text-red-700");
        deleteBtn.addEventListener('click', () => deleteComment(comment.id));
        deleteBtn.title = "Delete comment";

        // Append elements
        actionsDiv.appendChild(editBtn);
        actionsDiv.appendChild(deleteBtn);

        commentDiv.appendChild(commentUser);
        commentDiv.appendChild(commentText);
        commentDiv.appendChild(actionsDiv);

        commentsDiv.appendChild(commentDiv);
    }
}

// Helper functions for the actions
function showEditForm(comment) {
    // Replace text with textarea
    const textElement = document.getElementById(`comment-text-${comment.id}`);
    const currentText = textElement.textContent;

    const form = document.createElement("form");
    form.classList.add("flex", "gap-2", "items-center");

    const textarea = document.createElement("textarea");
    textarea.value = currentText;
    textarea.classList.add("border", "p-2", "flex-1");
    textarea.required = true;

    const saveBtn = document.createElement("button");
    saveBtn.textContent = "Save";
    saveBtn.classList.add("bg-blue-500", "text-white", "px-3", "py-1", "rounded");
    saveBtn.type = "submit";

    const cancelBtn = document.createElement("button");
    cancelBtn.textContent = "Cancel";
    cancelBtn.classList.add("bg-gray-500", "text-white", "px-3", "py-1", "rounded");
    cancelBtn.type = "button";
    cancelBtn.addEventListener('click', () => {
        const restoredTextElement = document.createElement("p");
        restoredTextElement.classList.add("text-xl", "break-words", "my-2");
        restoredTextElement.innerHTML = nl2br(escapeHtml(currentText));
        restoredTextElement.id = `comment-text-${comment.id}`;

        form.replaceWith(restoredTextElement);
    });

    form.appendChild(textarea);
    form.appendChild(saveBtn);
    form.appendChild(cancelBtn);

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        updateComment(comment.id, textarea.value);
    });

    textElement.replaceWith(form);
    textarea.focus();
}

async function updateComment(commentId, newText) {
    console.log(commentId)
    try {
        const response = await fetch(`/comments/${commentId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ text: newText })
        });

        if (response.ok) {
            const commentText = document.getElementById(`comment-text-${commentId}`);
            commentText.innerHTML = nl2br(escapeHtml(newText));
        } else {
            alert('Failed to update comment');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function deleteComment(commentId) {
    // if (!confirm('Are you sure you want to delete this comment?')) return;
    //
    // try {
    //     const response = await fetch(`/comments/${commentId}`, {
    //         method: 'DELETE',
    //         headers: {
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    //         }
    //     });
    //
    //     if (response.ok) {
    //         document.querySelector(`[data-comment-id="${commentId}"]`).remove();
    //     } else {
    //         alert('Failed to delete comment');
    //     }
    // } catch (error) {
    //     console.error('Error:', error);
    // }
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
