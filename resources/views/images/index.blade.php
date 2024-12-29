<x-default-layout>
    <div class="p-5 sm:p-8">
        <div id="image-container" class="image-container flex">
        </div>
    </div>

    <div id="loading" style="display: none; text-align: center;">
        Loading more images...
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        const initialData = {
            images: @json($images),
            imageLoadingConfig: @json(config('image_loading')),
            loadMoreUrl: "{{ url('/images/load-more') }}",
        };
    </script>
    @vite('resources/js/imageDisplaying.js')
</x-default-layout>
