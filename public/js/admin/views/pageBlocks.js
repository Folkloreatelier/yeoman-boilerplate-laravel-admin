define(
[

	'jquery',
	'underscore',
	'backbone',

	'views/pageBlockText',
	'views/pageBlockPhotos',

	'jquery-ui-sortable'

],
function(

	$,_,Backbone,

	PageBlockTextView,
	PageBlockPhotosView

) {

	'use strict';

	var PageBlockViewByType = {
		'text' : PageBlockTextView,
		'photos' : PageBlockPhotosView
	};

	var PageBlocksView = Backbone.View.extend({

		options: {
			
		},

		templates: null,

		events: {
			'click .btn-group.add .dropdown-menu a' : 'clickAdd'
		},

		initialize: function() {


		},

		render: function() {

			this.templates = {};
			this.$('script.template').each(_.bind(function(i,el) {
				this.templates[$(el).data('block-type')] = _.template($(el).html());
			},this));

			this.$('.list').sortable({
				placeholder: 'block-placeholder',
				forcePlaceholderSize: true,
				forceHelperSize: true,
				tolerance: 'pointer',
				items: '.block',
				handle: '.nav-tabs li.disabled a',
				change: _.bind(this._handleSortableChange,this),
				start: _.bind(this._handleSortableStart,this),
				stop: _.bind(this._handleSortableStop,this)
			});

			if(this.$('.list .block').length) {
				this.$('.list .block').each(_.bind(function(i,element) {
					var type = $(element).data('block-type');
					this.addBlock(type,element);
				},this));
			}

		},

		addBlock: function(type,el) {

			var pageBlock = new PageBlockViewByType[type](!el ? {
				html: this.templates[type]({
					index: this.$('.list .block').length
				})
			}:{
				el: el
			});
			if(!el) {
				this.$('.list').append(pageBlock.$el);
			}
			pageBlock.render();
			pageBlock.$el.data('pageBlock',pageBlock);

			this.listenTo(pageBlock,'remove',function() {
				this.updateList();
			});

			this.updateList();

		},

		clickAdd: function(e) {
			e.preventDefault();

			var type = $(e.currentTarget).data('block-type');

			this.addBlock(type);

		},

		updateList: function() {

			this.updateBlocksIndex();

			this.$('.list').sortable('refresh');

			if(this.$('.list .block').length) {
				this.$('.noblock').hide();
			} else {
				this.$('.noblock').show();
			}
		},

		updateBlocksIndex: function() {

			this.$('.list > .block:not(.ui-sortable-placeholder)').each(function(i,el) {
				$(el).find('.nav-tabs li.disabled a .index').text(i+1);
			});

		},

		_handleSortableChange: function(e,ui) {



		},

		_handleSortableStart: function(e,ui) {

			$(ui.placeholder).height($(ui.item).height());

			var pageBlock = $(ui.item).data('pageBlock');
			pageBlock.trigger('drag:start');

		},

		_handleSortableStop: function(e,ui) {

			this.updateBlocksIndex();

			var pageBlock = $(ui.item).data('pageBlock');
			pageBlock.trigger('drag:stop');

		}

	});

	return PageBlocksView;

});