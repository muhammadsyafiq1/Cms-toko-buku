@extends('layouts.app')

@section('title')
    Show order
@endsection

@section('breadcrumb')
    Show order "{{ $order->invoice_number }}"
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Buyer: </label>
                <p>{{  $order->user->name  }}
            </div>
            <div class="form-group">
                <label for="desc">Invoice number:</label>
                <p>{{  $order->invoice_number  }}</p>
            </div>
            <div class="form-group">
                <label for="desc">Quantity:</label>
                <p>{{  $order->getTotalQuantity() }}</p>
            </div>
            <div class="form-group">
                <label for="name">Created at: </label>
                <p>{{ date('d-m-y',strtotime($order->creadted_at)) }}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 nt-3">
            <a href="{{ route('orders.index') }}" class="btn btn-warning btn-sm">Back</a>
        </div>
    </div>
@endsection