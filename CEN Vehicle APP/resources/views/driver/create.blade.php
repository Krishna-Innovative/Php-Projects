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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 w-3/4">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Profile Information') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 mb-3">
                            {{ __("Create a new driver profile information and email address.") }}
                        </p>
                    </header>
                    <form method="POST" action="{{ route('drivers.create') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <div class="flex"><x-input-label for="name" :value="__('Name ')" /><span class="asterisk">*</span></div>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <div class="flex"><x-input-label for="email" :value="__('Email ')" /><span class="asterisk">*</span></div>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <div class="flex"><x-input-label for="phone" :value="__('Phone ')" /><span class="asterisk">*</span></div>
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <div class="flex"><x-input-label for="password" :value="__('Password ')" /><span class="asterisk">*</span></div>

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <div class="flex"><x-input-label for="password_confirmation" :value="__('Confirm Password ')" /><span class="asterisk">*</span></div>

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <div class="flex"><x-input-label for="vehicle_1" :value="__('Vehicle 1 ')" /><span class="asterisk">*</span></div>
                            <!-- <x-text-input id="vehicle_1" class="block mt-1 w-full" type="text" name="vehicle_1" :value="old('vehicle_1')"   /> -->
                            <select id="vehicle_1" class="block mt-1 w-full" name="vehicle_1" required>
                                <option value="">Choose any Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                <option value="{{$vehicle->code}}" {{ old('vehicle_1') == $vehicle->code ? "selected" :""}}>{{$vehicle->vehicle}}</option>
                                @endforeach
                            </select>
                            <!-- <x-input-error :messages="$errors->get('vehicle_1')" class="mt-2" /> -->
                        </div>

                        <div class="mt-4">
                            <div class="flex"><x-input-label for="vehicle_2" :value="__('Vehicle 2')" /></div>
                            <!--<x-text-input id="vehicle_2" class="block mt-1 w-full" type="text" name="vehicle_2" :value="old('vehicle_2')"   />-->
                            <select id="vehicle_2" class="block mt-1 w-full" type="text" name="vehicle_2">
                                <option value="">Choose any Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                <option value="{{$vehicle->code}}" {{ old('vehicle_2') == $vehicle->code ? "selected" :""}}>{{$vehicle->vehicle}}</option>
                                @endforeach
                            </select>
                            <!-- <x-input-error :messages="$errors->get('vehicle_1')" class="mt-2" /> -->
                        </div>

                        <div class="mt-4">
                            <div class="flex"><x-input-label for="vehicle_3" :value="__('Vehicle 3 ')" /></div>
                            <!--<x-text-input id="vehicle_3" class="block mt-1 w-full" type="text" name="vehicle_3" :value="old('vehicle_3')"   />-->
                            <select id="vehicle_3" class="block mt-1 w-full" type="text" name="vehicle_3">
                                <option value="">Choose any Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                <option value="{{$vehicle->code}}" {{ old('vehicle_3') == $vehicle->code ? "selected" :""}}>{{$vehicle->vehicle}}</option>
                                @endforeach
                            </select>
                            <!-- <x-input-error :messages="$errors->get('vehicle_1')" class="mt-2" /> -->
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> -->
                            <a class="ml-4" href="/drivers">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button class="ml-4">
                                {{ __('Add') }}
                            </x-primary-button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>