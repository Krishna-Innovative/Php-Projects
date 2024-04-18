<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Media') }}
        </h2>
       
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 w-3/4">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Media Information') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 mb-3">
                    {{ __("Upload a new Media template.") }}
                </p>
            </header>
        <form method="POST" action="">
        @csrf

        <!-- Name -->
        <div>
        <div class="flex"><x-input-label for="name" :value="__('Enter Template Name ')" /><span class="asterisk">*</span></div>
            <x-text-input id="template_name" class="block mt-1 w-full" type="text" name="template_name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> -->
            <a class="ml-4" href="/drivers">
                {{ __('Cancel') }}
            </a>
            <x-primary-button class="ml-4">
                {{ __('Add Templates') }}
            </x-primary-button>
        </div>
    </form>
    </section>
    </div>
        </div>
    </div>
</x-app-layout>