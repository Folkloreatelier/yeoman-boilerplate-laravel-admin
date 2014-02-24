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

	var PageBlockTeamView = PageBlockView.extend({

		className: 'block block-team col-sm-12 col-md-12',

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
                    multiple: false,
                    inputName: $(this).data('uploader-inputname'),
					setInputValue: function() {
						this.$('input[type=hidden]').val(this.model.get('id'));
					}
                });
                uploader.render();
            });

		}

	});

	return PageBlockTeamView;

});