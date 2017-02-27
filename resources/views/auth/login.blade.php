@extends('layouts.application')

@section('bodyClass', 'app')

@section('content')
    @include('partials.header')
    <div class="container">
        <div class="row" style="margin-top: 30px;">
           @include('auth.partials.login-form')
        </div>
    </div>
@endsection
