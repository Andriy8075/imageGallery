<x-default-layout>
    @include('layouts.navigation')

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Statistics</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Images</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($statistics['totalImages']) }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($statistics['totalUsers']) }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Likes</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($statistics['totalLikes']) }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Comments</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($statistics['totalComments']) }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Most Liked Image</h2>
                    @if($statistics['mostLikedImage'])
                        <a href="{{ route('images.show', $statistics['mostLikedImage']) }}" class="block group">
                            <img
                                src="{{ asset('storage/images/' . $statistics['mostLikedImage']->file_path) }}"
                                alt="{{ $statistics['mostLikedImage']->title }}"
                                class="w-full h-48 object-cover rounded-lg group-hover:opacity-90 transition"
                            >
                            <p class="mt-2 font-medium text-gray-900 dark:text-white group-hover:text-blue-600">{{ $statistics['mostLikedImage']->title ?? 'Untitled' }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $statistics['mostLikedImage']->liked_by_users_count }} likes</p>
                        </a>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No images yet</p>
                    @endif
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Most Commented Image</h2>
                    @if($statistics['mostCommentedImage'])
                        <a href="{{ route('images.show', $statistics['mostCommentedImage']) }}" class="block group">
                            <img
                                src="{{ asset('storage/images/' . $statistics['mostCommentedImage']->file_path) }}"
                                alt="{{ $statistics['mostCommentedImage']->title }}"
                                class="w-full h-48 object-cover rounded-lg group-hover:opacity-90 transition"
                            >
                            <p class="mt-2 font-medium text-gray-900 dark:text-white group-hover:text-blue-600">{{ $statistics['mostCommentedImage']->title ?? 'Untitled' }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $statistics['mostCommentedImage']->comments_count }} comments</p>
                        </a>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No images yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
