<x-default-layout>
    <div x-data="{ show: false }">
        <!-- Button -->
        <button id="dropdown-trigger"
                @click="show = !show"
                class="hidden">
            Dropdown
        </button>

        <!-- Dropdown -->
        <div x-show="show" id="dropdown"
             class="absolute mt-2 bg-white border border-gray-200 rounded-md z-10"
             @click.outside="show = false"
             x-cloak>
            <div class="py-1">
                <script>
                    somefunction = () => {
                        console.log('betr')
                    }
                </script>
                <a onclick="somefunction()" class="block px-4 py-2 text-sm text-gray-700 cursor-pointer">
                    Copy link to this image
                </a>
                @if($images['mine'])
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Delete
                    </a>
                @else
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Report
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="p-5 sm:p-8">
        <div id="image-container" class="image-container flex">
        </div>
    </div>

    <div id="loading" style="display: none; text-align: center;">
        Loading more images...
    </div>
    <script>
        const initialData = {
            images: @json($images),
            imageLoadingConfig: @json(config('images')),
            loadMoreUrl: "{{ url(config('images.load_urls.' . ($images['mine'] ? 'mine' : 'default'))) }}",
            noImagesMessage: "{{ config('images.no_images_texts.' . ($images['mine'] ? 'mine' : 'default')) }}",
        };
    </script>
    @vite('resources/js/imageDisplaying.js')
</x-default-layout>
