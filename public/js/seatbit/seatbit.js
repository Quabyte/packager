var canvas = new fabric.Canvas('c', {
    selection: false
});
var venueJSON;
var tk3d = new TICKETING3D('eu-tr-00002');
var view3d_module = tk3d.loadModule({
    module: "view3d",
    container: "three-d"
});
var baseUrl = 'http://beta.final4istanbul.com';
/**
 * Loads the main zone view canvas
 */
$(document).ready(function () {
    responsive();
    loadVenue();
    canvasZoom();
});

function canvasZoom()
{
    canvas.setZoom(canvas.getZoom() / 1.2);
}

function loadVenue()
{
    axios({
        method: 'get',
        url: '/load-venue'
    })
        .then(function (response) {
            venueJSON = response;
            canvas.loadFromJSON(response.data);
            canvas.renderAll();
            fabric.Image.fromURL(baseUrl + '/images/court.jpg', function(oImg) {
                // scale image down, and flip it, before adding it onto canvas
                oImg.setOptions({
                    'evented': false,
                    'excludeFromExport': true,
                    'hasBorders': false,
                    'hasControls': false,
                    'hasRotatingPoint': false,
                    'height': 100,
                    'left': 440,
                    'lockMovementX': true,
                    'lockMovementY': true,
                    'lockRotation': true,
                    'lockScalingX': true,
                    'lockScalingY': true,
                    'top': 269,
                    'width': 155,
                });
                canvas.add(oImg);
                canvas.renderAll();
            });
        })
        .catch(function (response) {
            console.log(response)
        });

    canvas.on('object:selected', function(el) {
        selected(el);
    });
}

/**
 * Shopping Cart Component
 */
var cart = new Vue({
    el: '#cart',
    data: {
        items: [],
        type: this.itemType
    },
    computed: {
        total: function() {
            var total = 0;
            for(var i = 0; i < this.items.length; i++) {
                total += this.items[i].price;
            }
            return total;
        },
        itemType: function() {
            return this.items[0].type;
        },
        itemCount: function() {
             return this.items.length;
        },
        showCart: function () {
            var showCart = false;
            if (this.items.length > 0) {
                showCart = true;
            }
            return showCart;
        }
    },
    methods: {
        addToCart: function (item) {
            this.items.push(item);
        },
        removeFromCart: function (item) {
            item.setStroke('#3AA99E');
            item.setFill('#3AA99E');
            item.setStatus('AV');
            canvas.renderAll();
            this.items.splice(this.items.indexOf(item), 1);
        },
        sendCartData: function () {
            axios({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'post',
                url: '/add-to-cart',
                data: {
                    itemCount: this.itemCount,
                    total: this.total,
                    items: this.items
                }
            })
                .then(function (response) {
                    window.location.replace(response.data.redirect);
                })
                .catch(function (response) {
                    alert(response);
                });
        }
    }
});

/**
 * Event listener for the main canvas. Loads zones
 *
 * @param el
 * @returns {boolean}
 */
function selected(el) {
    if (el.target.type == 'zone') {
        axios({
            method: 'GET',
            url: '/get-data' + '/z' + el.target.number
        })
            .then(function (response) {
                canvas.clear();
                if (el.target.number === 124) {
                    canvas.setZoom(1 / 2);
                } else if (el.target.number === 412) {
                    canvas.setZoom(1 / 2);
                } else if (el.target.number === 324) {
                    canvas.setZoom(1 / 1.5);
                }else {
                    canvas.setZoom(1 / 1.2);
                }
                canvas.loadFromJSON(response.data);
                var imageSource= baseUrl + '/images/zones/' + el.target.number + '.png';
                $('#zoneMap').prepend('<a href="/"><img src="' + imageSource + '" class="img-responsive"/></a>');
                canvas.renderAll();

                // Event listener for the seats canvas
                canvas.on('mouse:down', function (el) {
                    var seat = el.target;

                    if (seat.status === 'AV') {
                        seat.setStroke('#F96868');
                        seat.setFill('#F96868');
                        seat.setStatus('SL');
                        view3d_module.load(seat.uuid);
                        cart.addToCart(seat);
                        canvas.renderAll();
                    } else if (seat.status === 'SL') {
                        seat.setStroke('#3AA99E');
                        seat.setFill('#3AA99E');
                        seat.setStatus('AV');
                        cart.removeFromCart(seat);
                        canvas.renderAll();
                    } else {
                        return false;
                    }
                });
            })
            .catch(function (error) {
                console.log(error);
            });
    } else{
        return false;
    }
}

function getZoneView(zone) {
    axios({
        method: 'GET',
        url: '/get-data/z' + zone
    })
        .then(function (response) {
            canvas.clear();
            if (zone === 124) {
                canvas.setZoom(1 / 2);
            } else if (zone === 412) {
                canvas.setZoom(1 / 2);
            } else if (zone === 324) {
                canvas.setZoom(1 / 1.5);
            }else {
                canvas.setZoom(1 / 1.2);
            }
            canvas.loadFromJSON(response.data);
            var imageSource= baseUrl + '/images/zones/' + zone + '.png';
            var zoneMap = $('#zoneMap');
            zoneMap.empty();
            zoneMap.prepend('<a href="/"><img src="' + imageSource + '" class="img-responsive"/></a>');
            canvas.renderAll();

            canvas.on('mouse:down', function (el) {
                var seat = el.target;

                if (seat.status === 'AV') {
                    seat.setStroke('#F96868');
                    seat.setFill('#F96868');
                    seat.setStatus('SL');
                    view3d_module.load(seat.uuid);
                    cart.addToCart(seat);
                    canvas.renderAll();
                } else if (seat.status === 'SL') {
                    seat.setStroke('#3AA99E');
                    seat.setFill('#3AA99E');
                    seat.setStatus('AV');
                    cart.removeFromCart(seat);
                    canvas.renderAll();
                } else {
                    return false;
                }
            });
        })
        .catch(function (error) {
            console.log(error);
        });
}

/**
 * Responsive Canvas function. Will be modified.
 */
function responsive()
{
    var w = document.getElementById("canvas-holder").offsetWidth;
    // var defaultWidth = 1040;
    // var defRatio = 1.3;
    // var h = Math.round(w/defRatio);
    //
    // if (h > window.innerHeight) {
    //     h = window.innerHeight - 240;
    //     w = Math.round(h * 1.3);
    // }
    // var wRatio = w / defaultWidth;

    canvas.setWidth(w);
    // canvas.setHeight(h);
}

function zoneResponsive()
{
    var w = canvas.getWidth();
    var defaultWidth = 1040;
    var wRatio = w / defaultWidth;
    canvas.forEachObject(function (zone) {
        for (var i = 0; i < zone.points.length; i++) {
            zone.points[i].x = Math.round(zone.points[i].x * wRatio);
            zone.points[i].y = Math.round(zone.points[i].y * wRatio);
        }
        console.log('Worked!');
        zone.initialize(zone.points, {
            number: zone.number,
            fill: zone.fill
        });
    });
    canvas.renderAll();
}