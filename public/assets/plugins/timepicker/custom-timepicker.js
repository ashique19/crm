$('.timepicker').datetimepicker({
//          format: 'H:mm',    // use this format if you want the 24hours timepicker
    format: 'h:mm A',    //use this format if you want the 12hours timpiecker with AM/PM toggle
    icons: {
        time: 'now-ui-icons tech_watch-time',
        date: 'now-ui-icons ui-1_calendar-60',
        up: 'fa fa-angle-double-up',
        down: 'fa fa-angle-double-down',
        previous: 'fa fa-angle-double-left',
        next: 'fa fa-angle-double-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    },

    // inline: true,
    // sideBySide: true
 });

$('#setTimeExample').timepicker();
$('#setTimeButton').on('click', function (){
    $('#setTimeExample').timepicker('setTime', new Date());
});


$('#scrollDefaultExample').timepicker({ 'scrollDefault': 'now' });