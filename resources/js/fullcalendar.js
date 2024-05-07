import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction'; // pour les interactions comme le clic
import timeGridPlugin from '@fullcalendar/timegrid'; // pour la vue semaine et jour
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
      if (!debutDate) {
        // Premier clic : assigner à l'input avec l'ID 'debut'
        document.getElementById('debut').value = info.startStr;
        debutDate = info.startStr;
      } else {
        // Deuxième clic : assigner à l'input avec l'ID 'fin'
        document.getElementById('fin').value = info.startStr;
        debutDate = null; // Réinitialiser la première date
      }
    },
    fixedWeekCount: false, // Ajouté pour supprimer la barre de défilement
    height: 'auto', // Ajuste la hauteur pour afficher tous les jours
    headerToolbar: {
      start: 'title',
      center: '',
      end: 'today prev,next'
    },
  });

  calendar.render();
});
