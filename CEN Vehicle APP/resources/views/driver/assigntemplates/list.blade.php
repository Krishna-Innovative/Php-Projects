<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Templates') }}
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
                        <th style="width:20%" scope="col">Template Name</th>
                        <th style="width:40%" scope="col">Template Description</th>
                        <th style="width:20%" scope="col">View</th>
                        <th style="width:20%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if(count($user_template_listing) > 0)
                    @foreach($user_template_listing as $template_list)
                    <tr class="border-b">
                        <td>{{$template_list['template_details'][0][0]['name']}}</td>
                        <td>{{$template_list['template_details'][0][0]['description']}}</td>
                        <td><a href="/driver/completed-templates/{{$template_list['user_id']}}/{{$template_list['template_id']}}"><i class="fa-regular fa-eye"></i></a></td>
                        <td> {{ $template_list['iscompleted'] =="1" ? 'Completed' : 'In Progress' }}</a></td>
                    <tr>
                        @endforeach
                        @else
                    <tr class="text-center">
                        <td colspan="4">No Template Assign Yet</td>
                    </tr>
                    @endif

                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>