@extends('layouts.application')

@section('bodyClass', 'app')

@section('title', 'Order Confirmation')

@section('content')
    @include('partials.header')

    <div class="container">
        {{ $message }}
    </div>
@stop