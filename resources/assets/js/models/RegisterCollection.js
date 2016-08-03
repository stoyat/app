/**
 * Created by Stepan on 02.08.2016.
 */
module.exports = Backbone.Collection.extend({
    url: '/api/userbook',
    model: require("./RegisterModel")
});