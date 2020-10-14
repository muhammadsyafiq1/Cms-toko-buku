@extends('layouts.app')

@section('title')
    Show book
@endsection

@section('breadcrumb')
    Show book "{{ $book->title }}"
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Cover: </label> <br>
                <img src="{{ Storage::url($book->cover) }}" style="width: 200px;">
            </div>
            <div class="form-group">
                <label for="name">title: </label>
                <p>{!! $book->title !!}
            </div>
            <div class="form-group">
                <label for="kategori">Category</label>
                <ul>
                    @foreach ($book->category as $item)
                        <li>
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                {!! $book->description !!}
            </div>
            <div class="form-group">
                <label for="name">Created at: </label>
                <p>{{ date('d-m-y',strtotime($book->creadted_at)) }}</p>
            </div>
            <div class="form-group">
                <label for="name">Updated at: </label>
                <p>{{ date('d-m-y',strtotime($book->updated_at)) }}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 nt-3">
            <a href="{{ route('books.index') }}" class="btn btn-warning btn-sm">Back</a>
        </div>
    </div>
@endsection