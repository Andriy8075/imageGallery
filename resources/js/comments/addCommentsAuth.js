const {textArea} = initialData;
let clicked = false
textarea.addEventListener('click', () => {
    if(!clicked) {
        const submitButtonDiv = document.getElementById('submit-button-div');
        submitButtonDiv.classList.remove('hidden');
        textarea.rows = 10
        clicked = true
    }
})

const commentForm = document.getElementById('comment-form');

commentForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(commentForm);
    textarea.value='';

    fetch(initialData.storeURL, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData,
    })
        .then(response => {
            if(response.status === 200) {
                const commentsDiv = document.getElementById('comments-div');
                function sanitizeText(text) {
                    const element = document.createElement('div');
                    if (text) {
                        element.innerText = text; // Using innerText automatically escapes special characters
                        element.textContent = text;
                    }
                    return element.innerHTML; // Return the escaped string
                }

                const sanitizedText = sanitizeText(formData.get('text')).replace(/\n/g, '<br>');
                const toAppend = `
                        <div class="m-4">
                            <strong class="text-2xl">${initialData.authUserName}:</strong> <!-- Assuming the comment has a user relationship -->
                            <p class="text-xl">${sanitizedText}</p>
                        </div>
                    `
                commentsDiv.insertAdjacentHTML('afterbegin', toAppend);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
