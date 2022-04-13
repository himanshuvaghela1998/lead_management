@extends('layouts.main')
@section('page_name','Users')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="pt-4">Users</h5>
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn primary" href="{{ route('users.create') }}"> 
                            Add New <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    {{-- begain User list --}}
                    @include('user.include.usersList')
                    {{-- end User list --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection