/**
 * Created by Stepan on 02.08.2016.
 */

module.exports = Backbone.Model.extend({
    urlRoot: '/api/users',
    validate: function (attrs, options) {
        if (!/([A-z]{6,})/.test(attrs.firstname))
            return "Incorrect firstname";
        if (!/([A-z]{6,})/.test(attrs.lastname))
            return "Incorrect lastname";
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(attrs.email))
            return "Incorrect email";
    }
});