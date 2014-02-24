define(
[

	'jquery',
	'underscore',
	'backbone',

	'image',

	'views/uploader-file',

	'text!templates/uploader-photo.html'

],
function(

	$,_,Backbone,

	Img,

	UploaderFileView,

	fileTemplate

) {

	'use strict';

	var UploaderPhotoView = UploaderFileView.extend({

		tagName: 'div',
		className: 'file col-sm-4 col-md-2',

		template: _.template(fileTemplate),

		render: function() {

			this.$el.html(this.template({
				'model' : this.model,
				'options' : this.options,
				'photo' : this.model.get('filename') ? Img.url('/files/photos/'+this.model.get('filename'),{'uploader':true}):null
			}));

			this.options.setInputValue.call(this);

		}

	});

	return UploaderPhotoView;

});