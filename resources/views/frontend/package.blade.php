@extends('layouts.application')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/fotorama.css') }}">
@stop

@section('fonts')
    <link rel="stylesheet" href="{{ asset('fonts/material-design/material-design.min.css') }}">
@stop

@section('title', 'Your Package')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-8">
                <div class="col-md-12">
                    <h2>You can add accomodation to your package</h2>
                </div>
                @include('partials.hotels')
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Your Package</h2>
                    </div>

                    <div class="panel-body">
                        <div class="col-md-12">
                            @foreach(\App\Models\Order::listSeats($order->id) as $seat)
                                <p>{{ $seat->uuid }} - {{ $seat->quantity }}</p>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            @foreach(\App\Models\Hotel::all() as $hotel)
                                <p>{{ $hotel->name }}</p>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <p>TOTAL: {{ $order->total }} EUR</p>
                        </div>

                        @if(Auth::guest())
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#authentication">REGISTER / LOGIN</button>
                            </div>
                        @else
                            <div class="col-md-12">
                                <a href="#" class="btn btn-block btn-success">Pay Now</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.authentication')
@stop

@section('footer.js')
    <script src="{{ asset('js/plugins/fotorama.js') }}"></script>
@stop