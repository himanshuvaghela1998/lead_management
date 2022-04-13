@extends('layouts.main')
@section('page_name','Add User')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="pt-4">Add User</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.store') }}" class="horizontal-form" method="POST" id="user_store">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <label class="required fs-6 fw-bold mb-2">Name</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter user name" name="name" id="name"/>
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-bold mb-2">Role</label>
							    {{Form::select('role',[''=>'Select Role']+$roles,null,['class'=>'form-control form-control-solid capitalize-letter','id'=>'role'])}}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="required fs-6 fw-bold mb-2">Email</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter email address" name="email" id="email"/>
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-bold mb-2">Password</label>
                                <input type="password" class="form-control form-control-solid" placeholder="Enter password" name="password" id="password"/>
                            </div>
                        </div>
                        <div class="form-actions d-flex justify-content-end mt-5">
                            <a href="{{ route('users.index') }}"><button type="button" class="btn btn-secondary me-3">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection