@extends('layouts.app')

@section('title')
    Show User
@endsection

@section('breadcrumb')
    Show User "{{ $user->username }}"
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Avatar: </label> <br>
                <img src="{{ Storage::url($user->avatar) }}">
            </div>
            <div class="form-group">
                <label for="name">Name: </label>
                <p>{{ $user->name }}</p>
            </div>
            <div class="form-group">
                <label for="name">Email: </label>
                <p>{{ $user->email }}</p>
            </div>
            <div class="form-group">
                <label for="name">Address: </label>
                <p>{{ $user->address }}</p>
            </div>
            <div class="form-group">
                <label for="name">Status: </label>
                <p>{{ $user->status }}</p>
            </div>
            <div class="form-group">
                <label for="name">Roles: </label> <br>
                @foreach (json_decode($user->roles) as $role)
                    &middot; {{ $role }} <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection