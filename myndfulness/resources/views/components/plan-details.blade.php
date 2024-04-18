@props([
    "plan"
])
<table class="table table-bordered">
    <tbody>
        <tr>
            <th>Name</th>
            <td>{{$plan->name}}</td>
            <th>Description</th>
            <td>{{$plan->description}}</td>
        </tr>
        <tr>
            <th>Type</th>
            <td>{{$plan->typeString()}}</td>
            <th>Price</th>
            <td>{{config("modules.currency")}}{{$plan->price}}</td>
        </tr>
        <tr>
            <th>Duration</th>
            <td>{{$plan->durationString()}}</td>
            <th></th>
            <td></td>
        </tr>
        <tr>
            <th>H</th>
            <td>{{$plan->typeString()}}</td>
            <th>Price</th>
            <td>{{config("modules.currency")}}{{$plan->price}}</td>
        </tr>
    </tbody>
</table>