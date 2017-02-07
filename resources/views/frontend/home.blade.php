@extends('layouts.application')

@section('fonts')
    <link rel="stylesheet" href="{{ asset('fonts/7-stroke/7-stroke.min.css') }}">
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')
            <div class="canvasWrapper" id="canvas-holder">
                <canvas id="c"></canvas>
            </div>
        </div>
    </div>
@stop

@section('footer.js')
    <script src="{{ asset('js/seatbit/fabric.min.js') }}"></script>
    <script src="{{ asset('js/seatbit/zone.js') }}"></script>
    <script src="{{ asset('js/seatbit/seat.js') }}"></script>
    <script src="{{ asset('js/seatbit/seatbit.js') }}"></script>
{{--    <script src="{{ asset('js/seatbit/responsive.js') }}"></script>--}}
@stop