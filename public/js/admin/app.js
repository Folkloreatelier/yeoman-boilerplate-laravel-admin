define(
[
	'jquery','underscore','backbone',

	'admin/router'

],

function(

	$,_,Backbone,

	Router

) {

	'use strict';

	var App = {

		'router' : null,

		'init' : function() {

			App.initRouter();

			App.initEvents();

			App.initLayout();

			Backbone.history.start({pushState: true});

		},

		'initRouter' : function() {

			var router = new Router();

		},

		'initEvents' : function() {

		}

	};
	_.extend(App, Backbone.Events);
	window.App = App;

	return App;

});