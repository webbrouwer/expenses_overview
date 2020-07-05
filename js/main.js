// @TODO
// use month counter to display different months + their database data

// https://gomakethings.com/vanilla-js-event-delegation-with-a-lot-of-event-handlers-on-one-page/
var currentMonth = document.querySelector('#js-currentMonth');
var prevMonthButton = document.querySelector('#js-prevMonth');
var nextMonthButton = document.querySelector('#js-nextMonth');
var datePicker = document.querySelector('#js-datePicker');

var expenseTotalValue = document.querySelector('#js-expenseTotal-value');

var monthNames = ["", "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
]
var date = new Date();
var monthIndex = date.getMonth() + 1;


/**
 * Escape input
 */
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
if(currentMonth) {
    currentMonth.innerHTML = monthNames[monthIndex];
    currentMonth.setAttribute('data-month-index', monthIndex);
};

/**
 * Set the date of today in the datepicker
 */
if(datePicker) {
    datePicker.valueAsDate = date;
};


// @TODO: refactor monthIndex to make it year proof, maybe use setMonth() ??
/**
 * Change the month to the previous month
 */
function prevMonth() {
    monthIndex = monthIndex - 1;
    currentMonth.innerHTML = monthNames[monthIndex];
    prevMonthButton.setAttribute('data-month-index', monthIndex);
}

/**
 * Change the month to the next month
 */
function nextMonth() {
    monthIndex = monthIndex + 1;
    currentMonth.innerHTML = monthNames[monthIndex];
    nextMonthButton.setAttribute('data-month-index', monthIndex);
}


/**
 * Get the total amount spend for the month index
 */
function getMonthlyAmountSpend() {

     // Store values of checkbox
     var data = {
        monthIndex: escapeHtml(event.target.getAttribute('data-month-index')),
        data_action: 'totalAmount'
    };

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
        expenseTotalValue.innerHTML = data;
    });

}


/**
 * Initial load the montly total amount spend
 */
function firstLoad() {

    // Store values of checkbox
    var data = {
        monthIndex: escapeHtml(currentMonth.getAttribute('data-month-index')),
        data_action: 'totalAmount'
    };

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
        expenseTotalValue.innerHTML = data;
    });

}


/**
 * Event Linsteners
 */
prevMonthButton.addEventListener('click', function (event) {
    prevMonth();
    getMonthlyAmountSpend();
}, false);

nextMonthButton.addEventListener('click', function (event) {
    nextMonth();
    getMonthlyAmountSpend();
}, false);

window.addEventListener('load', function (event) {
    firstLoad();
}, false);