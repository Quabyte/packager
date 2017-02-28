@extends('layouts.application')

@section('bodyClass', 'app')

@section('content')
    @include('partials.header')
    <div class="container" style="background: #fff;">
        <div class="row">
            @include('partials.sidebar')
            <div class="canvasWrapper" id="canvas-holder">
                @include('partials.canvasui')
                <canvas id="c" width="875" height="550"></canvas>
                @include('partials.zoneView')
            </div>
            @include('partials.cart')
        </div>
    </div>
@stop

@section('footer.js')
    <script src="{{ asset('js/global/vue.min.js') }}"></script>
    <script type="application/javascript" charset="UTF-8" src="https://tk3d.tk3dapi.com/ticketing3d/TICKETING3D.js"></script>
    <script src="{{ asset('js/seatbit/fabric.min.js') }}"></script>
    {{--<script src="{{ asset('js/global/acikgise.min.js') }}"></script>--}}
    <script src="{{ asset('js/seatbit/zone.js') }}"></script>
    <script src="{{ asset('js/seatbit/seat.js') }}"></script>
    <script src="{{ asset('js/seatbit/seatbit.js') }}"></script>
    <script src="{{ asset('js/seatbit/zoomandpan.js') }}"></script>
@stop