/**
 * Created by Stepan on 02.08.2016.
 */
module.exports = Backbone.Model.extend({
    urlRoot: '/api/books',
    defaults: {
        title: "",
        author: "",
        year: "",
        genre: ""
    },
    validate: function (attrs, options) {
        var re = /^[a-zA-Z][a-zA-Z \.]{5,}$/;
        if (!re.test(attrs.title))
            return "Incorrect title";
        if (!re.test(attrs.author))
            return "Incorrect author";
        if (!/^[a-zA-Z][a-zA-Z \.]{3,}$/.test(attrs.genre))
            return "Incorrect genre";
        var now = new Date();
        if (!(Number(attrs.year) < now.getFullYear()))
            return "Incorrect year";
    }
});