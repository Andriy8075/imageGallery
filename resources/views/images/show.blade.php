<x-default-layout>
    @include('layouts.navigation')
    <div class="m-12">
        <h1 class="text-2xl">{{$image->title}}</h1>
    </div>

    <div class="p-1">
        <img src="{{ asset('storage/images/' . $image->file_path) }}" class="w-full h-auto">
    </div>

    <div class="m-12">
        <h1 class="text-xl">{{$image->description}}</h1>
    </div>

    <div class="m-12">
        <form id="comment-form">
            <div>
                <label for="text" class="block text-lg font-medium">Write a comment</label>
                <textarea id="textarea" name="text" rows="2" class="w-full p-2 border rounded" placeholder="Write your comment here..."></textarea>
            </div>
            <div id="submit-button-div" class="mt-4 hidden">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Post Comment</button>
            </div>
        </form>
    </div>

    <div id="comments-div" class="m-12 mb-24">
        @foreach ($image->comments as $comment)
            <div class="m-4">
                <strong class="text-2xl">{{ $comment->user->name }}:</strong> <!-- Assuming the comment has a user relationship -->
                <p class="text-xl">{{ $comment->text }}</p>
            </div>
        @endforeach
    </div>

    <script>
        const textarea = document.getElementById('textarea');

        @auth
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

            fetch("{{ route('comments.store', $image->id) }}", {
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

                    const sanitizedText = sanitizeText(formData.get('text'));
                    const toAppend = `
                        <div class="m-4">
                            <strong class="text-2xl">{{ auth()->user()->name }}:</strong> <!-- Assuming the comment has a user relationship -->
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
        @else
        textarea.addEventListener('click', () => {
            const dropdown = document.createElement('div');
            dropdown.id = 'login-dropdown';
            dropdown.className = 'absolute bg-white border rounded p-4 shadow-lg';
            dropdown.style.top = textarea.offsetTop + textarea.offsetHeight + 'px';
            dropdown.style.left = textarea.offsetLeft + 'px';

            dropdown.innerHTML = `
                        <p class="text-sm mb-2">You must be logged in to leave a comment</p>
                        <a href="{{ route('login', ['redirect' => request()->fullUrl()]) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Log in</a>
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
        @endauth
    </script>

</x-default-layout>
