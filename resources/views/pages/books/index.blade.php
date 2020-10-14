@extends('layouts.app')

@section('title')
    books
@endsection

@section('sub-title')
    Manage books
@endsection

@section('breadcrumb')
    List books
@endsection

@section('content')
<div class="row">
    <div class="col md-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <a href="{{ route('books.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Book</a>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table" id="crudtable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>   
        </table>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var datatable = $("#crudtable").DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax:{
                url: '{!! url()->current() !!}'
            },
            columns: [
                {data:'title', name:'title'},
                {data:'author', name:'author'},
                {data:'publisher', name:'publisher'},
                {data:'price', name:'price'},
                {data:'stock', name:'stock'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%'
                },
            ]
        })
    </script>
@endpush