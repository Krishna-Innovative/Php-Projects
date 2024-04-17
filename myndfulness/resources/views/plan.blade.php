@extends ('layouts.app')

@section ('title','Subscriber')

@section ('content')
<div class="content-wrapper">
   
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-chart-bar"></i>
            </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active">

                </li>
                <li class="breadcrumb-item" aria-current="page">
                    Subscriber
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body table-responsive"  x-data="{activeTab: 'free'}">
                    <div class="mt-4 py-2">
                        <ul class="nav nav-tabs profile-navbar" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" x-bind:class="activeTab == 'free' ? 'active' : ''"
                                href="#free" x-on:click.prevent="activeTab = 'free'">
                                <i class="mdi mdi-account-outline"></i> Free Users </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                x-bind:class="activeTab == 'paid' ? 'show active' : ''"
                                href="#paid" x-on:click.prevent="activeTab = 'paid'">
                                <i class="mdi mdi-newspaper"></i> Paid Users </a>
                            </li>

                        </ul>
                    </div>
                    <div class="tab-content profile-feed pl-2">
                        <div x-bind:class="activeTab == 'free' ? 'show active' : ''" x-transition
                        class="tab-pane fade" id="free" role="tabpanel"
                        aria-labelledby="free-tab">
                        <table class="table table-hover" wire:loading.class="loading">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subscription Plan</th>
                                    <th>Price</th>
                                    <th>Subscription Start Date</th>
                                    <th>Subscription End Date</th>
                                </tr>
                            </thead> 
                            @foreach ($users as $user)
                            <tr>
                               <td>{{$loop->iteration}}</td>
                               <td>{{ $user->uname }}</td>
                               <td>{{ $user->email }}</td>
                               <td>{{ $user->pname }}</td>
                               <td>{{ $user->price }}</td>
                               <td>{{ $user->sdate }}</td>
                               <td>{{ $user->edate }}</td>
                           </tr>
                           @endforeach
                       </table>
                       <div class="pagination" style="float: right;margin-top: 20px;">
                        {{ $users->render() }}
                    </div>
                </div>
                <div x-bind:class="activeTab == 'paid' ? 'show active' : ''" x-transition
                class="tab-pane fade" id="paid" role="tabpanel"
                aria-labelledby="paid-tab">
                <table class="table table-hover" wire:loading.class="loading">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subscription Plan</th>
                            <th>Price</th>
                            <th>Subscription Start Date</th>
                            <th>Subscription End Date</th>
                        </tr>
                    </thead> 
                    @foreach ($paidusers as $paid_user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $paid_user->uname }}</td>
                        <td>{{ $paid_user->email }}</td>
                        <td>{{ $paid_user->pname }}</td>
                        <td>{{ $paid_user->price }}</td>
                        <td>{{ $paid_user->sdate }}</td>
                        <td>{{ $paid_user->edate }}</td>
                    </tr>
                    @endforeach
                </table>
                <div class="pagination" style="float: right;margin-top: 20px;">
                    {{ $paidusers->render() }}
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
@push ("js")
<script>
    removeItem = function(id){
        swal({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Delete",
            closeOnConfirm: true
        }, function (isConfirm) {
            if (!isConfirm) return;
            alert("please add delete function here.");
                // Livewire.emitTo('subscription-plan-component','delete',id);
            });
    }
</script>
@endpush
