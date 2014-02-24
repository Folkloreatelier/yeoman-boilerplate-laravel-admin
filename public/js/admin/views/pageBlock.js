define(
[

	'jquery',
	'underscore',
	'backbone',

	'ckeditor'

],
function(

	$,_,Backbone,

	CKEDITOR

) {

	'use strict';

	var PageBlockView = Backbone.View.extend({

		tagName: 'div',
		className: 'block col-sm-12 col-md-6',

		options: {
			html: ''
		},

		events: {
			'click .remove a' : 'clickRemove'
		},

		initialize: function() {

		},

		render: function() {

			if(this.options.html && this.options.html.length) {
				this.$el.html(this.options.html);
			}

		},

		clickRemove: function(e) {
			e.preventDefault();

			this.$el.fadeOut('fast',_.bind(function() {
				this.remove();
				this.trigger('remove');
			},this));

		}

	});

	return PageBlockView;

});