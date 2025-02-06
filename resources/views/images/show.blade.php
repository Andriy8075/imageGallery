<x-default-layout>
    @include('layouts.navigation')
    <div class="m-12">
        <h1 class="text-2xl">{{$image->title}}</h1>
    </div>

    <div class="mx-4">
        <img src="{{ asset('storage/images/' . $image->file_path) }}" class="w-full h-auto">
    </div>

    <div class="m-12">
        <h1 class="text-l">{!! nl2br(e($image->description)) !!}</h1>
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
{{--        @foreach ($comments as $comment)--}}
{{--            <div class="m-4">--}}
{{--                <strong class="text-2xl">{{ $comment->user->name }}:</strong> <!-- Assuming the comment has a user relationship -->--}}
{{--                <p class="text-xl break-words">{!! nl2br(e($comment->text)) !!}</p>--}}
{{--            </div>--}}
{{--        @endforeach--}}
    </div>
    <script>
        const initialData = {
            scrollThreshold: @json(config('comments.scroll_threshold')),
            textArea: document.getElementById('textarea'),
            comments: @json($comments->map(function ($comment) {
                return [
                    'name' => $comment->user->name,
                    'text' => $comment->text
                ];
            })),
            hasMorePages: "{{$comments->hasMorePages()}}",
            @auth
                storeURL: "{{ route('comments.store', $image->id) }}",
                authUserName: "{{ auth()->user()->name }}",
            @else
                loginURL: "{{ route('login', ['redirect' => request()->fullUrl()]) }}",
            @endauth
        }
    </script>
    @auth
        @vite('resources/js/addCommentsAuth.js')
    @else
        @vite('resources/js/addCommentsGuest.js')
    @endauth

    @vite('resources/js/loadComments.js')
{{--    <script>--}}
{{--        const textarea = document.getElementById('textarea');--}}
{{--    </script>--}}
{{--    @auth--}}
{{--        <script>--}}
{{--            const initialData = {--}}
{{--                storeURL: "{{ route('comments.store', $image->id) }}",--}}
{{--                authUserName: "{{ auth()->user()->name }}",--}}
{{--            }--}}
{{--        </script>--}}
{{--        @vite('resources/js/addCommentsAuth.js')--}}
{{--    @else--}}
{{--        <script>--}}
{{--            const initialData = {--}}
{{--                loginURL: "{{ route('login', ['redirect' => request()->fullUrl()]) }}",--}}
{{--            }--}}
{{--        </script>--}}
{{--        @vite('resources/js/addCommentsGuest.js')--}}
{{--    @endauth--}}

{{--    <script>--}}
{{--        const comments = @json($comments->map(function ($comment) {--}}
{{--        return [--}}
{{--            'name' => $comment->user->name,--}}
{{--            'text' => $comment->text--}}
{{--    ];--}}
{{--    }));--}}
{{--        --}}
{{--    </script>--}}
{{--    @vite('resources/js/loadComments.js')--}}
</x-default-layout>
