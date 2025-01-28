@props([
    'value' => '', // Default to an empty string if not passed
])

<div>
    <x-input-label for="title" :value="__('Title')" />
    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$value" autofocus/>
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>
