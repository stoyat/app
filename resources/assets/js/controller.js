/**
 * Created by Stepan on 02.08.2016.
 */
module.exports = {
    index: function () {
        var WelcomeView = require("./views/WelcomeView");
        App.content.show(new WelcomeView());
    },
    books: function () {
        Loading.show();
        var BookList = require("./models/BookCollection");
        var books = new BookList();
        books.fetch({
            success: function (coll) {
                var BooksView = require('./views/books/BooksTbView');
                App.content.show(new BooksView({
                    collection: coll
                }));
                Loading.hide();
            }
        });
    },
    book: function (id) {
        Loading.show();
        var BookModel = require("./models/BookModel");
        var book = new BookModel({id: id});
        book.fetch({
            success: function (book) {
                var BookView = require("./views/books/BookDetailView");
                App.content.show(new BookView({
                    model: book
                }));
                Loading.hide();
            }
        });
    },
    book_edit: function (id) {
        Loading.show();
        var BookModel = require("./models/BookModel");
        var book = new BookModel({id: id});
        book.fetch({
            success: function (book) {
                var BookEditView = require("./views/books/BookEditView");
                App.content.show(new BookEditView({
                    model: book
                }));
                Loading.hide();
            }
        });
    },
    book_delete: function (id) {
        Loading.show();
        var BookModel = require("./models/BookModel");
        var book = new BookModel({id: id});
        book.destroy({
            success: function () {
                Backbone.history.navigate('/books', {
                    trigger: true
                });
            }
        });
    },
    book_add: function () {
        var BookModel = require("./models/BookModel");
        var book = new BookModel();
        var BookEditView = require("./views/books/BookEditView");
        App.content.show(new BookEditView({model: book}));
    },
    register: function () {
        Loading.show();
        var RegisterList = require("./models/RegisterCollection");
        var register = new RegisterList();
        register.fetch({
            success: function (register) {
                var RegisterView = require("./views/register/RegisterTbView");
                App.content.show(new RegisterView({
                    collection: register
                }));
                Loading.hide();
            }
        });
    },
    register_delete: function (id) {
        Loading.show();
        var RecordModel = require("./models/RegisterModel");
        var record = new RecordModel({id: id});
        record.destroy({
            success: function () {
                Backbone.history.navigate('/bookregister', {
                    trigger: true
                });
            }
        });
    },
    register_create: function () {
        Loading.show();
        var BookList = require("./models/BookCollection");
        var UserList = require("./models/UserCollection");
        var books = new BookList();
        var users = new UserList();
        books.fetch({
            success: function (books) {
                users.fetch({
                    success: function (users) {
                        var RegisterAttachView = require("./views/register/RegisterAttachView");
                        App.content.show(new RegisterAttachView({
                            booksCollection: books,
                            usersCollection: users
                        }));
                        Loading.hide();
                    }
                });
            }
        });
    },
    users: function () {
        Loading.show();
        var UserList = require("./models/UserCollection");
        var users = new UserList();
        users.fetch({
            success: function (coll) {
                var UsersView = require("./views/users/UsersTbView");
                App.content.show(new UsersView({
                    collection: coll
                }));
                Loading.hide();
            }
        });
    },
    user: function (id) {
        Loading.show();
        var UserModel = require("./models/UserModel");
        var user = new UserModel({id: id});
        user.fetch({
            success: function (user) {
                var UserView = require("./views/users/UserDetailView");
                App.content.show(new UserView({
                    model: user,
                    collection: new Backbone.Collection(user.attributes.books)
                }));
                Loading.hide();
            }
        })
    },
    user_book_delete: function (id) {
        Loading.show();
        var RecordModel = require("./models/RegisterModel");
        var record = new RecordModel({id: id});
        record.destroy({
            success: function () {
                Backbone.history.history.back();
            }
        });
    }
};