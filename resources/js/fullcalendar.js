import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';
import frLocale from '@fullcalendar/core/locales/fr';

document.addEventListener('DOMContentLoaded', function() {
  var debutDate = null;
  var calendarEl = document.getElementById('calendar');
  var calendar = new Calendar(calendarEl, {
    plugins: [ dayGridPlugin, interactionPlugin, timeGridPlugin ],
    locale: frLocale,
    initialView: 'dayGridMonth',
    selectable: true,
    select: function(info) {
      var debutInput = document.getElementById('debut');
      var finInput = document.getElementById('fin');
      
      if (!debutInput.value) {
        debutInput.value = info.startStr;
        debutInput.dispatchEvent(new Event('input'));
      } else {
        finInput.value = info.startStr;
        finInput.dispatchEvent(new Event('input'));
      }
    },
    fixedWeekCount: false,
    height: 'auto',
    headerToolbar: {
      start: 'title',
      center: '',
      end: 'today prev,next'
    },
  });

  calendar.render();

  // Écoutez l'événement Livewire pour les dates réservées
Livewire.on('reservedDates', function(data) {
    var reservedDates = data[0].dates; // Correction ici
    console.log('Données reçues de Livewire :', data);
    // Parcourez les dates réservées et ajoutez les événements au calendrier
    reservedDates.forEach(function(dateRange) {
        calendar.addEvent({
            start: dateRange.start,
            end: dateRange.end,
            classNames: ['reservedDates']
        });
    });
    
    calendar.render(); // Assurez-vous de rendre à nouveau le calendrier pour afficher les événements
});

});
