<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Templates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @else
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-3/4">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="pb-3">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Templates View Information') }}
                        </h2>
                        <!-- 
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("View driver's profile information, email address and others.") }}
                </p> -->
                    </header>
                    <div class="flex">
                        <a href="/templates/edit/{{$templates->id}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4" style="margin-left: auto;">
                            Edit
                        </a>
                    </div>
                    <div class="pb-3">
                        <x-input-label for="name" :value="__('Template Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" readonly type="text" name="name" value="{{$templates->name}}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="pb-3">
                        <div class="flex ">
                            <x-input-label for="name" :value="__('Template Description ')" /><span class="asterisk">*</span>
                        </div>
                        <textarea readonly class="border-gray-300 pb-3 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="template_description" id="template_description">{{$templates->description}}</textarea>

                    </div>
                    <div class="pb-3">
                        <x-input-label for="name" :value="__('Number of forms')" />
                        <x-text-input id="form_count" min="2" readonly max="16" class="block mt-1 w-full" type="number" name="form_count" value="{{$templates->form_count}}" readonly autofocus autocomplete="name" />
                        <x-input-label for="name" :value="__('Form length should be 2 to 16')" />
                    </div>
                    <div class="pb-3">
                        <div class="flex">
                            <x-input-label for="Drivers" :value="__('Update Templates to Drivers ')" />
                            <span class="asterisk">*</span>
                        </div>
                        <input id="template__id" class="block mt-1 w-full" type="hidden" name="template__id" value="{{$templates->id}}" />
                        <select id="drivers_list" class="block mt-1 w-full" name="drivers_list[]" required multiple disabled>
                            <option value="">Choose any Drivers</option>
                            @foreach($drivers as $driver)
                            @if(in_array($driver->id, $selecteddriver))
                            <option value="{{ $driver->id }}" selected>{{ $driver->name }}</option>
                            @else
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>
</x-app-layout>