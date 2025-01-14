<x-default-layout>
    @include('layouts.navigation')
    @include('images.components.place-images')
{{--    <div x-data="{ show: false }">--}}
{{--        <!-- Button -->--}}
{{--        <button id="dropdown-trigger"--}}
{{--                @click="show = !show"--}}
{{--                class="hidden">--}}
{{--            Dropdown--}}
{{--        </button>--}}

{{--        <!-- Dropdown -->--}}
{{--        <div x-show="show" id="dropdown"--}}
{{--             class="absolute mt-2 bg-white border border-gray-200 rounded-md z-10"--}}
{{--             @click.outside="show = false"--}}
{{--             x-cloak>--}}
{{--            <div class="py-1">--}}
{{--                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">--}}
{{--                    Option 2--}}
{{--                </a>--}}
{{--                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">--}}
{{--                    An option with long text inside--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="p-5 sm:p-8">--}}
{{--        <div id="image-container" class="image-container flex">--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div id="loading" style="display: none; text-align: center;">--}}
{{--        Loading more images...--}}
{{--    </div>--}}
{{--    <script>--}}
{{--        const initialData = {--}}
{{--            images: @json($images),--}}
{{--            imageLoadingConfig: @json(config('images')),--}}
{{--            loadMoreUrl: "{{ url('/images/load-more') }}",--}}
{{--            noImagesMessage: 'No images suitable for your search',--}}
{{--        };--}}
{{--    </script>--}}
{{--    @vite('resources/js/imageDisplaying.js')--}}
</x-default-layout>
