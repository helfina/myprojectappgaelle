
document.addEventListener('DOMContentLoaded', function() {
    /* initialize the external events
-----------------------------------------------------------------*/

    var containerEl = document.getElementById('external-events-list');
    new FullCalendar.Draggable(containerEl, {
        itemSelector: '.fc-event',
        eventData: function(eventEl) {
            return {
                title: eventEl.innerText.trim()
            }
        }
    });




    var calendarEl = document.getElementById('calendar');
    var initialLocaleCode = 'fr';
    var localeSelectorEl = document.getElementById('locale-selector');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prevYear,prev,next,nextYear today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },

        initialDate: '2022-05-12',
        locale: initialLocaleCode,
        navLinks: true, // can click day/week names to navigate views
        nowIndicator: true,

        weekNumbers: true,
        weekNumberCalculation: 'local',

        editable: true,
        selectable: true,
        dayMaxEvents: true, // allow "more" link when too many events

        select: function(arg) {
            var title = prompt('Event Title:');
            if (title) {
                calendar.addEvent({
                    title: title,
                    start: arg.start,
                    end: arg.end,
                    allDay: arg.allDay
                })
            }
            calendar.unselect()
        },
        droppable: true, // this allows things to be dropped onto the calendar
        drop: function(arg) {
            // is the "remove after drop" checkbox checked?
            if (document.getElementById('drop-remove').checked) {
                // if so, remove the element from the "Draggable Events" list
                arg.draggedEl.parentNode.removeChild(arg.draggedEl);
            }
        },
        eventClick: function(arg) {
            if (confirm('Are you sure you want to delete this event?')) {
                arg.event.remove()
            }
        },
        events: {
            url: './php/get-events.php',
            failure: function() {
                document.getElementById('script-warning').style.display = 'block'
            }
        },
        loading: function(bool) {
            document.getElementById('loading').style.display =
                bool ? 'block' : 'none';
        }

    });

    calendar.render();
    // build the locale selector's options
    calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
        var optionEl = document.createElement('option');
        optionEl.value = localeCode;
        optionEl.selected = localeCode === initialLocaleCode;
        optionEl.innerText = localeCode;
        localeSelectorEl.appendChild(optionEl);
    });

    // when the selected option changes, dynamically change the calendar option
    localeSelectorEl.addEventListener('change', function() {
        if (this.value) {
            calendar.setOption('locale', this.value);
        }
    });
});

