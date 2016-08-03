/**
 * Created by Stepan on 26.07.2016.
 */
Loading = {
    show: function () {
        $("#loading").show();
    },
    hide: function () {
        $("#loading").hide();
    }
};

App = new Backbone.Marionette.Application();

App.addRegions({
    content: "#content",
    menu: "#menu-container"
});

/** --- --- --- Models --- --- --- **/
{
    BookModel = Backbone.Model.extend({
        urlRoot: '/api/books',
        defaults: {
            title: "",
            author: "",
            year: "",
            genre: ""
        },
        validate: function (attrs, options) {
            var re = /^[a-zA-Z][a-zA-Z \.]{5,}$/;
            if(!re.test(attrs.title))
                return "Incorrect title";
            if(!re.test(attrs.author))
                return "Incorrect author";
            if(!/^[a-zA-Z][a-zA-Z \.]{3,}$/.test(attrs.genre))
                return "Incorrect genre";
            var now = new Date();
            if(!(Number(attrs.year) < now.getFullYear()))
                return "Incorrect year";
        }
    });
    BookList = Backbone.Collection.extend({
        url: '/api/books',
        model: BookModel
    });
    RecordModel = Backbone.Model.extend({
        urlRoot: '/api/userbook'
    });
    RegisterList = Backbone.Collection.extend({
        url: '/api/userbook',
        model: RecordModel
    });
    UserModel = Backbone.Model.extend({
        urlRoot: '/api/users',
        validate: function (attrs, options) {
            if(!/([A-z]{6,})/.test(attrs.firstname))
                return "Incorrect firstname";
            if(!/([A-z]{6,})/.test(attrs.lastname))
                return "Incorrect lastname";
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!re.test(attrs.email))
                return "Incorrect genre";
            var now = new Date();
            if(!attrs.year < now.getFullYear())
                return "Incorrect year";
        }
    });
    UserList = Backbone.Collection.extend({
        url: '/api/users',
        model: UserModel
    });
}

