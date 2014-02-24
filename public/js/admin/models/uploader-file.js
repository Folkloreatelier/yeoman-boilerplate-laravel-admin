define(
[

	'jquery',
	'underscore',
	'backbone'

],
function(

	$,_,Backbone

) {

	'use strict';

	var UploaderFileModel = Backbone.Model.extend({

		defaults: {
			uploader_loading: false,
			uploader_completed: false,
			uploader_progress: 0
		}

	});

	return UploaderFileModel;

});