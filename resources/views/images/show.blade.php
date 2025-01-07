<x-default-layout>
    @include('layouts.navigation')
    <img src="{{ asset('storage/images/' . $image->file_path) }}">
</x-default-layout>
