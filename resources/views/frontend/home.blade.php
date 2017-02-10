@extends('layouts.application')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('partials.sidebar')
            <div class="canvasWrapper" id="canvas-holder">
                <canvas id="c"></canvas>
            </div>
            @include('partials.cart')
        </div>
    </div>
@stop

@section('footer.js')
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="{{ asset('js/seatbit/fabric.min.js') }}"></script>
    <script src="{{ asset('js/seatbit/zone.js') }}"></script>
    <script src="{{ asset('js/seatbit/seat.js') }}"></script>
    <script src="{{ asset('js/seatbit/seatbit.js') }}"></script>
    {{--    <script src="{{ asset('js/seatbit/responsive.js') }}"></script>--}}
@stop