// @TODO
// use month counter to display different months + their database data

// https://gomakethings.com/vanilla-js-event-delegation-with-a-lot-of-event-handlers-on-one-page/
var currentMonth = document.querySelector('#js-currentMonth');
var prevMonthButton = document.querySelector('#js-prevMonth');
var nextMonthButton = document.querySelector('#js-nextMonth');
var datePicker = document.querySelector('#js-datePicker');

var expenseTotalValue = document.querySelector('#js-expenseTotal-value');

var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
]
var date = new Date();
var monthIndex = date.getMonth();


// Escape input
function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
}


/**
 * Display the current month on the page 
 */
currentMonth.innerHTML = monthNames[monthIndex];

/**
 * Set the date of today in the datepicker
 */
datePicker.valueAsDate = date;


/**
 * Change the month to the previous month
 */
function prevMonth() {
    date.setMonth(date.getMonth()-1);
    monthIndex = date.getMonth();
    currentMonth.innerHTML = monthNames[monthIndex];
    prevMonthButton.setAttribute('data-month-index', monthIndex);    
}

/**
 * Change the month to the next month
 */
function nextMonth() {
    date.setMonth(date.getMonth()+1);
    monthIndex = date.getMonth();
    currentMonth.innerHTML = monthNames[monthIndex];
    nextMonthButton.setAttribute('data-month-index', monthIndex);    
}


/**
 * Event Linsteners
 */
prevMonthButton.addEventListener('click', function (event) {
    prevMonth();
    handlePrevMonth();
}, false);

nextMonthButton.addEventListener('click', function (event) {
    nextMonth();
}, false);



function handlePrevMonth() {

    // Store values of checkbox
    var data = {
        monthIndex: escapeHtml(event.target.getAttribute('data-month-index')),    
        data_action: 'totalAmount'
    };

    // TODO: Refactor POST to GET to rerieve total amount spend fot monthIndex
    fetch("db-actions.php", {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
    },
        body: JSON.stringify(data)
    }).then(function (response) {
        // check if response is OK, if not error is displayed in .catch
        if (response.ok) {
            // ReadableStream to JSON
            return response.json();
        } else {
            return Promise.reject(response);
        }
    }).then(function(data) {
        console.log(data);
    }).then(res => {
        console.log("Request complete! response:", res);
    }); 

};