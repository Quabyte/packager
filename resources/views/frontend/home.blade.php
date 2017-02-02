@extends('layouts.application')

@section('fonts')
    <link rel="stylesheet" href="{{ asset('fonts/material-design/material-design.min.css') }}">
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
    <script>
        var canvas = new fabric.Canvas('c');

        canvas.loadFromJSON({!! $venue !!});
        canvas.renderAll();
    </script>
    <script src="{{ asset('js/seatbit/responsive.js') }}"></script>
    <script>
        console.log('Width: ' + canvas.width);
        console.log('Height: ' + canvas.height);
    </script>
@stop