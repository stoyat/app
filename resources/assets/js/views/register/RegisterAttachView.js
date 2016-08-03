/**
 * Created by Stepan on 03.08.2016.
 */
module.exports = Marionette.LayoutView.extend({
    events: {
        'submit': 'submitForm'
    },
    submitForm: function (e) {
        e.preventDefault();
        var arr = this.$el.serializeArray();
        var data = _(arr).reduce(function (acc, field) {
            acc[field.name] = field.value;
            return acc;
        }, {});
        var RecordModel = require("./../../models/RegisterModel");
        var record = new RecordModel();
        record.save(data, { success: function () {
            Backbone.history.navigate('/users/'+data.user_id, {
                trigger: true
            });
        }});
    },
    template: "register/Attach",
    tagName: "form",
    regions: {
        users: "#users",
        books: "#books"
    },
    onRender: function() {
        var BooksSelector = require("./RegisterBooksSelector");
        this.showChildView('books', new BooksSelector({
            collection: this.options.booksCollection
        }));

        var UsersSelector = require("./RegisterUsersSelector");
        this.showChildView('users', new UsersSelector({
            collection: this.options.usersCollection
        }));
    }
});