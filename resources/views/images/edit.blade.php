<x-default-layout>
    @include('layouts.navigation')
    <div class="flex justify-center w-full pb-3">
        <div class="flex flex-col w-1/3">
            <form method="POST" action="{{ route('images.update', ['image' => $image]) }}" enctype="multipart/form-data" class="w-full">
                @csrf
                @method('PATCH')

                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$image->title"/>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$image->description"/>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div id="imagePreview" class="mt-4">
                    <img id="previewImage" src="{{ asset('storage/images/' . $image->file_path) }}" alt="Image Preview" class="max-w-full h-auto rounded-md border border-gray-300">
                </div>

                <div class="flex items-center justify-end mt-4">

                    <x-primary-button class="ms-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>
            @if (session('success'))
                <div class="p-4 mt-2 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    <p>Image uploaded successfully</p>
                </div>
            @endif
        </div>
    </div>
</x-default-layout>
