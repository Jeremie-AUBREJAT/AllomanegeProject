import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';
import frLocale from '@fullcalendar/core/locales/fr';

document.addEventListener('DOMContentLoaded', function() {
  var debutInput = document.getElementById('debut');
  var finInput = document.getElementById('fin');
  var currentInput = debutInput; // Commencer avec le champ debutInput
  var calendarEl = document.getElementById('calendar');
  var calendar = new Calendar(calendarEl, {
    plugins: [ dayGridPlugin, interactionPlugin, timeGridPlugin ],
    locale: frLocale,
    initialView: 'dayGridMonth',
    selectable: true,
    select: function(info) {
      currentInput.value = info.startStr; // Remplir le champ d'entrée actuel
      currentInput.dispatchEvent(new Event('input')); // Déclencher l'événement input
      
      // Changer le champ d'entrée actuel pour le prochain clic
      if (currentInput === debutInput) {
        currentInput = finInput;
      } else {
        currentInput = debutInput;
      }
    },
    fixedWeekCount: false,
    height: 'auto',
    headerToolbar: {
      start: 'title',
      center: '',
      end: 'today prev,next'
    },
    eventContent: function(arg) {
      var eventTitle = document.createElement('div');
      eventTitle.classList.add('fc-event-title');
      eventTitle.innerHTML = 'Réservé';
      return { domNodes: [eventTitle] };
    }
  });

  calendar.render();


  // Écoutez l'événement Livewire pour les dates réservées
  Livewire.on('reservedDates', function(data) {
    var reservedDates = data[0].dates;
    console.log('Données reçues de Livewire :', data);
    // Parcourez les dates réservées et ajoutez les événements au calendrier
    reservedDates.forEach(function(dateRange) {
        var endDate = new Date(dateRange.end);
        endDate.setDate(endDate.getDate() + 1); // Ajoute un jour à la date de fin
        calendar.addEvent({
            start: dateRange.start,
            end: endDate, // Utilisez la nouvelle date de fin avec un jour ajouté
            classNames: ['reservedDates']
        });
    });
    
    calendar.render(); // Assurez-vous de rendre à nouveau le calendrier pour afficher les événements
});

});
