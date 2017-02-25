/**
 * Zone Class
 *
 * @type {fabric}
 */
fabric.Zone = new fabric.util.createClass(fabric.Polygon, {

    type: 'zone',

    /**
     * Initializer
     *
     * @param  {[array]} points  Polygon points
     * @param  {[array]} options Options for Polygon
     * @return {[object]}
     */
    initialize: function (points, options) {
        options || (options = { });

        this.callSuper('initialize', points, options);

        // Custom attributes
        this.set('number', options.number || 'Number not set!');

        // Set Defaults
        this.set('angle', options.angle || 0);
        this.set('evented', options.evented || true);
        this.set('hasControls', options.hasControls || false);
        this.set('hasRotatingPoint', options.hasRotatingPoint || false);
        this.set('hoverCursor', options.hoverCursor || 'pointer');
        this.set('lockMovementX', options.lockMovementX || true);
        this.set('lockMovementY', options.lockMovementY || true);
        this.set('lockRotation', options.lockRotation || true);
        this.set('hasBorders', options.hasBorders || false);

        // May change in the future
        this.set('selectable', options.selectable || true);
    },

    /**
     * Convert to object
     * @return {[object]}
     */
    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            number: this.get('number')
        });
    },

    toJSON: function() {
        return fabric.util.object.extend(this.callSuper('toJSON'), {
            number: this.get('number')
        });
    },

    // /**
    //  * Canvas renderer
    //  */
    // _render: function (ctx) {
    //     this.callSuper('_render', ctx);

    //     ctx.font = '10px Helvetica';
    //     ctx.fillStyle = '#fff';
    //     ctx.fillText(this.number, -(this.width / 2) + 15, 0, [15]);
    //     ctx.textAlign = 'center';
    // }
});

fabric.Zone.fromObject = function (object, callback, forceAsync) {
    return fabric.Object._fromObject('Zone', object, callback, forceAsync, ['points', 'number'])
};

// var canvas = new fabric.Canvas('c', {
//     backgroundColor: '#eee',
//     renderOnAddRemove: true
// });
//
// // var zone2 = new Zone([
// //     {x: 275.334, y: 199},
// // 	{x: 275.334, y: 228},
// // 	{x: 324.75, y: 228},
// // 	{x: 313.75, y: 199}],
// //   	{
// //         angle: 0,
// //         fill: '#ffa500',
// //         number: '126'
// // });
//
// var json = '{"objects":[{"angle":0,"backgroundColor":"","clipTo":null,"fill":"#ffa500","fillRule":"nonzero","flipX":false,"flipY":false,"globalCompositeOperation":"source-over","height":29,"left":275.33,"number":"126","opacity":1,"originX":"left","originY":"top","points":[{"x":275.334,"y":199},{"x":275.334,"y":228},{"x":324.75,"y":228},{"x":313.75,"y":199}],"scaleX":1,"scaleY":1,"shadow":null,"skewX":0,"skewY":0,"stroke":null,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"strokeWidth":1,"top":199,"transformMatrix":null,"type":"zone","visible":true,"width":49.42}],"background":""}';
// var json2 = '{"objects":[{"type":"seat","originX":"left","originY":"top","left":0,"top":0,"width":40,"height":40,"fill":"#fff","stroke":"#3aa99e","strokeWidth":3,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","transformMatrix":null,"skewX":0,"skewY":0,"radius":20,"startAngle":0,"endAngle":6.283185307179586,"number":1,"row":5,"status":"RS","zoneNumber":126}]}';
//
// canvas.loadFromJSON(json);
// canvas.renderAll();
//
// // canvas.add(zone2);
// canvas.on('object:selected', function(options) {
//     var selectedZone = options.target;
//
//     if (selectedZone.number == '126') {
//         canvas.clear();
//         canvas.loadFromJSON(json2);
//         canvas.renderAll();
//     }
// });
