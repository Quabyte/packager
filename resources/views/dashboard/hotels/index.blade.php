@extends('dashboard.default')

@section('title', 'Hotels')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Hotels</h2>
            </div>

            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="150">Picture</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hotels as $hotel)
                            <tr>
                                <td>
                                    <img src="{{ url('/') . '/images/hotels/' . $hotel->media_path . '/1.jpg' }}" alt="" class="img-thumbnail img-responsive">
                                </td>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ $hotel->location }}</td>
                                <td>
                                    <a href="{{ action('HotelController@edit', ['id' => $hotel->id]) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop