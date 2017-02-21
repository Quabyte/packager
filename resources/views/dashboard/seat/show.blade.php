@extends('dashboard.default')

@section('title', 'Edit Seating Map')

@section('content')
    <div class="container-fluid">
        <div class="col-md-3">
            <a onclick="createSeats($jsonData)" class="btn btn-block btn-primary">Send Data</a>
        </div>
        <div class="col-md-9">
            <canvas id="backend" width="1040" height="800"></canvas>
        </div>
    </div>
@stop

@section('footer.js')
    <script src="{{ asset('js/seatbit/fabric.min.js') }}"></script>
    <script src="{{ asset('js/seatbit/seat.js') }}"></script>
    <script>
        var canvas = new fabric.Canvas('backend', {
            selection: false
        });
        canvas.loadFromJSON({!! $data !!});
        canvas.renderAll();
        canvas.on('mouse:down', function (el) {
            selectedSeat(el);
        });
        var $jsonData = canvas.toJSON();
    </script>
    <script src="{{ asset('js/seatbit/backend/seatDroid.js') }}"></script>
@stop