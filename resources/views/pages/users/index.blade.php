@extends('layouts.app')

@section('title')
    Users
@endsection

@section('sub-title')
    Manage Users
@endsection

@section('breadcrumb')
    List Users
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
        <a href="{{ route('user.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add User</a>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table" id="crudtable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
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
                url: '{!! url()->current() !!}',
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status'},
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