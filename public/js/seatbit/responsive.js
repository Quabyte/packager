function responsive() {
    var w = document.getElementById("canvas-holder").offsetWidth;
    var defaultWidth = 1040;
    // var defaultHeight = 800;
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

responsive();
canvas.renderAll();
