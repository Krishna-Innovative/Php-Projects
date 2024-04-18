<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Templates') }}
        </h2>

    </x-slot>
    <!-- <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8 space-y-6 w-3/4">
                    <nav>
                        <ul class="breadcrumbs flex">
                            <li class="breadcrumb-item pl-0">
                                <a href="/">Home /</a>
                            </li>    
                            <li class="breadcrumb-item pl-0">
                                <a href="/templates">Templates /</a>
                            </li> 
                        </ul>
                    </nav>
            </div>
        </div> -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 w-3/4">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Template Information') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 mb-3">
                            {{ __("Create a new driver template.") }}
                        </p>
                    </header>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li style="color:red;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{route('templates.create')}}">
                        @csrf

                        <!-- Name -->
                        <div class="pb-3">
                            <div class="flex">
                                <x-input-label for="name" :value="__('Enter Template Name ')" /><span class="asterisk">*</span>
                            </div>
                            <x-text-input id="template_name" class="block mt-1 w-full" type="text" name="template_name" :value="old('template_name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="pb-3">
                            <div class="flex ">
                                <x-input-label for="name" :value="__('Enter Template Description ')" /><span class="asterisk">*</span>
                            </div>
                            <textarea class="border-gray-300 pb-3 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="template_description" id="template_description">{{old('template_description')}}</textarea>
                        </div>
                        <div class="pb-3">
                            <div class="flex">
                                <x-input-label for="name" :value="__('Enter Number of from ')" /><span class="asterisk">*</span>
                            </div>
                            <x-text-input id="template_count" class="block mt-1 w-full" type="number" name="template_count" :value="old('template_count')" required />
                            <x-input-label for="name" :value="__('Form length should be 2 to 16')" />
                        </div>
                        <div class="pb-3">
                            <div class="flex">
                                <x-input-label for="Drivers" :value="__('Assign Template to Drivers ')" />
                                <span class="asterisk">*</span>
                            </div>
                            <select id="drivers_list" class="block mt-1 w-full" name="drivers_list[]" required multiple>
                                <option value="">Choose any Drivers</option>
                                @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            <x-input-label for="name" :value="__('Press CTRL Button and Assign Same Template to Multiple Drivers')" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a class="ml-4" href="/templates">
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