<!-- <script>// Initialization for ES Users

</script> -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Templates') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-3/4">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="pb-3">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Templates Information') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">Update Templates Informations</p>
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
                    <form method="POST" action="{{ route('templates.update',$templates->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="pb-3">
                            <div class="flex">
                                <x-input-label for="name" :value="__('Template Name')" /><span class="asterisk">*</span>
                            </div>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$templates->name}}" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="pb-3">
                            <div class="flex">
                                <x-input-label for="name" :value="__('Template Description')" /><span class="asterisk">*</span>
                            </div>
                            <textarea class="border-gray-300 pb-3 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="description" id="description">{{$templates->description}}</textarea>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="pb-3">
                            <div class="flex">
                                <x-input-label for="name" :value="__('Number of forms')" /><span class="asterisk">*</span>
                            </div>
                            <x-text-input id="form_count" min="2" max="16" class="block mt-1 w-full" type="number" name="form_count" value="{{$templates->form_count}}" readonly autofocus autocomplete="name" />
                            <x-input-label for="name" :value="__('Form length should be 2 to 16')" />
                        </div>
                        <div class="flex"><x-input-label for="Drivers" :value="__('Update Templates to Drivers ')" /><span class="asterisk">*</span></div>
                        <input id="template__id" class="block mt-1 w-full" type="hidden" name="template__id" value="{{$templates->id}}" />
                        <select id="drivers_list" class="block mt-1 w-full" name="drivers_list[]" required multiple>
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
            <div class="flex items-center justify-end mt-4">
                <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> -->
                <a class="ml-4" href="/templates">
                    Cancel
                </a>
                <x-primary-button class="ml-4">
                    {{ __('Update ') }}
                </x-primary-button>
            </div>
            </form>

            </section>
        </div>
    </div>
    </div>
    <!-- Modal -->

    </div>
</x-app-layout>

<style>
    div#exampleModal {
        top: 90px;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>