<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Drivers') }}
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
    <!-- <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6 w-3/4">
                <nav>
                    <ul class="breadcrumbs flex">
                        <li class="breadcrumb-item pl-0">
                            <a href="/">Home /</a>
                        </li>    
                        <li class="breadcrumb-item pl-0">
                            <a href="/vehicles">Vehicles </a>
                        </li> 
                    </ul>
                </nav>
        </div>
    </div> -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-3/4">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <section>
            <header class="pb-3">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Vehicle Information') }}
                </h2>
<!-- 
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("View driver's profile information, email address and others.") }}
                </p> -->
            </header>
            <div class="flex">
            <a href="/vehicle/edit/{{$vehicles->id}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4" style="margin-left: auto;" >
            Edit
            </a>
            </div>
           

        <div>
            <x-input-label for="name" :value="__('Vehicle Name')" />
            <x-text-input id="name" readonly class="block mt-1 w-full" type="text" name="name" value="{{$vehicles->vehicle}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Vehicle Code')" />
            <x-text-input id="text" readonly class="block mt-1 w-full" type="email" name="email" value="{{$vehicles->code}}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

    </section>
    </div>
        </div>
    </div>
</x-app-layout>