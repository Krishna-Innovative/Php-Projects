<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Drivers') }}
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
                            <a href="/drivers">Drivers </a>
                        </li> 
                    </ul>
                </nav>
        </div>
    </div> -->
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
                    {{ __('Vehicle Information') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Update Vehicle  information.") }}
                </p>
            </header>

        <form method="POST" action="{{ route('vehicles.update',$vehicles->id) }}">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div>
        <div class="flex"><x-input-label for="name" :value="__('Vehicle Name ')" /><span class="asterisk">*</span></div>
            <x-text-input id="vehicle" class="block mt-1 w-full" type="text" name="vehicle" value="{{$vehicles->vehicle}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
        <div class="flex"><x-input-label for="email" :value="__('Vehicle Code ')" /><span class="asterisk">*</span></div>
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" value="{{$vehicles->code}}" required autocomplete="username" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> -->
            <a class="ml-4" href="/vehicles">
                Cancel
            </a>
            <x-primary-button class="ml-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
    </section>
    </div>
        </div>
    </div>
</x-app-layout>