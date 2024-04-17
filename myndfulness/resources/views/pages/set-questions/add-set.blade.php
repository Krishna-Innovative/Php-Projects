@extends ('layouts.app')

@section ('title','Questions Group | Create')

@section ('content')
<div class="content-wrapper" >
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-repeat"></i>
            </span> Add Question SET
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{route("dashboard")}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" >
                    <a href="{{route("questions-set.index")}}">Questions Set</a>
                 </li>
                 <li class="breadcrumb-item" aria-current="page">
                    Add Question Set
                 </li>
            </ul>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div  class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header text-right">
                    <a href="{{ route('questions-set.index') }}" type="button" class="btn btn-gradient-primary btn-sm">
                        Manage Question Sets <i class="mdi mdi-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body">
                <h4 class="card-title">ADD QUESTION Set</h4>
                  @livewire('question-set.create-question-set',key('question-set-create'))
              
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script>

</script>
@endpush
