@extends('layouts.application')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/fotorama.css') }}">
@stop

@section('fonts')
    <link rel="stylesheet" href="{{ asset('fonts/material-design/material-design.min.css') }}">
@stop

@section('title', 'Your Package')

@section('bodyClass', 'app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Your Package</h2>
                    </div>

                    <div class="panel-body">
                        <div class="col-md-12">
                            @foreach(\App\Models\Order::listSeats($order->id) as $seat)
                                <p>Zone: {{ $seat->zone }} - Row: {{ $seat->row }} / Seat: {{ $seat->number }}</p>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            @foreach(\App\Models\Hotel::listHotels($order->id) as $hotel)
                                <p>{{ $hotel->uuid }}</p>
                                <p>{{ $hotel->subtotal }}</p>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <p>TOTAL: {{ $order->total }} EUR</p>
                        </div>

                        @if(Auth::guest())
                            <div class="col-md-12">
                                @include('partials.authentication')
                            </div>
                        @else
                            <div class="col-md-12">
                                <form action="https://www.fbwebpos.com/fim/est3Dgate" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="clientid" value="{{ $payment['clientid'] }}">
                                    <input type="hidden" name="amount" value="{{ $payment['amount'] }}">

                                    <input type="hidden" name="oid" value="{{ $payment['oid'] }}">
                                    <input type="hidden" name="okUrl" value="{{ $payment['okUrl'] }}" >
                                    <input type="hidden" name="failUrl" value="{{ $payment['failUrl'] }}" >
                                    <input type="hidden" name="islemtipi" value="{{ $payment['islemtipi'] }}" >
                                    <input type="hidden" name="taksit" value="{{ $payment['taksit'] }}">
                                    <input type="hidden" name="rnd" value="{{ $payment['rnd'] }}" >
                                    <input type="hidden" name="hash" value="{{ $payment['hash'] }}" >
                                    <input type="hidden" name="currency" value="978">

                                    <input type="hidden" name="storetype" value="3d_pay_hosting" >

                                    <input type="hidden" name="refreshtime" value="10" >

                                    <input type="hidden" name="lang" value="tr">

                                    <input type="submit" class="btn btn-success" value="PAY NOW">
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2>You can add accomodation to your package</h2>
                        @include('partials.hotels')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer.js')
    <script src="{{ asset('js/plugins/fotorama.js') }}"></script>
@stop