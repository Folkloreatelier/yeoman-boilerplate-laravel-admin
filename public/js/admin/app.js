define(
[
	'jquery','underscore','backbone',

	'admin/init',
	'admin/router'

],

function(

	$,_,Backbone,

	Init,
	Router

) {

	'use strict';

	var App = {

		'router' : null,

		'init' : Init,

		'boot' : function() {

			App.router = new Router();

			Backbone.history.start({pushState: true});

		}

	};
	_.extend(App, Backbone.Events);
	window.App = App;

	return App;

});