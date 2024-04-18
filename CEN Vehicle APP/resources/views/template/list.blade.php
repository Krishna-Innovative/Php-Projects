
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Templates') }}
        </h2>
        <form method="GET" style="margin-left: auto">
        <div class="input-group mr-5">
          <input 
            type="text" 
            name="search" 
            value="{{ request()->get('search') }}" 
            class="form-control" 
            placeholder="Search..." 
            aria-label="Search" 
            aria-describedby="button-addon2">
          <button class="btn btn-success" type="submit">Search</button>
        </div>
    </form>
        <a href="/templates/create/" class="bg-gray-500 p-2 px-4 text-gray-200" >
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
            <table class="pb-3 table text-left w-full">
                <thead class="bg-gray-800 p text-gray-200 thead-dark">
                    <tr>
                        <th  style="width:20%" scope="col"> Name</th>
                        <th  style="width:50%" scope="col"> Description</th>
                        <th  style="width:20%;text-align:center" scope="col">Template Forms</th>
                        <th  style="width:30%" scope="col"> Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                @if(count($templates) > 0)
            @foreach($templates as $template)
            <tr class="border-b">
                <td style="width:20%">{{$template->name}}</td>
                <td style="width:30%">{{$template->description}}</td>
                <td style="width:20%;text-align:center"class=""> 
                    <a class="btn btn-primary btn-sm text-gray-500" href="/templates/forms/view/{{$template->id}}/"><i class="fa-regular fa-eye"></i></a> 
                </td>
                <td style="width:30%"class="flex"> 
                    <a class="btn btn-primary btn-sm text-gray-500" href="/templates/view/{{$template->id}}">View</a>&nbsp;| <a class="btn btn-primary btn-sm text-gray-500" href="/templates/edit/{{$template->id}}">Edit</a>&nbsp;|&nbsp;
                    <form action="{{ route('templates.destroy', $template->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return deleletconfig();" class="text-gray-500 btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
                
            <tr>
            @endforeach
            @else
            <tr class="text-center"><td colspan="3">No Template records found</td></tr>
            @endif
           
                </tbody>
            </table>
            {{ $templates->links() }}
        </div>
        
    </div>
</x-app-layout>
<script>
     function deleletconfig(){

var del=confirm("Are you sure you want to delete this record?");
if (del==true){
   alert ("Templates record deleted successfully")
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