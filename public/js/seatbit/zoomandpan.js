$(function() {
    $('#zoomIn').click(function () {
        canvas.setZoom(canvas.getZoom() * 1.2);
    });

    $('#zoomOut').click(function () {
        canvas.setZoom(canvas.getZoom() / 1.2);
    });

    $('#goLeft').click(function () {
        var units = 30;
        var delta = new fabric.Point(units, 0);
        canvas.relativePan(delta);
    });

    $('#goRight').click(function () {
        var units = 30;
        var delta = new fabric.Point(-units, 0);
        canvas.relativePan(delta);
    });

    $('#goDown').click(function () {
        var units = 30;
        var delta = new fabric.Point(0, -units);
        canvas.relativePan(delta);
    });

    $('#goUp').click(function () {
        var units = 30;
        var delta = new fabric.Point(0, units);
        canvas.relativePan(delta);
    });
});