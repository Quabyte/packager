<div id="cart" v-show="showCart" class="speed-in">
    <div class="item-title">
        <h2>3D VIEW FROM YOUR SEAT</h2>
    </div>
    <div id="three-d">

    </div>
    <div class="item-title">
        <h2>YOUR ORDER</h2>
    </div>
    <div class="items-holder">
        <ul class="cart-items">
            <li v-for="item in items">
                <span class="cart-zone">Zone: @{{ item.zoneNumber }}</span> Row: @{{ item.row }} / Seat: @{{ item.number }}
                <div class="cart-price">@{{ item.price }} EUR</div>
                <a href="#" @click="removeFromCart(item)" class="icon pe-close-circle" style="float: right; color: red"></a>
            </li>
        </ul>
    </div>

    <div class="cart-total">
        <p class="text-center" style="margin: 0;">TOTAL @{{ total }} EUR</p>
    </div>
    <a href="" @click="sendCartData()" class="btn btn-lg btn-success btn-block" style="border-radius: 0;">CHECKOUT</a>
</div>