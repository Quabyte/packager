@extends('layouts.application')

@section('bodyClass', 'app')

@section('title', 'Error On Purchase!')

@section('content')
    @include('partials.header')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    </div>
@stop