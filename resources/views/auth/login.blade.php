@extends('layouts.application')

@section('content')
<div class="container">
    <div class="row">
        @include('auth.partials.login-form')
    </div>
</div>
@endsection
