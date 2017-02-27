<div class="col-md-12 itemCard"
     style="border-left: 5px solid #{{$seat->priceCategory->color}}; border-radius: 6px;">
    <div class="col-md-2">
        <img src="{{ url('/') . '/images/zones/' . $seat->zone . '.png'}}" class="img-responsive" alt="">
    </div>
    <div class="col-md-10">
        <div class="row">
            <h5>Turkish Airlines EuroLeague Final Four 2017 Istanbul</h5>
            <div class="col-md-5">
                <p>Package: {{ $seat->priceCategory->name }}</p>
                <p>Zone: {{ $seat->zone }}</p>
            </div>
            <div class="col-md-3">
                <p>Row: {{ $seat->row }}</p>
                <p>Seat: {{ $seat->number }}</p>
            </div>
            <div class="col-md-4">
                <p>Price: {{ $seat->priceCategory->price }} EUR</p>
                <a href="#" class="text-danger">REMOVE</a>
            </div>
        </div>
    </div>
</div>