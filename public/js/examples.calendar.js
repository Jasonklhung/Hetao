/*
Name: 			Pages / Calendar - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	2.2.0
*/

(function($) {

	'use strict';

	var initCalendarDragNDrop = function() {
		$('#external-events div.external-event').each(function() {

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});
	};

	var initCalendar = function() {
		var $calendar = $('#calendar');
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		$calendar.fullCalendar({
			eventLimit: true, // for all non-agenda views  
			views: {  
		        agenda: {  
		            eventLimit: 2 // adjust to 6 only for agendaWeek/agendaDay  
		        }  
	    	},  
			header: {
				left: 'title',
				right: 'prev,today,next,basicDay,basicWeek,month,search'
			},
			timeFormat: 'h:mm',
			themeButtonIcons: {
				prev: 'fas fa-caret-left',
				next: 'fas fa-caret-right',
			},

			editable: false,
			droppable: false, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped
				var $externalEvent = $(this);
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $externalEvent.data('eventObject');

				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);

				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;
				copiedEventObject.className = $externalEvent.attr('data-event-class');

				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

				// is the "remove after drop" checkbox checked?
				if ($('#RemoveAfterDrop').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}

			},
			events: [
				{
					title: '2張工單',
					start: new Date(y, m, 1),
					url: "#job",
					className: 'fc-event-success',
					allDay: true,
				},
				{
					title: '會議',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2),
					url: "#meet",
				},
				{
					title: '會議',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false,
					url: "#meet",
				},
				{
					title: '2張工單',
					start: new Date(y, m, d+4, 16, 0),
					url: "#job",
					className: 'fc-event-success',
					allDay: true,
				},
				{
					title: '工單○○',
					start: new Date(y, m, d, 10, 30),
					url: "#job1",
					className: 'fc-event-success',
					allDay: true,
				},
				{
					title: '會議',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false,
					url: "#meet",
				},
				{
					title: '會議',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false,
					url: "#meet",
				},
				{
					title: '會議',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: "#meet",
				},
				{
					title: '會議',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: "#meet",
				},
				{
					title: '會議',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: "#meet",
				},
				{
					title: '會議',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: "#meet",
				},
				{
					title: '會議',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: "#meet",
				},
				{
					title: '會議77',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: "#meet",
				}
			],
			eventClick: function(info) {
			    $(info.url).modal('show')
		    }
		});

		// FIX INPUTS TO BOOTSTRAP VERSIONS
		var $calendarButtons = $calendar.find('.fc-header-right > span');
		$calendarButtons
			.filter('.fc-button-prev, .fc-button-today, .fc-button-next')
				.wrapAll('<div class="btn-group mt-sm mr-md mb-sm ml-sm"></div>')
				.parent()
				.after('<br class="hidden"/>');

		$calendarButtons
			.not('.fc-button-prev, .fc-button-today, .fc-button-next')
				.wrapAll('<div class="btn-group mb-sm mt-sm"></div>');

		$calendarButtons
			.attr({ 'class': 'btn btn-sm btn-default' });
	};

	$(function() {
		initCalendar();
		initCalendarDragNDrop();
	});

}).apply(this, [jQuery]);