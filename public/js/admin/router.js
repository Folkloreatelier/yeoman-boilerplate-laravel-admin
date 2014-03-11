define(
[
	'jquery','underscore','backbone',

    'views/pageBlocks'

],

function(

	$,_,Backbone,

    PageBlocksView

) {

	'use strict';

	var Router = Backbone.Router.extend({

        routes: {
            'admin/pages/create' : 'pagesForm',
            'admin/pages/:slug/edit' : 'pagesForm',
            '*path' : 'all'
        },


        all: function(path) {

            App.init.table($('#content'));
            App.init.form($('#content'));

        },

        pagesForm: function() {

            App.init.form($('#content'));

            var pageBlocks = new PageBlocksView({
                el: $('#content .blocks')
            });
            pageBlocks.render();

        }

    });


    return Router;


});