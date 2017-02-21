@extends('layouts.application')

@section('content')
    <div class="container">
        <div class="row">
            @include('auth.partials.register-form')
        </div>
    </div>
@stop