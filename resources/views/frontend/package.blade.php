@extends('layouts.application')

@section('title', 'Your Package')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Your Package</h2>
                </div>

                <div class="panel-body">
                    @foreach(\App\Models\OrderItem::where('order_id', '=', $order->id)->get() as $item)
                        <p>{{ $item->subtotal }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop