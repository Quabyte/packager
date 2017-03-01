@extends('dashboard.default')

@section('title', 'Edit Category')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Category {{ $category->name }}</h2>
            </div>
            
            <div class="panel-body">
                <form action="{{ action('PriceCategoryController@update', ['id' => $category->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoryName">Category Name</label>
                                <input type="text" name="categoryName" value="{{ $category->name }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Category Price</label>
                                <input type="text" name="price" value="{{ $category->price }}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="zones">Category Zones</label>
                                <input type="text" name="zones" value="{{ $category->zones }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="online">Online</label>
                                <select name="online" class="form-control">
                                    <option value="0">Offline</option>
                                    <option value="1">Online</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="available">Available</label>
                                <input type="text" name="available" value="{{ $category->available }}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-primary" value="Update">
                            <a href="{{ action('PriceCategoryController@index') }}">Cancel</a>
                        </div>
                    </div>
                </form>

                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-12">
                        @foreach(\App\Models\PriceCategory::getZones($category->id) as $zone)
                            <a href="{{ action('SeatController@show', ['zone' => $zone]) }}" class="btn btn-default btn-xs">View Zone {{ $zone }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop