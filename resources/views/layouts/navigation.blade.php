<div class="flex justify-between items-center space-x-4 w-full">
    <div class="px-5 py-4">
        <a href="{{ route('images') }}">
            <button class="bg-gray-300 text-black px-4 py-2 rounded-xl">
                Home
            </button>
        </a>
    </div>

    <div class="px-5 py-4">
        <a href="{{ route('images.create') }}">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-xl">
                Upload Image
            </button>
        </a>
    </div>

    <div class="flex-1 flex items-center bg-gray-100 rounded-xl px-3 py-2 mx-4">
        <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none text-sm w-full">
    </div>
    @guest
        @if (Route::has('login'))
            <nav class=" flex flex-1 justify-end px-10 py-4">
                <x-nav-link href="{{ route('login') }}">Login</x-nav-link>
                @if (Route::has('register'))
                    <x-nav-link href="{{ route('register') }}">Register</x-nav-link>
                @endif
            </nav>
        @endif
    @else
        <div class="px-5 py-4">
            <div class="w-min bg-gray-100 rounded-3xl px-3 py-2">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex flex-row">
                            <div class="xl: text-xl">{{ Auth::user()->name }}</div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="34">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('images.uploaded')">
                            {{ __('Uploaded') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('images.liked')">
                            {{ __('Liked') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    @endguest
</div>
