<x-default-layout>
    @include('layouts.navigation')
    <img src="{{ asset('storage/' . $image->file_path) }}">
</x-default-layout>
