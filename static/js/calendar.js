/**
 * Função de integração do calendário da Google
 * com o template definido no html.
 * 
 * @author Daniel Teixeira e rc
 */

$(document).ready(function () {
    $(function () {
        $('#calendar').fullCalendar({

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaWeek,month,listWeek'
            },

            displayEventTime: false, // don't show the time column in list view
            googleCalendarApiKey: 'AIzaSyDnT8fO6ARjx3OxMJCimhenNDLTkGuOmjE',
            events: {
                googleCalendarId: '7m2mlm7k1huomjeaa45gbhog0k@group.calendar.google.com'
            }
        });
    });
});