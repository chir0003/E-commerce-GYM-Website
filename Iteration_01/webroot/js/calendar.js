document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var baseUrl = '/team031-app_fit3047/Iteration_01';  // Local development path
    console.log('Base URL:', baseUrl); // Debug log
    console.log("window.location.pathname is:", window.location.pathname);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        height: 'auto',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridDay,timeGridWeek,dayGridMonth'
        },
        events: {
            url: baseUrl + '/appointments/calendar',
            // url: '/appointments/calendar',
            method: 'GET',
            failure: function(error) {
                console.error('Failed to load events:', error);
            },
            success: function(content) {
                console.log('Events loaded:', content);
            }
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: 'short'
        },
eventMouseEnter: function(info) {
            // Remove existing popup if any
            let existingPopup = document.querySelector('.fc-event-popup');
            if (existingPopup) {
                existingPopup.remove();
            }

            // Create the popup element
            let popup = document.createElement('div');
            popup.className = 'fc-event-popup';
            popup.style.position = 'absolute';
            popup.style.zIndex = '1000';
            popup.style.backgroundColor = 'white';
            popup.style.border = '1px solid #ccc';
            popup.style.padding = '10px';
            popup.style.borderRadius = '5px';

            // Populate the popup with event information
            let content = `
                <p><b>Appointment ID:</b> ${info.event.id || 'N/A'}</p>
                <p><b>Appointment Name:</b> ${info.event.title || 'N/A'}</p>
                <p><b>Service Requested:</b> ${info.event.extendedProps.service || 'N/A'}</p>
                <p><b>Address:</b> ${info.event.extendedProps.address || 'N/A'}</p>
                <p><b>Time:</b> ${moment(info.event.start).format('MMMM Do YYYY, h:mm a') || 'N/A'}</p>
                <button class="go-to-appointment btn btn-warning" data-appointment-id="${info.event.id}" style="width: 100%;">Go</button>
            `;
            popup.innerHTML = content;

            // Append the popup to the calendar
            document.body.appendChild(popup);

            // Position the popup relative to the event element
            let eventRect = info.el.getBoundingClientRect();
            let bodyRect = document.body.getBoundingClientRect();

            popup.style.top = (eventRect.top - bodyRect.top - popup.offsetHeight - 10) + 'px';
            popup.style.left = (eventRect.left - bodyRect.left + eventRect.width + 10) + 'px';

            // Store the popup in the event element for later removal
            info.el.setAttribute('data-popup', 'true');

            // Add event listener for the "Go" button
            popup.querySelector('.go-to-appointment').addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent the click from closing the popup
                let appointmentId = event.target.dataset.appointmentId;
                window.location.href = baseUrl + '/appointments/view/' + appointmentId;
            });

            // Add a listener to the document to close the popup on outside click
            document.addEventListener('click', function closePopup(event) {
                if (!popup.contains(event.target) && event.target !== info.el) {
                    popup.remove();
                    document.removeEventListener('click', closePopup);
                }
            });
        },
        eventMouseLeave: function(info) {
           // Remove the popup
        }
    });
    console.log("FullCalendar initialized, eventClick should be active.");

    calendar.render();

});
