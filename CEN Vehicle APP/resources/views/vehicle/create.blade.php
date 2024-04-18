<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Vehicle') }}
        </h2>
       
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 w-3/4">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Vehicle Information') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 mb-3">
                    {{ __("Add a new Vehicle.") }}
                </p>
            </header>
        <form method="POST" action="{{route('vehicles.create')}}">
        @csrf
        <!-- Name -->
        <div class="pb-3">
            <div class="flex">
                <x-input-label for="name" :value="__('Enter Vehicle Name ')" /><span class="asterisk">*</span>
            </div>
            <x-text-input id="vehicle_name" class="block mt-1 w-full" type="text" name="vehicle_name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
            <div class="flex ">
            <x-input-label for="name" :value="__('Enter Vehicle Code ')" /><span class="asterisk">*</span></div>
            <x-text-input id="vehicle_code" class="block mt-1 w-full" type="text" name="vehicle_code" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        <div class="flex items-center justify-end mt-4">
            <a class="ml-4" href="/vehicles">
                {{ __('Cancel') }}
            </a>
            <x-primary-button class="ml-4">
                {{ __('Add Vehicles') }}
            </x-primary-button>
        </div>
    </form>
    </section>
    </div>
        </div>
    </div>
</x-app-layout>