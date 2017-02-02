@extends('layouts.application')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/fotorama.css') }}">
@stop

@section('fonts')
    <link rel="stylesheet" href="{{ asset('fonts/material-design/material-design.min.css') }}">
@stop

@section('title', 'Select Your Hotel')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Select Your Hotel</h2>
            </div>
        {{-- Check whether any hotels on database--}}
        @if(count($hotels) >= 1)
            @foreach($hotels as $hotel)
            <div class="col-md-4">
                <div class="panel panel-default">

                    {{-- Panel Header --}}
                    <div class="panel-title">
                        <h4 class="panel-heading mb-0">
                            {{ $hotel->name }}
                            <span class="pull-right">
                                @for($i = 1; $i <= $hotel->stars; $i++)
                                    <i class="icon text-danger md-star"></i>
                                @endfor
                            </span>
                        </h4>
                        <p class="text-muted" style="margin-left: 15px; font-size: 13px;">{{ $hotel->location }}</p>
                        <div class="reviews">
                            <span class="hotel-point">{{ $hotel->review_point }}/10</span>
                            <p class="pull-right small-font">Based on {{ $hotel->review_count }} reviews</p>
                        </div>
                    </div>
                    {{-- End Panel Header --}}

                    {{-- Panel Body --}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">

                                {{-- Hotel Gallery --}}
                                <div class="fotorama"
                                     data-width="100%"
                                     data-nav="thumbs"
                                     data-keyboard="true"
                                     data-loop="true"
                                     data-allowfullscreen="true">
                                    <img src="{{ url('/') }}/images/hotels/{{ $hotel->media_path }}/1.jpg" alt="">
                                    <img src="{{ url('/') }}/images/hotels/{{ $hotel->media_path }}/2.jpg" alt="">
                                    <img src="{{ url('/') }}/images/hotels/{{ $hotel->media_path }}/3.jpg" alt="">
                                    <img src="{{ url('/') }}/images/hotels/{{ $hotel->media_path }}/4.jpg" alt="">
                                    <img src="{{ url('/') }}/images/hotels/{{ $hotel->media_path }}/5.jpg" alt="">
                                    <img src="{{ url('/') }}/images/hotels/{{ $hotel->media_path }}/6.jpg" alt="">
                                    <img src="{{ url('/') }}/images/hotels/{{ $hotel->media_path }}/7.jpg" alt="">
                                    <img src="{{ url('/') }}/images/hotels/{{ $hotel->media_path }}/8.jpg" alt="">
                                    <img src="{{ url('/') }}/images/hotels/{{ $hotel->media_path }}/9.jpg" alt="">
                                    <img src="{{ url('/') }}/images/hotels/{{ $hotel->media_path }}/10.jpg" alt="">
                                </div>
                                {{-- End Hotel Gallery --}}

                            </div>
                        </div>

                        {{-- Accomodation Info --}}
                        <div class="row mt-10">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="date" class="form-control">
                                        <option value="1">Check In</option>
                                        <option value="2">18 May</option>
                                        <option value="3">19 May</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="check" class="form-control">
                                        <option value="1">Check Out</option>
                                        <option value="2">18 May</option>
                                        <option value="3">19 May</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="type" class="form-control">
                                        <option value="1">Room Type</option>
                                        <option value="2">18 May</option>
                                        <option value="3">19 May</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- End Accomodation Info --}}

                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" class="btn btn-default">
                                    <i class="icon md-info-outline"></i> More Info
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="btn btn-success btn-block">
                                    <i class="icon md-book"></i> Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                    {{-- End Panel Body --}}
                </div>
            </div>
            @endforeach
        @else
            <p>You don't have any hotels to show!</p>
        @endif
        </div>
    </div>
@stop

@section('footer.js')
    <script src="{{ asset('js/plugins/fotorama.js') }}"></script>
@stop