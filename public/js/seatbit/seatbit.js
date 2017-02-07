var canvas = new fabric.Canvas('c', {
    backgroundColor: '#eeeeee'
});

$(document).ready(function () {
    responsive();
    axios({
        method: 'get',
        url: '/load-venue'
    })
        .then(function (response) {
            canvas.loadFromJSON(response.data);
            canvas.renderAll();
        })
        .catch(function (response) {
           console.log(response)
        });

    canvas.on('object:selected', function(el) {
        selected(el);
    });
});

function selected(el) {
    if (el.target.type == 'zone') {
        axios({
            method: 'GET',
            url: '/get-data' + '/z' + el.target.number
        })
            .then(function (response) {
                canvas.clear();
                canvas.setZoom(canvas.getZoom() / 1.5);
                canvas.loadFromJSON(response.data);
                canvas.renderAll();
            })
            .catch(function (error) {
                console.log(error);
            });
    } else if (el.target.type == 'seat') {
        // Add seat to shopping cart
        // Temporarily block the seat
        // Start 10min counter for the seat
    }
}

function getZoneView(zone) {
    axios({
        method: 'GET',
        url: '/get-data/z' + zone
    })
        .then(function (response) {
            canvas.clear();
            canvas.setZoom(1 / 1.5);
            canvas.loadFromJSON(response.data);
            canvas.renderAll();
        });
}

function responsive()
{
    var w = document.getElementById("canvas-holder").offsetWidth;
    var defaultWidth = 1040;
    var defRatio = 1.3;
    var h = Math.round(w/defRatio);

    if (h > window.innerHeight) {
        h = window.innerHeight - 60;
        w = Math.round(h * 1.3);
    }
    var wRatio = w / defaultWidth;

    canvas.setWidth(w);
    canvas.setHeight(h);
    canvas.forEachObject(function (zone) {

        for (var i = 0; i < zone.points.length; i++) {
            zone.points[i].x = Math.round(zone.points[i].x * wRatio);
            zone.points[i].y = Math.round(zone.points[i].y * wRatio);
        }

        zone.initialize(zone.points, {
            number: zone.number,
            fill: zone.fill
        });
    });
}