/**
 * Created by Stepan on 03.08.2016.
 */
module.exports = Marionette.CompositeView.extend({
    tagName: "table",
    className: "table table-responsive table-hover table-bordered",
    template: "register/Tb",
    childView: require("./RegisterTbItem"),
    childViewContainer: "tbody"
});