<x-default-layout>
    @include('layouts.navigation')
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
            imageLoadingConfig: @json(config('image_loading')),
            loadMoreUrl: "{{ url('/images/load-more') }}",
            noImagesMessage: 'No images suitable for your search',
        };
    </script>
    @vite('resources/js/imageDisplaying.js')
    @vite('resources/css/styles.css')
</x-default-layout>
