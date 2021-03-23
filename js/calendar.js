'use strict'

// google API
const API_KEY = 'AIzaSyC97AEclCTslyM2V3YTVFaNrecngF3uH0w'
const CALENDAR_ID = 'qs9fuv1lvl15snqecn0c58n0i4@group.calendar.google.com';
const CLIENT_ID = '507396238793-88mtbp563rkjsnp3n9agckcjha136ifq.apps.googleusercontent.com'
let calendar = null
let isMobile = false

if (window.matchMedia( "(max-width: 769px)" ).matches) {
  isMobile = true
}

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: ''
    },
    locale: 'ja',
    displayEventTime: false, // don't show the time column in list view
    buttonText: {
      today: '今日'
    },

    googleCalendarApiKey: API_KEY,
    events: CALENDAR_ID,
    eventColor: '#836c39',

    eventClick: function(arg) {
      console.log(arg.event)
      let event = arg.event._def
      console.log(event)
      let eventDayTimeRange = arg.event._instance.range
      let titleEl = document.getElementById('eventTitle')
      let dayEl = document.getElementById('eventDay')
      let startTimeEl = document.getElementById('eventStartTime')
      let endTimeEl = document.getElementById('eventEndTime')
      modal.style.display = 'block'
      titleEl.textContent = event.title
      console.log(eventDayTimeRange.start)
      dayEl.textContent = dateFns.format(dateFns.subHours(eventDayTimeRange.start, 9), "YYYY/MM/DD")
      startTimeEl.textContent = dateFns.format(dateFns.subHours(eventDayTimeRange.start, 9), "HH:mm")
      endTimeEl.textContent = dateFns.format(dateFns.subHours(eventDayTimeRange.end, 9), "HH:mm")
      arg.jsEvent.preventDefault() // don't navigate in main tab
    },

    // loading: function(bool) {
    //   document.getElementById('loading').style.display =
    //     bool ? 'block' : 'none';
    // }
  });
  if(isMobile) {
    calendar.changeView('timeGridDay');
  }
  calendar.render()
});

// Make sure the client is loaded and sign-in is complete before calling this method.
function execute() {
  const roomName = document.getElementById('room-name').value
  const startDate = document.getElementById('start-date').value.replace(/年/g, '-').replace(/月/g, '-').replace(/日/g, '')
  const startTime = document.getElementById('start-time').value
  const startDateTime = startDate + 'T' + startTime + ':10+09:00'
  const endDate = document.getElementById('end-date').value.replace(/年/g, '-').replace(/月/g, '-').replace(/日/g, '')
  const endTime = document.getElementById('end-time').value
  const endDateTime = endDate + 'T' + endTime + ':10+09:00'

  jQuery('.reserve__modalErrorMessage').hide()

}

modal
window.onload = function() {
  const closeButton = document.getElementById('closeBtn');

  closeButton.addEventListener('click', function() {
    jQuery('.reserve__modalErrorMessage').hide()
    modal.style.display = 'none';
  })
}