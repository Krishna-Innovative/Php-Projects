<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forms List By Drivers') }}
        </h2>
        <form method="GET" style="margin-left: auto; visibility:hidden;">
            <div class="input-group mr-5">
                <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
    </x-slot>
    <div class="py-4">
        <!-- @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @else
    <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-3/4">
            <table class="pb-3 table text-left w-full">
                <thead class="bg-gray-800 p text-gray-200 thead-dark">
                    <tr>
                        <th style="width:10%" scope="col">Sr No.</th>
                        <th style="width:20%" scope="col">Template Name</th>
                        <th style="width:30%" scope="col">Form List</th>
                        <th style="width:20%" scope="col">Status </th>
                        <th style="width:20%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($number_of_form_filled_by_user) > 0)
                    @foreach($number_of_form_filled_by_user as $key=>$form_filled_by_user)
                    <tr class="border-b">
                        <td>{{$key+1}}</td>
                        <td scope="col">{{ $form_filled_by_user['template_name']}}</th>
                        <td><a href="/driver/completed-templates/{{$form_filled_by_user['user_id']}}/{{$form_filled_by_user['template_id']}}/{{$form_filled_by_user['form_number']}}"><i class="fa-regular fa-eye"></i></a></td>
                        <td> {{ $form_filled_by_user['iscompleted'] =="1" ? 'Completed' : 'In Progress' }}</a></td>
                        <td> <a href="{{ $form_filled_by_user['pdf']}}">View PDF</a></td>
                    <tr>
                        @endforeach
                        @else
                    <tr class="text-center">
                        <td colspan="4">No Driver Filled Any Template Form Yet</td>
                    </tr>
                    @endif

                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>