define(
[

	'jquery',
	'underscore',
	'backbone',

	'text!templates/photoUploader.html',
	'text!templates/photoUploader.photo.html',

	'image',

	'jquery-fineuploader',
	'jquery-ui-sortable'

],
function(

	$,_,Backbone,

	uploadTemplate,
	photoTemplate,

	Img

) {

	'use strict';

	var PhotoUploadView = Backbone.View.extend({

		tagName: 'div',
		className: 'photoUploader',

		template: _.template(uploadTemplate),
		templatePhoto: _.template(photoTemplate),

		options: {
			multiple: false,
			inputName : 'photo',
			maxWidth: 400,
			maxHeight: 400
		},

		events: {
			'click .photos .photo .remove' : 'removePhoto'
		},

		initialize: function() {


		},

		render: function() {

			var currentPhotos = [];
			if(this.$('input[name="'+this.options.inputName+'"]').length) {
				this.$('input[name="'+this.options.inputName+'"]').each(function() {
					currentPhotos.push(JSON.parse(unescape($(this).val())));
				});
			}
			console.log(currentPhotos);

			//HTML
			this.$el.html(this.template({
				'inputName' : this.options.inputName
			}));

			if(this.options.multiple) {
				this.$el.addClass('multiple');
				this.$('.photos').sortable({
					'items' : '.photo',
					'handle' : 'img, .options'
				});
			}

			//Uploader
			this.$('.uploadButton').fineUploader({
				debug: false,
				multiple: this.options.multiple,
				listElement: this.$('.actions .file ul'),
				request: {
					inputName: 'file',
					endpoint: '/admin/upload/photo'
				},
				dragAndDrop: {
					extraDropzones: [this.$('.photo')],
					hideDropzones: false,
					disableDefaultDropzone: true
				},
				text: {
					uploadButton: this.options.multiple ? 'Ajouter des photos':'Sélectionner une photo'
				}
			}).on('error', function(event, id, name, reason) {
				
			}).on('complete', _.bind(function(event, id, name, responseJSON){
				var photo = responseJSON.response;
				this.addPhoto(photo);
			},this));


			//Add current pictures
			if(currentPhotos.length) {
				_.each(currentPhotos, _.bind(function(photo) {
					this.addPhoto(photo);
				},this));
			}

		},

		addPhoto: function(photo) {

			if(!this.options.multiple) {
				this.$('.photos .photo').remove();
			}

			var photoURL = '/files/photos/'+photo.filename;
			if(this.options.multiple) {
				photoURL = Img.url(photoURL, 100, 100, {'crop':true});
			} else {
				photoURL = Img.url(photoURL, this.options.maxWidth, this.options.maxHeight);
			}

			var photoHTML = this.templatePhoto({
				photoURL: photoURL,
				options: this.options
			});
			var $photo = $(photoHTML);
			$photo.find('input[type=hidden]').val(JSON.stringify(photo));

			this.$('.photos').append($photo);

			if(this.options.multiple) {
				this.$('.photos').sortable('refresh');
			}

		},

		removePhoto: function(e) {

			if(e) {
				e.preventDefault();
			}

			$(e.currentTarget).parents('.photo').eq(0).remove();

			if(this.options.multiple) {
				this.$('.photos').sortable('refresh');
			}

		},

		remove: function() {

			Backbone.View.prototype.remove.apply(this,arguments);
		}

	});

	return PhotoUploadView;

});