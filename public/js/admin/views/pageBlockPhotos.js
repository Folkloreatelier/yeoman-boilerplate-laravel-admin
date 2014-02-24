define(
[

	'jquery',
	'underscore',
	'backbone',

	'views/pageBlock',
	'views/uploader'

],
function(

	$,_,Backbone,

	PageBlockView,
	UploaderView

) {

	'use strict';

	var PageBlockPhotoView = PageBlockView.extend({

		className: 'block block-photo col-sm-12 col-md-12',

		options: _.extend(PageBlockView.prototype.events,{
			html: ''
		}),

		events: _.extend(PageBlockView.prototype.events,{
			
		}),

		render: function() {

			PageBlockView.prototype.render.apply(this,arguments);

			//Uploader
            this.$('.block-uploader').each(function() {
                var uploader = new UploaderView({
                    el: $(this),
                    inputName: $(this).data('uploader-inputname'),
					setInputValue: function() {
						this.$('input[type=hidden]').val(this.model.get('id'));
					}
                });
                uploader.render();
            });

		}

	});

	return PageBlockPhotoView;

});