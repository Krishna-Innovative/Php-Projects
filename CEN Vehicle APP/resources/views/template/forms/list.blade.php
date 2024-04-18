<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Templates Forms') }}
        </h2>

        <form method="GET" style="margin-left: auto;visibility: hidden;">
            <div class="input-group mr-5">
                <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        @if($show_new_form==0)
        <a href="/templates/{{$id}}/create/" class="bg-gray-500 p-2 px-4 text-gray-200">
            + Create Forms Fields
        </a>
        @endif
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-3/4">
            <table class="pb-3 table text-left w-full">
                <thead class="bg-gray-800 p text-gray-200 thead-dark">
                    <tr>
                        <th style="width:80%" scope="col"> Name</th>
                        <th style="width:30%" scope="col"> Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if($forms_count > 0)
                    @foreach($get_data as $key=>$data)
                    <tr class="border-b">
                        <td style="width:20%">form {{$key+1}} </td>
                        <td style="width:30%" class="flex">
                            <a class="btn btn-primary btn-sm text-gray-500" href="/templates/{{$id}}/edit/{{$data['form_id']}}">Edit</a>
                            @if($forms_count>2)
                            &nbsp;|&nbsp;
                            <form action="{{ route('templates.forms.destroy', $key) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="delete_form" value="{{$id}}">
                                <button type="submit" onclick="return deleletconfig();" class="text-gray-500 btn btn-danger btn-sm">Delete</button>
                            </form>
                            @endif
                        </td>
                    <tr>
                        @endforeach
                        @else
                    <tr class="text-center">
                        <td colspan="3">No Template records found</td>
                    </tr>
                    @endif

                </tbody>
            </table>
            <p style="text-align:center;">Note: Deleted form will affect all assigned Driver Templates</p>
        </div>

    </div>
</x-app-layout>
<script>
    function deleletconfig() {

        var del = confirm("Are you sure you want to delete this record?");
        if (del == true) {
            alert("Template forms record deleted successfully")
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