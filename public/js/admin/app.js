define(
[
	'jquery','underscore','backbone',

	'ckeditor',

	'views/photoUploader',

    'jquery-ui-datepicker',
    'jquery-ui-datepicker-fr',

    'bootstrap-affix',
    'bootstrap-alert',
    'bootstrap-button',
    'bootstrap-carousel',
    'bootstrap-collapse',
    'bootstrap-dropdown',
    'bootstrap-modal',
    'bootstrap-popover',
    'bootstrap-scrollspy',
    'bootstrap-tab',
    'bootstrap-tooltip',
    'bootstrap-transition'

],

function(

	$,_,Backbone,

	CKEDITOR,

	PhotoUploaderView

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

			var router = App.router = new Backbone.Router();

			//All pages
			router.route('admin/*path', 'home', function(path){

				

			});

		},

		'initEvents' : function() {

		},

		initLayout: function() {

			$('#content textarea.editor').each(function() {
				var editor = CKEDITOR.replace($(this)[0],{
					customConfig : '/js/ckeditor_config.js',
					height: 500
				});
			});

			$('#content input.datepicker').each(function() {
				$(this).datepicker({
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
					changeYear: true
				});
			});

			//Guest photo
			$('#content .photoUploader').each(function() {
				var uploader = new PhotoUploaderView({
					el: $(this),
					inputName: $(this).attr('data-input-name'),
					multiple: $(this).attr('data-multiple') ? Boolean($(this).attr('data-multiple')):false
				});
				uploader.render();
			});

		}

	};
	_.extend(App, Backbone.Events);
	window.App = App;

	return App;

});