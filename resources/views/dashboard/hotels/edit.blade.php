@extends('dashboard.default')

@section('title', 'Edit Hotel Listing')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">{{ $hotel->name . '-' . $hotel->id}}</h2>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <img src="{{ url('/') . '/images/hotels/' . $hotel->media_path . '/1.jpg' }}" alt="" class="img-responsive">
                            </div>
                            <div class="col-md-4">
                                <form action="{{ action('HotelController@addRoom', ['id' => $hotel->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="roomName">Room Name</label>
                                        <input type="text" name="roomName" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="roomPrice">Price</label>
                                        <input type="text" name="roomPrice" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="availability">Availability</label>
                                        <input type="text" name="availability" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="roomType">Room Type</label>
                                        <select name="roomType" class="form-control">
                                            <option value="1">Single Room</option>
                                            <option value="2">Double Room</option>
                                            <option value="3">Triple Room</option>
                                        </select>
                                    </div>

                                    <input type="submit" class="btn btn-primary btn-xs" value="Add Room">
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Room Name</th>
                                            <th>Room Price</th>
                                            <th>Room Type</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($hotel->rooms as $room)
                                            <tr>
                                                <td>{{ $room->name }}</td>
                                                <td>{{ $room->price }}</td>
                                                <td>{{ $room->type }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
