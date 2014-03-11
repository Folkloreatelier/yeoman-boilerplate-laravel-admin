define(['jquery','pickadate-date'],function($){

	$.extend( $.fn.pickadate.defaults, {
        monthsFull: [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' ],
        monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec' ],
        weekdaysFull: [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ],
        weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
        today: 'Aujourd\'hui',
        clear: 'Effacer',
        firstDay: 1,
        format: 'dd mmmm yyyy',
        formatSubmit: 'yyyy/mm/dd',
        klass: {
            input: 'picker-input',
            active: 'picker-input-active',
            picker: 'picker',
            opened: 'picker-opened',
            focused: 'picker-focused',
            holder: 'picker-holder',
            frame: 'picker-frame',
            wrap: 'picker-wrap',
            box: 'picker-box',
            header: 'picker-header',
            navPrev: 'picker-nav-prev',
            navNext: 'picker-nav-next',
            navDisabled: 'picker-nav-disabled',
            month: 'picker-month',
            year: 'picker-year',
            selectMonth: 'picker-select-month',
            selectYear: 'picker-select-year',
            table: 'picker-table',
            weekdays: 'picker-weekday',
            list: 'picker-list',
            listItem: 'picker-list-item',
            day: 'picker-day',
            disabled: 'picker-day-disabled',
            selected: 'picker-day-selected',
            highlighted: 'picker-day-highlighted',
            viewset: 'picker-list-item-viewset',
            now: 'picker-day-today',
            infocus: 'picker-day-infocus',
            outfocus: 'picker-day-outfocus',
            footer: 'picker-footer',
            buttonClear: 'picker-button-clear',
            buttonToday: 'picker-button-today'
        }
    });

});