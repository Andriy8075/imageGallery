<x-default-layout>
    @include('layouts.navigation')
    <div class="flex flex-col min-h-screen">
        <!-- Centered Title with reduced gap -->
        <div class="mt-6 mb-2 text-center">
            <h1 class="text-2xl">{{$image->title}}</h1>
        </div>

        <!-- Centered Image (original size) -->
        <div class="mx-4 flex items-center justify-center" style="height: 100vh; overflow: auto;">
            <img
                src="{{ asset('storage/images/' . $image->file_path) }}"
                class="w-auto h-5/6 object-contain"
                style="max-width: 100%"
            >
        </div>

        <!-- Centered Description with reduced gap -->
        <div class="mt-2 mb-6 text-center">
            <h1 class="text-l">{!! nl2br(e($image->description)) !!}</h1>
        </div>

        <!-- Comment form with reduced top gap -->
        <div class="mx-12 mb-8 mt-4">
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
    </div>

    <div id="comments-div" class="m-12 mb-24">
    </div>
    <script>
        const initialData = {
            scrollThreshold: @json(config('comments.scroll_threshold')),
            textArea: document.getElementById('textarea'),
            comments: @json($comments).data,
            nextPage: @json($nextPage),
            imageId: @json($imageId),
            loadMoreUrl: "{{config('images.load_urls.comments')}}",
            @auth
                storeURL: "{{ route('comments.store', $image->id) }}",
                authUserName: "{{ auth()->user()->name }}",
                authUserId: "{{ Auth::id() }}",
            @else
                loginURL: "{{ route('login', ['redirect' => request()->fullUrl()]) }}",
            @endauth
        }
    </script>
    @auth
        @vite('resources/js/comments/addCommentsAuth.js')
    @else
        @vite('resources/js/comments/addCommentsGuest.js')
    @endauth
    @vite('resources/js/comments/loadComments.js')
</x-default-layout>
