/* 
Arquivo para controlar o plugin do FullCalendar
*/

(function (win, doc) {
    function getCalendar(div) {
        'use strict';

        //calendario medico 
        let calendarEl = doc.querySelector(div);
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            timezone: 'local',
            locale: 'pt-br',

            headerToolbar: {
                start: 'prev,next today', // will normally be on the left. if RTL, will be on the right
                center: 'title',
                end: 'dayGridMonth,timeGridWeek,timeGridDay' // will normally be on the right. if RTL, will be on the left
            },
            buttonText: {
                month: 'Mês',
                week: 'Semana',
                day: 'Dia',
                today: 'Hoje'
            },
            dateClick: function (info) {

                if (info.view.type == 'dayGridMonth') {
                    calendar.changeView('timeGridDay', info.dateStr);
                } else {
                    win.location.href = 'consulta/create?date=' + info.dateStr;
                }


            },
            events: 'consulta/getEvents',
            eventClick: function (info) {
                win.location.href = 'consulta/editar/' + info.event.id;
            }

        });
        calendar.render();
    }

    if (doc.querySelector('.calendar')) {
        getCalendar('.calendar');
    }

    if (doc.querySelector('#delete')) {
        let btn = doc.querySelector('#delete');
        btn.addEventListener('click', (event) => {
            event.preventDefault();
            if (confirm("Deseja mesmo excluir?")) {
                window.location.href = event.target.href;
            }
        }, false);
    }

})(window, document);


