/**
 * Created by Stepan on 02.08.2016.
 */

$ = require("jquery");
Backbone = require("backbone");
Backbone.$ = require("jquery");
_ = require("underscore");
Marionette = require("backbone.marionette");

Marionette.Renderer.render = function(template, data){
    return Templates[template](data);
};

Loading = {
    show: function () {
        $("#loading").show();
    },
    hide: function () {
        $("#loading").hide();
    }
};

App = new Marionette.Application();

App.addRegions({
    content: "#content",
    menu: "#menu-container"
});

App.addInitializer(function(){
    App.AppRouter = require("./Router");
    Backbone.history.start();
});

$(document).ready(function(){
    App.start();
});
