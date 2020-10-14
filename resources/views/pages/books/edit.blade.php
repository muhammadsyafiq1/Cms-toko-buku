@extends('layouts.app')

@section('title')
    Edit book
@endsection

@section('breadcrumb')
    Edit book
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
    <form action="{{ route('books.update',$book->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="small mb-1" for="cover">Cover</label> <br>
                    @if ($book->cover)
                        <img src="{{ Storage::url($book->cover) }}" style="width: 100px;">
                    @else
                        No Cover
                    @endif
                    <br>
                    <small>Kosongkan bila tak ingin cover dirubah..</small><br>
                    <input id="cover" type="file" name="cover"/>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="small mb-1" for="title">Title</label>
                    <input type="text" name="title" class="form-control py-4  @error('title') is-invalid @enderror"  value="{{ old('title') ? old('title') : $book->title}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="categories">Kategori Buku</label>
                    <select name="categories[]" id="categories" class=" py-4 form-control @error('categories') is-invalid @enderror" multiple></select> 
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="small mb-1" for="author">authors</label>
                    <input class="form-control py-4 @error('author') is-invalid @enderror" id="author" type="text" placeholder="Enter authors" name="author"  value="{{ old('author') ? old('author') : $book->author}}"/>
                </div>
            </div> 
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="small mb-1" for="title">publisher</label>
                    <input type="text" name="publisher" class="form-control py-4  @error('publisher') is-invalid @enderror" placeholder="Enter publisher"  value="{{ old('publisher') ? old('publisher') : $book->publisher}}"">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="small mb-1" for="price">prices</label>
                    <input class="form-control py-4" id="price" type="number" placeholder="Enter prices" name="price" @error('price') is-invalid @enderror"  value="{{ old('price') ? old('price') : $book->price}}"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="small mb-1" for="stock">stocks</label>
                    <input class="form-control py-4 @error('stock') is-invalid @enderror" id="stock" type="number" placeholder="Enter stocks" name="stock"  value="{{ old('stock') ? old('stock') : $book->stock}}"/>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea name="description" id="editor">{{ old('description') ? old('description') : $book->description}}</textarea>
                </div>
            </div>
        </div>
        <button class="form-group mt-4 btn btn-primary btn-block text-white" type="submit" name="save_action" value="publisher">Publish</button>
        <button class="form-group mt-4 btn btn-default btn-block text-dark" type="submit" name="save_action" value="draft">Draft</button>
    </form>
</div>
@endsection

@push('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
<script>
    $("#categories").select2({
      ajax: {
        url: "http://127.0.0.1:8000/ajax/categories/search", //route buat di web
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            search: params.term
          };
        },
        processResults: function (response) {
          return {
            results: response
          };
        },
        cache: true
      }

    });

    var category = {!! $book->category !!}
    category.forEach(function(category){
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
    });
  </script>
@endpush