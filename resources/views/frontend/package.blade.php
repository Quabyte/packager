@extends('layouts.application')

@section('title', 'Your Package')

@section('content')
    @foreach(\App\Models\OrderItem::where('order_id', '=', $order->id)->get() as $item)
        <p>{{ $item->title }}</p>
        <p>{{ $item->unit_price }}</p>
    @endforeach
@stop