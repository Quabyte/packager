<div id="cart" v-show="showCart" class="speed-in">
    <h2>Your Order</h2>
    <ul class="cart-items">
        <li v-for="item in items">
            <span class="cart-zone">Zone: @{{ item.zoneNumber }}</span> Row: @{{ item.row }} / Seat: @{{ item.number }}
            <div class="cart-price">@{{ item.price }} EUR</div>
            <a href="#" @click="removeFromCart(item)" class="icon pe-close-circle pe-danger" style="float: right;"></a>
        </li>
    </ul>

    <div class="cart-total">
        <p>Total <span>@{{ total }}</span></p>
    </div>

    <a href="{{ action('OrderController@showOrder', ['uuid' => $uuid]) }}" @click="sendCartData()" class="btn btn-success btn-block">CHECKOUT</a>
</div>