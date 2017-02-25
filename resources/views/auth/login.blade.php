@extends('layouts.application')

@section('bodyClass', 'app')

@section('content')
<div class="container">
    <div class="row">
        @include('auth.partials.login-form')
    </div>
</div>
@endsection
