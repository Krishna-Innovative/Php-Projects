@extends ('layouts.app')

@section ('title','Questions Set | Create')

@section ('content')
<div class="content-wrapper" >
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-repeat"></i>
            </span> Questions 
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{route("dashboard")}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" >
                    <a href="{{ route('questions-set.index') }}">Question Sets</a>
                 </li>
                 <li class="breadcrumb-item" aria-current="page">
                    Questions
                 </li>
            </ul>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div  class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
				
                <h4 class="card-title">QUESTIONS {{ $question_name}} </h4>
                   @livewire('question-set.questionsets-question-list', ['name' => $name],key('questionsets-question-list'))
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script>
document.addEventListener('livewire:load', function () {
        Livewire.on('delete', id => {
            swal({
                title: "Are you sure?",
                text: "This will permanently delete your question in your set.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete",
                closeOnConfirm: true
            }, function (isConfirm) {
                if (!isConfirm) return;
				//alert('ssss');
                Livewire.emitTo('question-set.questionsets-question-list','confirmDelete_question',id);
				setTimeout(function() {
				location.reload();
				}, 1500);
            });
        });
        Livewire.on('closeModal', id => {
            $('#edit-set').modal('hide');
        });
    });
</script>
@endpush
