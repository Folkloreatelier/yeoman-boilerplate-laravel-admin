define(
[

	'jquery',
	'underscore',
	'backbone',

	'views/pageBlock',

	'ckeditor'

],
function(

	$,_,Backbone,

	PageBlockView,

	CKEDITOR

) {

	'use strict';

	var PageBlockTextView = PageBlockView.extend({

		className: 'block block-text col-sm-12 col-md-12',

		options: _.extend(PageBlockView.prototype.events,{
			html: ''
		}),

		events: _.extend(PageBlockView.prototype.events,{
			
		}),

		initialize: function() {

			this.listenTo(this,'drag:start',this._handleDragStart);
			this.listenTo(this,'drag:stop',this._handleDragStop);

		},

		render: function() {

			PageBlockView.prototype.render.apply(this,arguments);

			this.initEditors();

		},

		initEditors: function() {

			this.$('textarea.editor').each(function() {

				var editor;
				if(CKEDITOR.instances[$(this).attr('name')]) {
					editor = CKEDITOR.instances[$(this).attr('name')];
				} else {
					editor = CKEDITOR.replace($(this)[0],{
		                customConfig : '/js/admin/ckeditor_config.js',
		                height: $(this).attr('data-editor-height') ? parseInt($(this).attr('data-editor-height')):400,
		                startupFocus: false,
		                toolbar: $(this).attr('data-editor-toolbar') || 'Basic'
		            });
		        }
	            $(this).data('editor',editor);

	        });
		},

		clearEditors: function() {
			this.$('textarea.editor').each(function() {

				if($(this).data('editor')) {
					$(this).data('editor').destroy();
					$(this).data('editor',null);
				}

	        });
		},

		remove: function(e) {

			this.clearEditors();
			PageBlockView.prototype.remove.apply(this,arguments);

		},

		_handleDragStop: function() {
			this.initEditors();
		},

		_handleDragStart: function() {
			this.clearEditors();
		}

	});

	return PageBlockTextView;

});