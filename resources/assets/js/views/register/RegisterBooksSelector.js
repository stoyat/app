/**
 * Created by Stepan on 03.08.2016.
 */
module.exports = Marionette.ItemView.extend({
    template: "register/AttachBooksSelector",
    tagName: "select",
    className: "form-control",
    attributes: {
        name: "book_id"
    }
});