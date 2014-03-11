define(
[
	'jquery','underscore','backbone',

	'admin/init',

    'views/pageBlocks'

],

function(

	$,_,Backbone,

	Init,

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

            Init.table($('#content'));
            Init.form($('#content'));

        },

        pagesForm: function() {

            Init.form($('#content'));

            var pageBlocks = new PageBlocksView({
                el: $('#content .blocks')
            });
            pageBlocks.render();

        }

    });


    return Router;


});