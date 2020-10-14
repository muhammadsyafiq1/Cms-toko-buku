@extends('layouts.app')

@section('title')
    Update user
@endsection

@section('breadcrumb')
    Update User
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
    <form action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-12">
                @if ($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}">
                @else
                    No Photo
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="avatar">Avatar</label> <br>
                    <input id="avatar" type="file" name="avatar"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="name">Full Name</label>
                    <input class="form-control py-4" id="name" type="text" value="{{ old('name') ? old('name') : $user->name }}" name="name" @error('name') is-invalid @enderror"/>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="email">email</label> <br>
                    <input id="email" type="email" name="email" value="{{ old('email') ? old('email') : $user->email }}" class="form-control"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="username">username</label> <br>
                    <input id="username" type="t"ext name="username" value="{{ old('username') ? old('username') : $user->username }}" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="roles" class="small mb-1">Roles</label> <br>
                    <input type="checkbox" name="roles[]" value="admin" id="admin" {{ in_array("admin", json_decode($user->roles)) ? 'checked' : ''}}>
                    <label for="admin">Admin</label>
                    <input type="checkbox" name="roles[]" value="staff" id="staff" {{ in_array("staff", json_decode($user->roles)) ? 'checked' : ''}}>
                    <label for="staff">Staff</label>
                    <input type="checkbox" name="roles[]" value="customer" id="customer" {{ in_array("customer", json_decode($user->roles)) ? 'checked' : '' }}>
                    <label for="customer">Customer</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="roles" class="small mb-1">Status</label> <br>
                    <input type="radio" value="active" name="status" {{  $user->status == 'active' ? 'checked' : '' }}>
                    <label for="active">active</label>
                    <input type="radio" value="inactive" name="status" {{  $user->status == 'inactive' ? 'checked' : '' }}>
                    <label for="inactive">inactive</label>
                </div>
            </div>
        </div>
        <button class="form-group mt-4 btn btn-primary btn-block text-white" type="submit">Update Account</button>
    </form>
</div>
@endsection