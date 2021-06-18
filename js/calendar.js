'use strict'

// google API
const API_KEY = 'AIzaSyCBjIrdvQ2toNlWzSJucw8XAbtxTZ9ozy8'
const CALENDAR_ID = 'hi6bh5lssb6bf2ivm7rijje4vo@group.calendar.google.com';
const CLIENT_ID = '699883132340-2fok136jd46cm3f31uq33gkvgiqs5nlf.apps.googleusercontent.com'
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
      let event = arg.event._def
      let eventDayTimeRange = arg.event._instance.range
      let titleEl = document.getElementById('eventTitle')
      let dayEl = document.getElementById('eventDay')
      let startTimeEl = document.getElementById('eventStartTime')
      let endTimeEl = document.getElementById('eventEndTime')

      let detailEl = null
      detailEl = document.getElementById('eventDetail')
      detailEl.style.display = 'block'

      let urlEl = null
      urlEl = document.getElementById('eventUrl')
      urlEl.style.display = 'inline-block'

      modal.style.display = 'block'
      titleEl.textContent = event.title
      dayEl.textContent = dateFns.format(dateFns.subHours(eventDayTimeRange.start, 9), "YYYY/MM/DD")
      startTimeEl.textContent = dateFns.format(dateFns.subHours(eventDayTimeRange.start, 9), "HH:mm")
      endTimeEl.textContent = dateFns.format(dateFns.subHours(eventDayTimeRange.end, 9), "HH:mm")
      if(event.extendedProps.description) {
        detailEl.innerHTML = event.extendedProps.description
      } else {
        detailEl.style.display = 'none'
      }
      if(event.extendedProps.location) {
        urlEl.textContent = event.extendedProps.location
        urlEl.href = event.extendedProps.location
      } else {
        urlEl.style.display = 'none'
      }
      arg.jsEvent.preventDefault() // don't navigate in main tab
    },

    // loading: function(bool) {
    //   document.getElementById('loading').style.display =
    //     bool ? 'block' : 'none';
    // }
  });
  // if(isMobile) {
  //   calendar.changeView('timeGridDay');
  // }
  calendar.render()
});

window.onload = function() {
  const closeButton = document.getElementById('closeBtn');

  closeButton.addEventListener('click', function() {
    jQuery('.reserve__modalErrorMessage').hide()
    modal.style.display = 'none';
  })
}