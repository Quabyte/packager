@extends('layouts.application')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/fotorama.css') }}">
@stop

@section('fonts')
    <link rel="stylesheet" href="{{ asset('fonts/material-design/material-design.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome/font-awesome.min.css') }}">
@stop

@section('bodyClass', 'app')

@section('title', 'Your Package')

@section('content')
    @include('partials.header')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default" style="margin-top: 30px;">
                    <div class="panel-title">
                        <h4 class="panel-heading mb-0">
                            ORDER SUMMARY
                        </h4>
                    </div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-8">
                                @foreach(\App\Models\Order::listSeats($order->id) as $seat)
                                    @include('partials.itemsCard')
                                @endforeach
                                @foreach(\App\Models\Hotel::listHotels($order->id) as $hotelItem)
                                    <?php $hotel = \App\Models\Hotel::where('unique_identifier', '=', $hotelItem->uuid)->first() ?>
                                    @include('partials.hotelItemCard')
                                @endforeach
                            </div>
                            <div class="col-md-4">
                                <h5>IMPORTANT DETAILS</h5>
                                <p>- All packages include 1 sandwich, soft drink and snack.</p>
                                <p>- Optionaly you can add accommodation to your package.</p>
                                <p>- You have 20 minutes before you finish your purchase.</p>
                                <p>- In order to complete your purchase, please Register or Login below.</p>
                                <p>- By purchasing packages from this site, you agreed Terms & Conditions.</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer-custom">
                        <p>TOTAL: {{ $order->total }} EUR</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @if(Auth::guest())
                    <div class="panel panel-default">
                        <div class="panel-title">
                            <h4 class="panel-heading mb-0">
                                REGISTER OR LOGIN
                            </h4>
                        </div>

                        <div class="panel-body">
                            @include('partials.authentication')
                        </div>
                    </div>
                @else
                    <div class="panel panel-default">
                        <div class="panel-title">
                            <h4 class="panel-heading mb-0">
                                SECURE 3D PAYMENT
                            </h4>
                        </div>
                        <div class="panel-body">
                            @include('partials.finansbank')
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                @include('partials.eventInformation')


                <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#hotelsModal">
                    Looking for Accommodation?
                </button>
            </div>

        </div>
    </div>

    <div class="modal fade" id="hotelsModal" tabindex="-1" role="dialog" aria-labelledby="hotelsModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="hotelsModalLabel">Add Accommodation to Your Package</h4>
                </div>
                <div class="modal-body">
                    @include('partials.hotels')
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@stop

@section('footer.js')
    <script src="{{ asset('js/plugins/fotorama.js') }}"></script>
@stop