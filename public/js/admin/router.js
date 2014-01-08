define(
[
	'jquery','underscore','backbone',

	'ckeditor',

	'views/photoUploader',

    'jquery-ui-datepicker',
    'jquery-ui-datepicker-fr',

    'bootstrap-affix',
    'bootstrap-alert',
    'bootstrap-button',
    'bootstrap-carousel',
    'bootstrap-collapse',
    'bootstrap-dropdown',
    'bootstrap-modal',
    'bootstrap-popover',
    'bootstrap-scrollspy',
    'bootstrap-tab',
    'bootstrap-tooltip',
    'bootstrap-transition'

],

function(

	$,_,Backbone,

	CKEDITOR,

	PhotoUploaderView

) {

	'use strict';

	var Router = Backbone.Router.extend({

        routes: {
            '*path' : 'all'
        },


        all: function(path) {

            this._initTable();
            this._initForm();

        },

        _initTable: function() {
            $('#content table.items').on('click', 'form.delete a', function(e) {
                e.preventDefault();
                if(confirm('Êtes-vous certain de vouloir supprimer cet item?')) {
                    $(this).parents('form.delete').submit();
                }
            });
        },

        _initForm: function() {

            $('#content textarea.editor').each(function() {
                var editor = CKEDITOR.replace($(this)[0],{
                    customConfig : '/js/admin/ckeditor_config.js',
                    height: $(this).attr('data-editor-height') ? parseInt($(this).attr('data-editor-height')):400
                });
            });

            $('#content input.datepicker').each(function() {
                $(this).datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true
                });
            });

            //Guest photo
            $('#content .photoUploader').each(function() {
                var uploader = new PhotoUploaderView({
                    el: $(this),
                    inputName: $(this).attr('data-input-name'),
                    multiple: $(this).attr('data-multiple') ? Boolean($(this).attr('data-multiple')):false
                });
                uploader.render();
            });

        }

    });


    return Router;


});