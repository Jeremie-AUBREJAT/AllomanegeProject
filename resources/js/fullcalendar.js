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
    contentHeight: 'auto',
    headerToolbar: {
      start: 'title',
      center: '',
      end: 'today prev,next'
    },
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

        // Supprimer l'heure de la date de début et de fin
        var startDateWithoutTime = new Date(dateRange.start);
        startDateWithoutTime.setHours(0, 0, 0, 0);
        var endDateWithoutTime = new Date(endDate);
        endDateWithoutTime.setHours(0, 0, 0, 0);

        // Déterminer la classe CSS à utiliser en fonction du statut
        var className = 'reservedDates';
        if (dateRange.status === 'approved') {
            className += ' reservedDates-approved';
        } else if (dateRange.status === 'pending') {
            className += ' reservedDates-pending';
        } else if (dateRange.status === 'rejected') {
            className += ' reservedDates-rejected';
        }

        // Déterminer le titre à utiliser en fonction du statut
        var title = '';
        if (dateRange.status === 'approved') {
            title = 'Réservé';
        } else if (dateRange.status === 'pending') {
            title = 'En attente de validation';
        }

        calendar.addEvent({
            start: startDateWithoutTime,
            end: endDateWithoutTime, // Utilisez la nouvelle date de fin avec un jour ajouté
            title: title, // Utilise le titre déterminé en fonction du statut
            classNames: [className],
            
        });
    });
    
    calendar.render(); // Assurez-vous de rendre à nouveau le calendrier pour afficher les événements
    var eventTimes = document.querySelectorAll('.fc-event-time');
    eventTimes.forEach(function(eventTime) {
      eventTime.style.display = 'none';
    });
});

});
