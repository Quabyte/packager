/**
 * Seat Class
 *
 * @type {fabric object}
 */
fabric.Seat = new fabric.util.createClass(fabric.Circle, {

    type: 'seat',

    /**
     * Initializer
     *
     * @param  {[array]} options Options array for zone.
     * @return {[object]}
     */
    initialize: function(options) {
        options || (options = { });

        this.callSuper('initialize', options);
        this.set('number', options.number || 'Number not set!');
        this.set('row', options.row || '');
        this.set('status', options.status || 'IA');
        this.set('zoneNumber', options.zoneNumber || 'Zone number not set!');
        this.set('price', options.price || 'Price not set!');
        this.set('uuid', options.uuid || '');
        this.set('categoryColor', options.categoryColor || '#000000');
        this.set('categoryID', options.categoryID || 0);

        // Defaults
        this.set('fill', options.fill || '#fff');
        this.set('hasBorders', options.hasBorders || false);
        this.set('hasControls', options.hasControls || false);
        this.set('hasRotatingPoint', options.hasRotatingPoint || false);
        this.set('hoverCursor', options.hoverCursor || 'pointer');
        this.set('lockMovementX', options.lockMovementX || true);
        this.set('lockMovementY', options.lockMovementY || true);
        this.set('lockRotation', options.lockRotation || true);
        this.set('radius', options.radius || 10);
        switch (this.status) {
            case "IA":
                this.set('stroke', options.stroke || '#76838F');
                this.set('fill', options.fill || '#76838F');
                this.set('selectable', options.selectable || false);
                break;
            case "AV":
                this.set('stroke', options.stroke || '#46BE8A');
                this.set('fill', options.fill || '#46BE8A');
                this.set('selectable', options.selectable || true);
            default:

        }
        // this.set('stroke', options.stroke || '#3aa99e');
        this.set('strokeWidth', options.strokeWidth || 3);
    },

    /**
     * Convert to object
     *
     * @return {[object]}
     */
    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            number: this.get('number'),
            row: this.get('row'),
            status: this.get('status'),
            zoneNumber: this.get('zoneNumber'),
            price: this.get('price'),
            categoryID: this.get('categoryID'),
            categoryColor: this.get('categoryColor'),
            uuid: this.get('uuid'),
        });
    },

    /**
     * Canvas renderer
     */
    _render: function(ctx) {
      this.callSuper('_render', ctx);

      ctx.font = '15px Helvetica';
      ctx.fillStyle = '#fff';
      ctx.fillText(this.number, -this.radius/2 + 1, -this.radius/2 + 10, [7]);
    },

    setStatus: function(status) {
        this.set('status', status || 'AV');
    }
});

fabric.Seat.fromObject = function (object, callback, forceAsync) {
    return fabric.Object._fromObject('Seat', object, callback, forceAsync)
};
