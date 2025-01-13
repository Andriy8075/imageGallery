<x-default-layout>
{{--    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>--}}
    @include('layouts.navigation')

{{--    <x-dropdown align="right" width="48">--}}
{{--        <x-slot name="trigger">--}}
{{--            <button class="inline-flex flex-row" id="more-popup-trigger">--}}
{{--                <div class="xl: text-xl">{{ Auth::user()->name }}</div>--}}

{{--                <div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="34">--}}
{{--                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--            </button>--}}
{{--        </x-slot>--}}

{{--        <x-slot name="content">--}}
{{--            <x-dropdown-link :href="route('profile.edit')">--}}
{{--                {{ __('Profile') }}--}}
{{--            </x-dropdown-link>--}}

{{--            <x-dropdown-link :href="route('my-images')">--}}
{{--                {{ __('My images') }}--}}
{{--            </x-dropdown-link>--}}
{{--            <!-- Authentication -->--}}
{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}

{{--                <x-dropdown-link :href="route('logout')"--}}
{{--                                 onclick="event.preventDefault();--}}
{{--                                                        this.closest('form').submit();">--}}
{{--                    {{ __('Log Out') }}--}}
{{--                </x-dropdown-link>--}}
{{--            </form>--}}
{{--        </x-slot>--}}
{{--    </x-dropdown>--}}
{{--    <div x-data="{ show: false }">--}}
{{--        <!-- Popup -->--}}
{{--        <div id="more-popup"--}}
{{--             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-30"--}}
{{--             x-show="show"--}}
{{--             x-cloak>--}}
{{--            <div class="bg-white p-6 rounded shadow-lg w-1/3">--}}
{{--                <h2 class="text-lg font-semibold">More Options</h2>--}}
{{--                <p class="mt-4 text-sm text-gray-600">This is your pop-up content. Add more details or actions here.</p>--}}
{{--                <button class="mt-6 px-4 py-2 bg-blue-500 text-white rounded"--}}
{{--                        @click="show = false">Close</button>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Button -->--}}
{{--        <button id="more-popup-trigger" @click="show = true;" class="hidden"></button>--}}
{{--    </div>--}}
    <div x-data="{ show: false }" class="relative inline-block text-left">
        <!-- Button -->
        <button id="dropdown-trigger"
                @click="show = !show"
                class="px-4 py-2 bg-green-500 text-white rounded">
            Dropdown
        </button>

        <!-- Dropdown -->
        <div x-show="show"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10"
             @click.outside="show = false"
             x-cloak>
            <div class="py-1">
                <button class="hover:bg-gray-100 text-amber-300">Click</button>
                <a href="#" class="block px-4 py-2 text-sm text-amber-50 hover:bg-gray-100 z-20">
                    Option 1
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Option 2
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Option 3
                </a>
            </div>
        </div>
    </div>


    <div class="p-5 sm:p-8">
        <div id="image-container" class="image-container flex"></div>
    </div>

    <div id="loading" style="display: none; text-align: center;">
        Loading more images...
    </div>

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
