define(
[
	'jquery','underscore','backbone',

	'ckeditor',

    'views/uploader',
    'views/pageBlocks',

    'jquery-ui-datepicker',
    'jquery-ui-datepicker-fr',
    'jquery-ui-autocomplete',

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
    'bootstrap-transition',
    'bootstrap-tokenfield'

],

function(

	$,_,Backbone,

	CKEDITOR,

    UploaderView,
    PageBlocksView

) {

	'use strict';

	var Router = Backbone.Router.extend({

        routes: {
            'admin/pages/create' : 'pagesForm',
            'admin/pages/:slug/edit' : 'pagesForm',
            '*path' : 'all'
        },


        all: function(path) {

            this._initTable();
            this._initForm();

        },

        pagesForm: function() {

            this._initForm();

            var pageBlocks = new PageBlocksView({
                el: $('#content .blocks')
            });
            pageBlocks.render();

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
                    height: $(this).attr('data-editor-height') ? parseInt($(this).attr('data-editor-height')):400,
                    toolbar: $(this).attr('data-editor-toolbar') || 'Basic'
                });
            });

            $('#content input.datepicker').each(function() {
                $(this).datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true
                });
            });

            //Uploader
            $('#content .uploader').each(function() {
                var uploader = new UploaderView({
                    el: $(this),
                    inputName: $(this).data('uploader-inputname') ? $(this).data('uploader-inputname'):'files[]',
                    setInputValue: function() {
                        this.$('input[type=hidden]').val(this.model.get('id'));
                    }
                });
                uploader.render();
            });

        }

    });


    return Router;


});