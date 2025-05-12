<x-default-layout>
    @include('layouts.navigation')
    <div class="flex justify-center w-full pb-3">
        <div class="flex flex-col w-full xs:w-5/6 sm:w-3/4 md:w-2/3 lg:w-1/2 xl: px-4 xs:px-0">
            <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data" class="w-full">
                @csrf

                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" autofocus/>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description (not necessary)')" />
                    <x-textarea-input id="description" class="block mt-1 w-full" name="description" rows="8">{{ old('description') }}</x-textarea-input>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="image" :value="__('Upload Image')" />
                    <input id="image_input" accept="image/*" class="block mt-1 w-full" type="file" name="image" required/>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div id="imagePreview" class="mt-4">
                    <img id="previewImage" src="" alt="Image Preview" class="hidden max-w-full h-auto rounded-md border border-gray-300">
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
    <script>
        document.getElementById('image_input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('previewImage');

            if (file) {
                const reader = new FileReader();

                reader.readAsDataURL(file);

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                };
            } else {
                previewImage.src = '';
                previewImage.classList.add('hidden');
            }
        });
    </script>
</x-default-layout>
