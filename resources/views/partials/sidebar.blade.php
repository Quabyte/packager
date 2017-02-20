<div class="sidebar">
    {{--<div class="venueImage">--}}
        {{--<img src="{{ asset('images/sinanErdem.jpg') }}" alt="" class="img-responsive">--}}
    {{--</div>--}}
    <div class="priceList">
        <div class="infoText">
            <h4>Price Categories</h4>
        </div>
        <div class="categories">
            <div class="singleCategory">
                <span class="categoryColor" style="background: #F96868;"></span>
                <div class="categoryInfo">
                    <p class="categoryName">Suites</p>
                </div>
                <div class="categoryPrice">
                    <a href="{{ asset('misc/VIP.pdf') }}" target="_blank" class="btn btn-block btn-default">More Info</a>
                </div>
            </div>

            @foreach($categories as $category)

                {{-- Check if the price category has more than one zone --}}
                @if(App\Models\PriceCategory::checkMultipleZones($category->id))
                    <div class="singleCategory" data-toggle="collapse" data-target="#{{ $category->id }}" aria-expanded="false" aria-controls="{{ $category->name }}">
                        <span class="categoryColor" style="background: #{{ $category->color }}"></span>
                        <div class="categoryInfo">
                            <p class="categoryName">{{ $category->name }}</p>
                            <span class="ticketCount">Available {{ $category->available }}</span>
                        </div>
                        <div class="categoryPrice">
                            <a href="#" class="btn btn-block btn-default">{{ $category->price }} €</a>
                        </div>
                    </div>

                    <div class="collapse" id="{{ $category->id }}" style="padding-left: 25px;">

                        {{-- List the zones --}}
                        @foreach(App\Models\PriceCategory::getZones($category->id) as $zone)
                            <div class="singleCategory" onclick="getZoneView({!! $zone !!})">
                                <span class="categoryColor" style="background: #{{ $category->color }}"></span>
                                <div class="categoryInfo">
                                    <p class="categoryName">{{ $zone }}</p>
                                    <span class="ticketCount">Available {{ $category->available }}</span>
                                </div>
                                <div class="categoryPrice">
                                    <a href="#" class="btn btn-block btn-xs btn-default">{{ $category->price }} €</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                {{-- If the price category has one zone --}}
                @else
                    <div class="singleCategory" onclick="getZoneView({!! $category->zones !!})">
                        <span class="categoryColor" style="background: #{{ $category->color }}"></span>
                        <div class="categoryInfo">
                            <p class="categoryName">{{ $category->name }}</p>
                            <span class="ticketCount">Available {{ $category->available }}</span>
                        </div>
                        <div class="categoryPrice">
                            <a href="#" class="btn btn-block btn-default">{{ $category->price }} €</a>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
</div>