
<div class="card-body table-responsive">
    <div class="row">
        <div class="col-md-6">
            <h4 class="card-title">QUESTION SETS</h4>
        </div>
      @if (!$groups->count())
       <div class="col-md-6 text-right">
            <a href="{{route('questions.add')}}" class="btn btn-gradient-success btn-sm mr-2 {{$groups}}">Add Question <i class="mdi mdi-arrow-right"></i> </a>
        </div>
     @endif 
    </div>
  @if ($groups->count())
        <table class="table table-hover" wire:loading.class='loading'>
            <thead>
                <tr>
                    <th>#</th>
                   <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                        <td>{{ $group->question }}</td>
                        <td>  <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                
                                <button type="button" wire:click="$emit('delete',{{$group->id}})" class="btn btn-outline-danger btn-sm" title="Delete"><i class="mdi mdi-delete "></i></button>
                            </div> </td>
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-primary d-flex justify-content-end mt-2">
           
        </div>
     @else
        <x-not-found :title="'No Question Found'" size="400"></x-not-found>
    @endif
</div>
