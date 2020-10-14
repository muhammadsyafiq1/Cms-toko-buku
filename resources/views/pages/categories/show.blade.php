@extends('layouts.app')

@section('title')
    Show category
@endsection

@section('breadcrumb')
    Show category "{{ $category->name }}"
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Image: </label> <br>
                <img src="{{ Storage::url($category->image) }}" style="width: 200px;">
            </div>
            <div class="form-group">
                <label for="name">Name: </label>
                <p>{{ $category->name }}</p>
            </div>
            <div class="form-group">
                <label for="name">title: </label>
                <p>{!! $category->title !!}p>
            </div>
            <div class="form-group">
                <label for="name">Created at: </label>
                <p>{{ date('d-m-y',strtotime($category->creadted_at)) }}</p>
            </div>
            <div class="form-group">
                <label for="name">Updated at: </label>
                <p>{{ date('d-m-y',strtotime($category->updated_at)) }}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 nt-3">
            <a href="{{ route('categories.index') }}" class="btn btn-warning btn-sm">Back</a>
        </div>
    </div>
@endsection