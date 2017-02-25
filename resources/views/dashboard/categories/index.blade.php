@extends('dashboard.default')

@section('title', 'Price Categories')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->price }}</td>
                        <td>
                            <a href="{{ action('PriceCategoryController@edit', ['id' => $category->id]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop