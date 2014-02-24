define(
[

	'jquery',
	'underscore',
	'backbone',

	'models/uploader-file'

],
function(

	$,_,Backbone,

	UploaderFileModel

) {

	'use strict';

	var UploaderFilesCollection = Backbone.Collection.extend({

		model: UploaderFileModel

	});

	return UploaderFilesCollection;

});