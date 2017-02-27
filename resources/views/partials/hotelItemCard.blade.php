<div class="col-md-12 itemCard"
     style="border-left: 5px solid #526069; border-radius: 6px;">
    <div class="col-md-2">
        <img src="{{ url('/') . '/images/hotels/' . $hotel->media_path . '/1.jpg'}}" class="img-responsive" alt="">
    </div>
    <div class="col-md-10">
        <div class="row">
            <h5>{{ $hotel->name }}</h5>
            <div class="col-md-5">
                <p>Location: {{ $hotel->location }}</p>
            </div>
            <div class="col-md-3">
                <p>Stars: {{ $hotel->stars }}</p>
            </div>
            <div class="col-md-4">
                <p>Price: {{ $hotelItem->subtotal }} EUR</p>
                <a href="#" class="text-danger">REMOVE</a>
            </div>
        </div>
    </div>
</div>