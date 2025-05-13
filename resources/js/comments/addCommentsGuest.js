const {textArea} = initialData;
textarea.addEventListener('click', () => {
    const dropdown = document.createElement('div');
    dropdown.id = 'login-dropdown';
    dropdown.className = 'absolute bg-white border rounded p-4 shadow-lg';
    dropdown.style.top = textarea.offsetTop + textarea.offsetHeight + 'px';
    dropdown.style.left = textarea.offsetLeft + 'px';

    dropdown.innerHTML = `
                        <p class="text-sm mb-2">You must be logged in to leave a comment</p>
                        <a href=${initialData.loginURL} class="bg-blue-500 text-white px-3 py-1 rounded">Log in</a>
                    `;

    document.body.appendChild(dropdown);

    const handleClickOutside = (event) => {
        if (!dropdown.contains(event.target) && event.target !== textarea) {
            dropdown.remove();
            document.removeEventListener('click', handleClickOutside);
        }
    };

    document.addEventListener('click', handleClickOutside);

    textarea.addEventListener('input', (event) => {
        event.preventDefault();
        textarea.value = '';
    });
});
