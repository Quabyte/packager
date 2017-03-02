@extends('layouts.application')

@section('bodyClass', 'app')

@section('title', 'Profile')

@section('content')
    @include('partials.header')

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-title">
                        <h4 class="panel-heading mb-0">
                            USER DETAILS
                        </h4>
                    </div>

                    <div class="panel-body">
                        <p>Name: {{ $user->name }}</p>
                        <p>Surname: {{ $user->surname }}</p>
                        <p>Email: {{ $user->email }}</p>
                        <p>Address: {{ $user->address }}</p>
                        <p>Postal Code: {{ $user->postal_code }}</p>
                        <p>Country: {{ $user->country }}</p>
                        <p>Telephone: {{ $user->telephone }}</p>
                        <p>TC ID: {{ $user->tc_id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop