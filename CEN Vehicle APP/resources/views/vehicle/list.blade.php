<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight w-20">
            {{ __('Vehicle') }}
        </h2>
        <form method="GET" style="margin-left: auto;visibility:hidden;">
        <div class="input-group mr-5">
          <input 
            type="text" 
            name="search" 
            value="{{ request()->get('search') }}" 
            class="form-control" 
            placeholder="Search..." 
            aria-label="Search" 
            aria-describedby="button-addon2">
          <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
        </div>
    </form>
        <a href="/vehicle/create/" class="bg-gray-500 p-2 px-4 text-gray-200" >
            + Add New Vehicle
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
                        <th  style="width:20%" scope="col">Vehicle Name</th>
                        <th  style="width:20%" scope="col">Vehicle code</th>
                        <th  style="width:20%" scope="col">Vehicle Action</th>
                    </tr>
                </thead>
                <tbody>
                   
            @if(count($vehicles) > 0)
            @foreach($vehicles as $vehicle)
            
            <tr class="border-b">
                <td style="width:20%">{{$vehicle->vehicle}}</td>
                <td style="width:20%">{{$vehicle->code}}</td>
                <td class="flex"><a class="btn btn-primary btn-sm text-gray-500" href="/vehicle/view/{{$vehicle->id}}">View</a>&nbsp;| <a class="btn btn-primary btn-sm text-gray-500" href="/vehicle/edit/{{$vehicle->id}}">Edit</a>&nbsp;|&nbsp;
                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="return deleletconfig();" class="text-gray-500 btn btn-danger btn-sm">Delete</button>
                </form></td>
            <tr>
            @endforeach
            @else
            <tr class="text-center"><td colspan="3">No driver record found</td></tr>
            @endif
           
            </tbody>
            </table>
            {{$vehicles->links()}}
        </div>
       
    </div>
</x-app-layout>
<script>
     function deleletconfig(){

var del=confirm("Are you sure you want to delete this record?");
if (del==true){
   alert ("Vehicle record deleted successfully")
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