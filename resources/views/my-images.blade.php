<x-default-layout>
@include('layouts.navigation')
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
            loadMoreUrl: "{{ url('/load-more-mine') }}",
            noImagesMessage: 'You haven\'t uploaded images yet',
        };
    </script>
    @vite('resources/js/imageDisplaying.js')
</x-default-layout>
