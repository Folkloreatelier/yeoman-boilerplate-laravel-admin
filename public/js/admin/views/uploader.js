define(
[

	'jquery',
	'underscore',
	'backbone',

	'views/uploader-file',
	'views/uploader-photo',

	'models/uploader-file',
	'collections/uploader-files',

	'text!templates/uploader.html',
	'text!templates/uploader-file.html',

	'jquery-fineuploader',
	'jquery-ui-sortable'

],
function(

	$,_,Backbone,

	UploaderFileView,
	UploaderPhotoView,

	UploaderFileModel,
	UploaderFilesCollection,

	uploadTemplate

) {

	'use strict';

	var UploaderView = Backbone.View.extend({

		tagName: 'div',
		className: 'uploader',

		template: _.template(uploadTemplate),

		options: {
			multiple: true,
			inputName: 'files[]',
			gallery: true,
			setInputValue: function() {
				this.$('input[type=hidden]').val(JSON.stringify(this.model.toJSON()));
			}
		},

		events: {
			
		},

		uploader: null,

		initialize: function() {

			this.files = new UploaderFilesCollection();

		},

		render: function() {

			var currentFiles = [];
			if(this.$('input[name="'+this.options.inputName+'"]').length) {
				this.$('input[name="'+this.options.inputName+'"]').each(function() {
					currentFiles.push(JSON.parse(unescape($(this).val())));
				});
			}

			this.$el.html(this.template({
				inputName : this.options.inputName,
				multiple : this.options.multiple,
				gallery : this.options.gallery
			}));

			this.$el.addClass('admin-uploader');

			this.$('.btn-upload').fineUploader({
				button: this.$('.btn-upload')[0],
				uploaderType: 'basic',
				debug: false,
				multiple: this.options.multiple,
				request: {
					inputName: 'file',
					endpoint: this.options.gallery ? '/admin/upload/photo':'/admin/upload/file'
				},
				camera: {
					ios: true
				},
				validation: {
					acceptFiles: '',
					allowedExtensions: this.options.gallery ? ['jpg','jpeg','gif','png']:[],
				}
			})
			.on('submit', _.bind(this._handleUploaderSubmit,this))
			.on('upload', _.bind(this._handleUploaderUpload,this))
			.on('complete', _.bind(this._handleUploaderComplete,this))
			.on('progress', _.bind(this._handleUploaderProgress,this));

			this.$('.files').sortable({
				items: '.file',
				handle: '.handle'
			});

			_.each(currentFiles, _.bind(function(file) {
				file.uploader_completed = true;
				file.uploader_progress = 1;
				this.addFile(file);
			},this));
			

		},

		addFile: function(file) {

			var fileModel = new UploaderFileModel(file);

			var viewOptions = {
				model: fileModel,
				inputName: this.options.inputName,
				setInputValue: this.options.setInputValue
			};

			var fileView;
			if(this.options.gallery) {
				fileView = fileModel.view = new UploaderPhotoView(viewOptions);
			} else {
				fileView = fileModel.view = new UploaderFileView(viewOptions);
			}

			this.$('.files').append(fileView.$el);

			fileView.render();

			this.listenTo(fileView,'delete',function() {
				fileView.$el.fadeOut('fast',_.bind(function() {
					this.removeFile(fileModel);
				},this));
			});

			if(!this.options.multiple && this.files.length) {
				this.files.forEach(function(file) {
					file.view.remove();
				});
				this.files.reset([fileModel]);
			} else {
				this.files.add(fileModel);
			}

			/*if(this.options.gallery) {
				this.$('.files .thumbnail').equalHeights();
			}*/

			this.$('.files').sortable('refresh');

		},

		removeFile: function(fileModel) {

			this.files.remove(fileModel);
			fileModel.view.remove();
			this.$('.files').sortable('refresh');

		},

		remove: function() {

			Backbone.View.prototype.remove.apply(this,arguments);
		},

		_handleUploaderSubmit: function (event, id, name) {
			
			this.addFile({
				uploader_id: id,
				original: name
			});
		},

		_handleUploaderUpload: function (event, id, name) {
			var file = this.files.findWhere({
				uploader_id: id
			});
			file.set('uploader_loading',true);
		},

		_handleUploaderComplete: function (event, id, name, response) {
			var file = this.files.findWhere({
				uploader_id: id
			});
			file.set(response.response);
			file.set('uploader_loading',false);
			file.set('uploader_completed',true);
			file.set('uploader_progress',1);

			/*if(this.options.gallery) {
				file.view.$('img').each(_.bind(function(i,el) {
					var img = $(el)[0];
					img.onload = _.bind(function() {
						console.log('load',this.$('.files .thumbnail').height());
						this.$('.files .thumbnail').equalHeights();
					},this);
				},this));
			}*/
		},

		_handleUploaderProgress: function (event, id, name, uploaded, total) {
			var file = this.files.findWhere({
				uploader_id: id
			});
			file.set('uploader_progress',uploaded/total);
		}

	});

	return UploaderView;

});