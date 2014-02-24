require.config({

    baseUrl: '/js',

    paths: {
        'jquery': 'components/jquery/jquery.min',
        'text': 'components/requirejs-text/text',
        'underscore': 'components/underscore/underscore-min',
        'backbone': 'components/backbone/backbone',

        'ckeditor' : 'components/ckeditor/ckeditor',
        'jquery-fineuploader': 'admin/vendor/fineuploader-4.1.1/jquery.fineuploader-4.1.1',
        'image' : '../packages/folklore/image/js/image',

        //jQuery UI
        'jquery-ui-core': 'components/jquery-ui/ui/jquery.ui.core',
        'jquery-ui-widget': 'components/jquery-ui/ui/jquery.ui.widget',
        'jquery-ui-mouse': 'components/jquery-ui/ui/jquery.ui.mouse',
        'jquery-ui-position': 'components/jquery-ui/ui/jquery.ui.position',
        'jquery-ui-draggable': 'components/jquery-ui/ui/jquery.ui.draggable',
        'jquery-ui-sortable': 'components/jquery-ui/ui/jquery.ui.sortable',
        'jquery-ui-autocomplete': 'components/jquery-ui/ui/jquery.ui.autocomplete',
        'jquery-ui-menu': 'components/jquery-ui/ui/jquery.ui.menu',
        'jquery-ui-datepicker': 'components/jquery-ui/ui/jquery.ui.datepicker',
        'jquery-ui-datepicker-fr': 'components/jquery-ui/ui/i18n/jquery.ui.datepicker-fr-CA',

        //Bootstrap
        'bootstrap-affix': 'components/sass-bootstrap/js/affix',
        'bootstrap-alert': 'components/sass-bootstrap/js/alert',
        'bootstrap-dropdown': 'components/sass-bootstrap/js/dropdown',
        'bootstrap-tooltip': 'components/sass-bootstrap/js/tooltip',
        'bootstrap-modal': 'components/sass-bootstrap/js/modal',
        'bootstrap-transition': 'components/sass-bootstrap/js/transition',
        'bootstrap-button': 'components/sass-bootstrap/js/button',
        'bootstrap-popover': 'components/sass-bootstrap/js/popover',
        'bootstrap-carousel': 'components/sass-bootstrap/js/carousel',
        'bootstrap-scrollspy': 'components/sass-bootstrap/js/scrollspy',
        'bootstrap-collapse': 'components/sass-bootstrap/js/collapse',
        'bootstrap-tab': 'components/sass-bootstrap/js/tab',

        'bootstrap-tokenfield': 'components/bootstrap-tokenfield/bootstrap-tokenfield/bootstrap-tokenfield',
        
        'app' : 'admin/app',
        'controllers' : 'admin/controllers',
        'views' : 'admin/views',
        'models' : 'admin/models',
        'collections' : 'admin/collections',
        'templates' : 'admin/templates'

    },
    shim: {

        'underscore': {exports: '_'},
        'backbone': {exports: 'Backbone',deps: ['jquery','underscore']},

        'ckeditor' : {exports: 'CKEDITOR'},
        'jquery-fineuploader' : {deps: ['jquery']},

        //Bootstrap
        'bootstrap-affix': {deps:['jquery']},
        'bootstrap-alert': {deps:['jquery', 'bootstrap-transition']},
        'bootstrap-button': {deps:['jquery']},
        'bootstrap-carousel': {deps:['jquery', 'bootstrap-transition']},
        'bootstrap-collapse': {deps:['jquery', 'bootstrap-transition']},
        'bootstrap-dropdown': {deps:['jquery']},
        'bootstrap-modal':{deps:['jquery', 'bootstrap-transition']},
        'bootstrap-popover': {deps:['jquery', 'bootstrap-tooltip']},
        'bootstrap-scrollspy': {deps:['jquery']},
        'bootstrap-tab': {deps:['jquery', 'bootstrap-transition']},
        'bootstrap-tooltip': {deps:['jquery', 'bootstrap-transition']},
        'bootstrap-transition': {deps:['jquery']},

        'bootstrap-tokenfield': {deps:['jquery']},
        
        //jQuery UI
        'jquery-ui-core': {deps: ['jquery']},
        'jquery-ui-position': {deps: ['jquery-ui-core']},
        'jquery-ui-widget': {deps: ['jquery-ui-core']},
        'jquery-ui-datepicker': {deps: ['jquery-ui-core','jquery-ui-widget']},
        'jquery-ui-datepicker-fr': {deps: ['jquery-ui-datepicker']},
        'jquery-ui-mouse': {deps: ['jquery-ui-core','jquery-ui-widget']},
        'jquery-ui-draggable': {deps: ['jquery-ui-core','jquery-ui-widget','jquery-ui-position','jquery-ui-mouse']},
        'jquery-ui-sortable': {deps: ['jquery-ui-core','jquery-ui-widget','jquery-ui-position','jquery-ui-mouse']},
        'jquery-ui-menu': {deps: ['jquery-ui-core','jquery-ui-widget','jquery-ui-position']},
        'jquery-ui-autocomplete': {deps: ['jquery-ui-core','jquery-ui-widget','jquery-ui-position','jquery-ui-menu']}

    }
});

require(
[
    'jquery','underscore','backbone',

    'app'

], function ($,_,Backbone,App) {

    'use strict';

    $(function() {
        App.init();
    });
});