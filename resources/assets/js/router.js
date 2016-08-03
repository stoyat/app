/**
 * Created by Stepan on 02.08.2016.
 */

module.exports = new Marionette.AppRouter({
    controller: require('./controller'),
    appRoutes: {
        "": "index",
        "books/create": "book_add",
        "books": "books",
        "books/:id": "book",
        "books/:id/edit": "book_edit",
        "books/:id/delete": "book_delete",
        "users": "users",
        "users/:id": "user",
        "userbook/:id/delete": "user_book_delete",
        "bookregister/create": "register_create",
        "bookregister/:id/delete": "register_delete",
        "bookregister": "register"
    }
});