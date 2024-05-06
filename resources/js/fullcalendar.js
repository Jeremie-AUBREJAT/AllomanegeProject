import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction'; // pour les interactions comme le clic
import timeGridPlugin from '@fullcalendar/timegrid'; // pour la vue semaine et jour
import frLocale from '@fullcalendar/core/locales/fr';

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new Calendar(calendarEl, {
    plugins: [ dayGridPlugin, interactionPlugin, timeGridPlugin ],
    locale: frLocale,
    initialView: 'dayGridMonth',
    fixedWeekCount: false, // Ajouté pour supprimer la barre de défilement
    height: 'auto', // Ajuste la hauteur pour afficher tous les jours
    headerToolbar: {
      start: 'title',
      center: '',
      end: 'today prev,next'
    },
    
    
    // eventClassNames: function(arg) {
    //   return ['bg-orange-500', 'text-white', 'p-2']; // Classes Tailwind
    // }
    // autres options...
  });

  calendar.render();
});
