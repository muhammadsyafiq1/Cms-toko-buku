@extends('layouts.app')

@section('title')
    Create Category
@endsection

@section('breadcrumb')
    Cretae Category
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
    <form action="{{ route('categories.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="small mb-1" for="avatar">Avatar</label> <br>
                    <input id="avatar" type="file" name="image"/>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="small mb-1" for="name">Category</label>
                    <input class="form-control py-4" id="name" type="text" placeholder="Enter Category" name="name" @error('name') is-invalid @enderror"/>
                </div>
            </div>
        </div>
        <button class="form-group mt-4 btn btn-primary btn-block text-white" type="submit">Create Account</button>
    </form>
</div>
@endsection

@push('scripts')

<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endpush