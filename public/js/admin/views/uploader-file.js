define(
[

	'jquery',
	'underscore',
	'backbone',

	'text!templates/uploader-file.html'

],
function(

	$,_,Backbone,

	fileTemplate

) {

	'use strict';

	var UploaderFileView = Backbone.View.extend({

		tagName: 'li',
		className: 'file list-group-item',

		template: _.template(fileTemplate),

		options: {
			
		},

		events: {
			'click .btn-cancel' : '_clickCancel',
			'click .btn-delete' : '_clickDelete'
		},

		initialize: function() {

			this.listenTo(this.model, 'change:uploader_progress', this._handleUploaderProgress);
			this.listenTo(this.model, 'change:uploader_loading', this._handleUploaderLoading);
			this.listenTo(this.model, 'change:uploader_completed', this._handleUploaderCompleted);

		},

		render: function() {

			this.$el.html(this.template({
				'model' : this.model,
				'options' : this.options
			}));

			this.options.setInputValue.call(this);

		},

		_clickCancel: function(e) {
			e.preventDefault();
		},

		_clickDelete: function(e) {
			e.preventDefault();

			this.trigger('delete');
		},

		_handleUploaderProgress: function() {
			var progress = this.model.get('uploader_progress');
			this.$('.progress .progress-bar').css('width',progress*100 + '%');
		},

		_handleUploaderLoading: function() {
			var uploading = this.model.get('uploader_loading');
			if(uploading) {

			} else {

			}
		},

		_handleUploaderCompleted: function() {
			var completed = this.model.get('uploader_completed');
			this.render();
		}

	});

	return UploaderFileView;

});