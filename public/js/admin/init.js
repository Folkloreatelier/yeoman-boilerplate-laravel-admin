define(
[
	'jquery','underscore','backbone',

	'ckeditor',

    'views/uploader',

    'jquery-ui-datepicker',
    'jquery-ui-datepicker-fr',
    'jquery-ui-autocomplete',

    'pickadate-date',
    'pickadate-time',
    'pickadate-fr',

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

    UploaderView

) {

	'use strict';

	var Init = {

		table: function($context)
		{
			if(typeof($context) === 'undefined') {
				$context = $('body');
			}

			$context.find('table.items').on('click', 'form.delete a', function(e) {
                e.preventDefault();
                if(confirm('Êtes-vous certain de vouloir supprimer cet item?')) {
                    $(this).parents('form.delete').submit();
                }
            });

		},

		form: function($context)
		{
			if(typeof($context) === 'undefined') {
				$context = $('body');
			}

			//Editor
			Init.editor($context.find('textarea.editor'));

            //Datepicker (jQuery UI)
            Init.datepicker($context.find('input.datepicker'));

            //Datepicker (Pickadate)
            Init.pickadate($context.find('input.picker-date'));

            //Timepicker
            Init.pickatime($context.find('input.picker-time'));

            //Uploader
            Init.uploader($context.find('.uploader'));

		},

		editor: function($el) {
			$el.each(function() {
                var editor = CKEDITOR.replace($(this)[0],{
                    customConfig : '/js/admin/ckeditor_config.js',
                    height: $(this).attr('data-editor-height') ? parseInt($(this).attr('data-editor-height')):400,
                    toolbar: $(this).attr('data-editor-toolbar') || 'Basic'
                });
            });
		},

		uploader: function($el) {
			$el.each(function() {
                var uploader = new UploaderView({
                    el: $(this),
                    inputName: $(this).data('uploader-inputname') ? $(this).data('uploader-inputname'):'files[]',
                    setInputValue: function() {
                        this.$('input[type=hidden]').val(this.model.get('id'));
                    }
                });
                uploader.render();
            });
		},

		datepicker: function($el) {
			$el.each(function() {
                $(this).datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true
                });
            });
		},

		pickadate: function($el) {
			$el.each(function() {
                $(this).pickadate({
                    format: 'yyyy-mm-dd',
                    klass: $.extend({},$.fn.pickadate.defaults.klass)
                });
            });
		},

		pickatime: function($el) {
			$el.each(function() {
                $(this).pickatime({
                    format: 'HH:i',
                    interval: 30,
                    min: [9,0],
                    max: [23,0],
                    klass: $.extend({},$.fn.pickadate.defaults.klass,{
                        picker: 'picker picker-time'
                    })
                });
            });
		}

	};
    _.extend(Init, Backbone.Events);

	return Init;


});