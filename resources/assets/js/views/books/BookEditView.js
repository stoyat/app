/**
 * Created by Stepan on 03.08.2016.
 */
module.exports = Marionette.ItemView.extend({
    template: "books/Edit",
    tagName: "form",
    events: {
        'submit': 'submitForm'
    },
    submitForm: function (e) {
        e.preventDefault();
        var model = this.model;
        var arr = this.$el.serializeArray();
        var data = _(arr).reduce(function (acc, field) {
            model.set(field.name, field.value);
        }, {});
        if (!model.isValid()) {
            alert(model.validationError);
            return;
        }
        Loading.show();
        model.save(data, {success: function () {
            Backbone.history.navigate('/books', {
                trigger: true
            });
        }});
    }
});
