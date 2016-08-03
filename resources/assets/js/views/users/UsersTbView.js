/**
 * Created by Stepan on 02.08.2016.
 */
module.exports = Marionette.CompositeView.extend({
    tagName: "table",
    className: "table table-responsive table-hover table-bordered",
    template: "users/Tb",
    childView: require("./UsersTbItemView"),
    childViewContainer: "tbody"
});