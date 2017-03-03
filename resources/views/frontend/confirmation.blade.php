@extends('layouts.application')

@section('bodyClass', 'app')

@section('title', 'Order Confirmation')

@section('content')
    @include('partials.header')

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-title">
                        <h4 class="panel-heading mb-0">YOUR ORDER</h4>
                    </div>

                    <div class="panel-body">
                        @foreach(\App\Models\Order::listSeats($order->id) as $seats)
                            @include('partials.itemsCard')
                        @endforeach
                        @foreach(\App\Models\Hotel::listHotels($order->id) as $hotel)
                            @include('partials.hotelItemCard')
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-title">
                        <h4 class="panel-heading mb-0">IMPORTANT NOTICE</h4>
                    </div>

                    <div class="panel-body">
                        <p>We have sent an email to {{ Auth::user()->email }}. Please check your inbox for details.</p>
                        <p>Ticket will be sent as Print at Home format starting from May 5th 2017.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop