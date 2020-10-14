@extends('layouts.app')

@section('title')
    Orders
@endsection

@section('sub-title')
    Manage Orders
@endsection

@section('breadcrumb')
    List Orders
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
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table" id="crudtable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Invoice number</th>
                    <th>Buyer</th>
                    <th>Total price</th>
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
                {data: 'invoice_number', name: 'invoice_number'},
                {data: 'user.name', name:'user.name'},
                {data: 'total_price', name: 'total_price'},
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
