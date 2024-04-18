<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Drivers') }}
        </h2>
        <form method="GET" style="margin-left: auto">
            <div class="input-group mr-5">
                <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <a href="/driver/create/" class="bg-gray-500 p-2 px-4 text-gray-200">
            + Add
        </a>

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
            <table class="pb-3 table text-left w-full data_table">
                <thead class="bg-gray-800 p text-gray-200 thead-dark">
                    <tr>
                        <th style="width:30%" scope="col">Name</th>
                        <th style="width:20%" scope="col">Email</th>
                        <th style="text-align: center;width:10%;" scope="col">Assign Templates</th>
                        <th style="width:30%" scope="col">Isverified</th>
                        <th style="width:20%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($drivers) > 0)
                    @foreach($drivers as $driver)
                    <tr class="border-b">
                        <td style="width:30%">{{$driver->name}}</td>
                        <td style="width:20%">{{$driver->email}}</td>
                        <td style="text-align: center;width:30%;"><a class="view_btn" href="/driver/assign-templates/{{$driver->id}}"><i class="fa-regular fa-eye"></i> </a></td>
                        <td style="width:30%" scope="col">{{ $driver->email_verified_at=="" ? 'No' : 'Yes' }}</th>
                        <td style="width:20%" class="flex"><a class="view_link btn btn-primary btn-sm text-gray-500" href="/driver/view/{{$driver->id}}">View</a>&nbsp;| <a class="btn btn-primary btn-sm text-gray-500" href="/driver/edit/{{$driver->id}}">Edit</a>&nbsp;|&nbsp;
                            <form action="{{ route('drivers.isactive', $driver->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{$driver->is_active==0?$status=0:$status=1}}" name="is_active">
                                <button type="submit" onclick="return IsuserActive(<?php echo $status; ?>);" class="text-gray-500 btn btn-danger btn-sm">{{$driver->is_active==0?'Active':'Inactive'}}</button>
                            </form>
                        </td>
                    <tr>
                        @endforeach
                        @else
                    <tr class="text-center">
                        <td colspan="3">No driver record found</td>
                    </tr>
                    @endif

                </tbody>
            </table>
            {{$drivers->links()}}
        </div>

    </div>
</x-app-layout>
<script>
    /*function deleletconfig() {

        var del = confirm("Are you sure you want to delete this record?");
        if (del == true) {
            alert("Driver record deleted successfully")
        }
        return del;
    }*/
    function IsuserActive(status) {
        if (status == 0) {
            var user_status = "InActive";
        } else {
            var user_status = "Active";
        }

        var del = confirm("Are you sure you want to " + user_status + " the user status ?");
        if (del == true) {
            alert("Driver record status is updated successfully")
        }
        return del;
    }
</script>
<style>
    span.relative.inline-flex.items-center.px-4.py-2.-ml-px.text-sm.font-medium.text-gray-500.bg-white.border.border-gray-300.cursor-default.leading-5 {
        color: #1f2937;
        font-size: 16px;
        font-weight: bolder;
    }
</style>