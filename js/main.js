// @TODO
// use month counter to display different months + their database data

// https://gomakethings.com/vanilla-js-event-delegation-with-a-lot-of-event-handlers-on-one-page/
var currentMonth = document.querySelector('#js-currentMonth');
var prevMonthButton = document.querySelector('#js-prevMonth');
var nextMonthButton = document.querySelector('#js-nextMonth');
var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
]
var date = new Date();
var monthIndex = date.getMonth();

currentMonth.innerHTML = monthNames[monthIndex];

function prevMonth() {
    date.setMonth(date.getMonth()-1);
    monthIndex = date.getMonth();
    currentMonth.innerHTML = monthNames[monthIndex];
}

function nextMonth() {
    date.setMonth(date.getMonth()+1);
    monthIndex = date.getMonth();
    currentMonth.innerHTML = monthNames[monthIndex];    
}

prevMonthButton.addEventListener('click', function (event) {
    prevMonth();
}, false);

nextMonthButton.addEventListener('click', function (event) {
    nextMonth();
}, false);