/**
 * Created by Stepan on 03.08.2016.
 */
module.exports = Marionette.ItemView.extend({
    template: "register/AttachUsersSelector",
    tagName: "select",
    className: "form-control",
    attributes: {
        name: "user_id"
    }
});