/** --- --- --- Views --- --- --- **/
{
    WelcomeView = Marionette.ItemView.extend({
        template: "#welcome"
    });

    UserView = Marionette.ItemView.extend({
        template: "#user-template",
        tagName: 'tr'
    });
    UsersView = Marionette.CompositeView.extend({
        tagName: "table",
        className: "table table-responsive table-hover table-bordered",
        template: "#users-template",
        childView: UserView,
        childViewContainer: "tbody"
    });
    UserDetailBookView = Marionette.ItemView.extend({
        template: "#user_detail_book-template",
        tagName: 'tr'
    });
    UserDetailBooksView = Marionette.CompositeView.extend({
        tagName: "table",
        className: "table table-responsive table-hover table-bordered",
        template: "#books-template",
        childView: UserDetailBookView,
        childViewContainer: "tbody"
    });
    UserDetailInfoView = Marionette.ItemView.extend({
        tagName: "div",
        className: "col-md-12",
        template: "#user_detail_info-template"
    });
    UserDetailView = Marionette.LayoutView.extend({
        template: "#user_detail-template",
        tagName: "div",
        className: "row",
        regions: {
            user: "#user",
            books: "#books"
        },
        onRender: function() {
            this.showChildView('books', new UserDetailBooksView({
                collection: this.collection
            }));

            this.showChildView('user', new UserDetailInfoView({
                model: this.model
            }));
        }
    });

    BookView = Marionette.ItemView.extend({
        template: "#book-template",
        tagName: 'tr'
    });
    BooksView = Marionette.CompositeView.extend({
        tagName: "table",
        className: "table table-responsive table-hover table-bordered",
        template: "#books-template",
        childView: BookView,
        childViewContainer: "tbody"
    });
    BookDetailView = Marionette.ItemView.extend({
        template: "#book_detail-template",
        tagName: "div",
        className: "row"
    });
    BookEditView = Marionette.ItemView.extend({
        template: "#book_edit-template",
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
            model.save(data, {success: function () {
                Backbone.history.navigate('/books', {
                    trigger: true
                });
            }});
        }
    });

    RegisterRecordView = Marionette.ItemView.extend({
        template: "#register_record-template",
        tagName: "tr"
    });
    RegisterView = Marionette.CompositeView.extend({
        tagName: "table",
        className: "table table-responsive table-hover table-bordered",
        template: "#register_list-template",
        childView: RegisterRecordView,
        childViewContainer: "tbody"
    });
    RegisterBookItemView = Marionette.ItemView.extend({
        template: "#register_books-template",
        tagName: "select",
        className: "form-control",
        attributes: {
            name: "book_id"
        }
    });
    RegisterUserItemView = Marionette.ItemView.extend({
        template: "#register_users_item-template",
        tagName: "select",
        className: "form-control",
        attributes: {
            name: "user_id"
        }
    });
    RegisterAttachView = Marionette.LayoutView.extend({
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
            var record = new RecordModel();
            record.save(data, { success: function () {
                Backbone.history.navigate('/users/'+data.user_id, {
                    trigger: true
                });
            }});
        },
        template: "#register_attach-template",
        tagName: "form",
        regions: {
            users: "#users",
            books: "#books"
        },
        onRender: function() {
            this.showChildView('books', new RegisterBookItemView({
                collection: this.options.booksCollection
            }));

            this.showChildView('users', new RegisterUserItemView({
                collection: this.options.usersCollection
            }));
        }
    });
}
/** --- --- --- Route/Controller --- --- --- **/
new Marionette.AppRouter({
    controller: {
        index: function () {
            App.content.show(new WelcomeView());
        },
        books: function () {
            Loading.show();
            var books = new BookList();
            books.fetch({
                success: function (coll) {
                    App.content.show(new BooksView({
                        collection: coll
                    }));
                    Loading.hide();
                }
            });

        },
        book: function (id) {
            Loading.show();
            var book = new BookModel({id: id});
            book.fetch({
                success: function (book) {
                    App.content.show(new BookDetailView({
                        model: book
                    }));
                    Loading.hide();
                }
            });
        },
        book_edit: function (id) {
            Loading.show();
            var book = new BookModel({id: id});
            book.fetch({
                success: function (book) {
                    App.content.show(new BookEditView({
                        model: book
                    }));
                    Loading.hide();
                }
            });
        },
        book_delete: function (id) {
            Loading.show();
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
            var book = new BookModel();
            App.content.show(new BookEditView({ model: book}));
        },
        register: function () {
            Loading.show();
            var register = new RegisterList();
            register.fetch({
                success: function (register) {
                    App.content.show(new RegisterView({
                        collection: register
                    }));
                    Loading.hide();
                }
            });
        },
        register_delete: function (id) {
            Loading.show();
            var record = new RecordModel({id: id});
            record.destroy({success: function () {
                Backbone.history.navigate('/bookregister', {
                    trigger: true
                });
            }});
        },
        register_create: function () {
            Loading.show();
            var books = new BookList();
            var users = new UserList();
            books.fetch({
                success: function (books) {
                    users.fetch({
                        success: function (users) {
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
            var users = new UserList();
            users.fetch({
                success: function (coll) {
                    App.content.show(new UsersView({
                        collection: coll
                    }));
                    Loading.hide();
                }
            });
        },
        user:function (id) {
            Loading.show();
            var user = new UserModel({id: id});
            user.fetch({
                success: function (user) {
                    App.content.show(new UserDetailView({
                        model: user,
                        collection: new Backbone.Collection(user.attributes.books)
                    }));
                    Loading.hide();
                }
            })
        },
        user_book_delete: function (id) {
            Loading.show();
            var record = new RecordModel({id: id});
            record.destroy({
                success: function () {
                    Backbone.history.history.back();
                }
            });
        }
    },
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

App.addInitializer(function(options){
    Backbone.history.start();
});

$(document).ready(function(){
    App.start();
});
