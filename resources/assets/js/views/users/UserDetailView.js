/**
 * Created by Stepan on 03.08.2016.
 */
module.exports = Marionette.LayoutView.extend({
    template: "users/Detail",
    tagName: "div",
    className: "row",
    regions: {
        user: "#user",
        books: "#books"
    },
    onRender: function() {
        var UserDetailBooksView = require("./../../views/users/UserDetailBooksTb");
        this.showChildView('books', new UserDetailBooksView({
            collection: this.collection
        }));

        var UserDetailInfoView = require("./../../views/users/UserDetailInfo");
        this.showChildView('user', new UserDetailInfoView({
            model: this.model
        }));
    }
});