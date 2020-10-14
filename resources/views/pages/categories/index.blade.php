@extends('layouts.app')

@section('title')
    categories
@endsection

@section('sub-title')
    Manage categories
@endsection

@section('breadcrumb')
    List categories
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
        <a href="{{ route('categories.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Category</a>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table" id="crudtable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Image</th>
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
            ajax: {
                url: '{!! url()->current() !!}'
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'image', name: 'image'},
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