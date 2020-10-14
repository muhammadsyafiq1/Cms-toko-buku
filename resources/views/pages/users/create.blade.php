@extends('layouts.app')

@section('title')
    Create user
@endsection

@section('breadcrumb')
    Cretae User
@endsection

@section('content')
<div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
             @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="small mb-1" for="avatar">Avatar</label> <br>
                    <input id="avatar" type="file" name="avatar"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="name">Full Name</label>
                    <input class="form-control py-4" id="name" type="text" placeholder="Full Name" name="name" @error('name') is-invalid @enderror"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="email">Email</label>
                    <input class="form-control py-4" id="email" type="email
                    " name="email" placeholder="Enter email address" />
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="roles" class="small mb-1">Roles</label> <br>
                    <input type="checkbox" name="roles[]" value="admin" id="admin">
                    <label for="admin">Admin</label>
                    <input type="checkbox" name="roles[]" value="staff" id="staff">
                    <label for="staff">Staff</label>
                    <input type="checkbox" name="roles[]" value="customer" id="customer">
                    <label for="customer">Customer</label>
                </div>
            </div>
            <div class="col-md-6">
                <label for="username" class="small mb-1">Username</label>
                <input type="text" name="username" class="form-control py-4" placeholder="Enter your Username">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="password">Password</label>
                    <input class="form-control py-4" id="password" type="password" placeholder="Enter password" autocomplete="new-password" name="password" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control py-4" name="password_confirmation" placeholder="Enter confirm password" autocomplete="new-password">
                </div>
            </div>
        </div>
        <button class="form-group mt-4 btn btn-primary btn-block text-white" type="submit">Create Account</button>
    </form>
</div>
@endsection