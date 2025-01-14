<x-default-layout>
    @include('layouts.navigation')
    @include('images.components.place-images')
{{--    @include('layouts.navigation')--}}
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
{{--        <div id="image-container" class="image-container flex"></div>--}}
{{--    </div>--}}

{{--    <div id="loading" style="display: none; text-align: center;">--}}
{{--        Loading more images...--}}
{{--    </div>--}}

{{--    <script>--}}
{{--        const initialData = {--}}
{{--            images: @json($images),--}}
{{--            imageLoadingConfig: @json(config('image_loading')),--}}
{{--            loadMoreUrl: "{{ url('/load-more-mine') }}",--}}
{{--            noImagesMessage: 'You haven\'t uploaded images yet',--}}
{{--        };--}}
{{--    </script>--}}
{{--    @vite('resources/js/imageDisplaying.js')--}}
</x-default-layout>


{{--<x-default-layout>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>--}}
{{--    @include('layouts.navigation')--}}
{{--    <div x-data="{ show: false }" id="more-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-show="show" x-cloak>--}}
{{--        <div class="bg-white p-6 rounded shadow-lg w-1/3">--}}
{{--            <h2 class="text-lg font-semibold">More Options</h2>--}}
{{--            <p class="mt-4 text-sm text-gray-600">This is your pop-up content. Add more details or actions here.</p>--}}
{{--            <button class="mt-6 px-4 py-2 bg-blue-500 text-white rounded" @click="show = false">Close</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <button id="more-popup-trigger" @click="console.log('Button clicked!'); show = true;" style="display: flex;">Button</button>--}}

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
{{--            imageLoadingConfig: @json(config('image_loading')),--}}
{{--            loadMoreUrl: "{{ url('/load-more-mine') }}",--}}
{{--            noImagesMessage: 'You haven\'t uploaded images yet',--}}
{{--        };--}}
{{--    </script>--}}
{{--    @vite('resources/js/imageDisplaying.js')--}}
{{--</x-default-layout>--}}
