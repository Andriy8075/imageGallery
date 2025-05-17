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
            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                Copy link to this image
            </a>
            @if($images['query'] === 'uploaded')
                <a onclick="openPopup()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                    Delete
                </a>

                <!-- Popup Modal -->
                <div id="popup" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-80">
                        <p class="text-lg font-medium text-gray-900">Delete this image?</p>
                        <div class="flex justify-end mt-4 space-x-4">
                            <button id="delete-confirm-button" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                Delete
                            </button>
                            <button onclick="closePopup()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                    Report
                </a>
            @endif
        </div>
    </div>
</div>
<div class="px-1 sm:px-3">
    <div id="image-container" class="image-container flex">
    </div>
</div>

<div id="loading" style="display: none; text-align: center;">
    Loading more images...
</div>
<script>
    const imageConfigs = @json(config('images'));
    const imagesResponse = @json($images);
    const { query } = imagesResponse;

    const initialData = {
        images: imagesResponse,
        imageMaxWidth: imageConfigs.image_max_width,
        scrollThreshold: imageConfigs.scroll_threshold,
        noImagesText: imageConfigs.no_images_texts[query],
        loadMoreUrl: "{{ url(config('images.load_urls.' . ($images['query']))) }}",
        indexUrl: "{{url('/')}}",
        logged: {{ Auth::check() ? 'true' : 'false' }},
        query,
    };

    function openPopup() {
        document.getElementById('popup').classList.remove('hidden');
    }

    function closePopup() {
        document.getElementById('popup').classList.add('hidden');
    }
</script>
@vite('resources/js/images/main.js')
