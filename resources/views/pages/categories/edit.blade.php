@extends('layouts.app')

@section('title')
    Update category
@endsection

@section('breadcrumb')
    Update category
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
    <form action="{{ route('categories.update',$category->id) }}" enctype="multipart/form-data" method="POST">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-12">
                @if ($category->image)
                    <img src="{{ Storage::url($category->image) }}" style="width: 100px;">
                @else
                    No Photo
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="image">image</label> <br>
                    <input id="image" type="file" name="image"/>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="small mb-1" for="name">Category</label>
                    <input class="form-control py-4" id="name" type="text" value="{{ old('name') ? old('name') : $category->name }}" name="name" @error('name') is-invalid @enderror"/>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="small mb-1" for="title">Title</label>
                    <textarea name="title" id="editor">{{ $category->title }}</textarea>
                </div>
            </div>
        </div>
        <button class="form-group mt-4 btn btn-primary btn-block text-white" type="submit">Update Category</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endpush