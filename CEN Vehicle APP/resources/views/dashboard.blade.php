<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-3/4 ">
            <div class="flex  overflow-hidden shadow-sm sm:rounded-lg bg-light">

                <div class="p-6 text-gray-900 flex-1 text-center" style="border-right: 1px solid black;">
                    <b> Total Driver</b><br> {{$total_driver_count}}
                </div>
                <div class="p-6 text-gray-900 flex-1 text-center" style="border-right: 1px solid black;">
                    <b>User Verified</b> <br> {{$total_user_verified}}
                </div>
                <div class="p-6 text-gray-900 flex-1 text-center" style="border-right: 1px solid black;">
                    <b>User not Verified</b> <br> {{$total_user_not_verified}}
                </div>
                <div class="p-6 text-gray-900 flex-1 text-center" style="border-right: 1px solid black;">
                    <b>Active User </b><br> {{$total_user_is_active}}
                </div>
                <div class="p-6 text-gray-900 flex-1 text-center">
                    <b>Total Templates </b><br> {{$total_templates}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>

</style>