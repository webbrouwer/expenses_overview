//
// Variables
//

var currentMonth = document.querySelector('#js-currentMonth');
var prevMonthButton = document.querySelector('#js-prevMonth');
var nextMonthButton = document.querySelector('#js-nextMonth');
var datePicker = document.querySelector('#js-datePicker');

var expenseTotalValue = document.querySelector('#js-expenseTotal-value');

var expensesTable = document.querySelector('#expensesTable');

var monthNames = ["", "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

var date = new Date();
var monthIndex = date.getMonth() + 1;

// Background colors labels in Pie Chart
var backgroundColors = [
    'rgba(255, 99, 132)',
    'rgba(54, 162, 235)',
    'rgba(54, 162, 0)'
];


//
// Methods
//

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
};


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


/**
 * Change the month to the next month
 */
// @TODO: refactor monthIndex to make it year proof, maybe use setMonth() ??
function clickHandler() {

    if(!event.target.matches('#js-prevMonth, #js-nextMonth')) return;

    if(event.target.matches('#js-nextMonth')) {
        monthIndex = monthIndex + 1;
    } else if(event.target.matches('#js-prevMonth')) {
        monthIndex = monthIndex - 1;
    }

    currentMonth.innerHTML = monthNames[monthIndex];
    currentMonth.setAttribute('data-month-index', monthIndex);

    getMonthlyAmountSpend();
    renderExpensesTable();
    getExpenseForLabel();

};


/**
 * Get the total amount spend for the month index
 */
function getMonthlyAmountSpend() {

     var data = {
        monthIndex: escapeHtml(currentMonth.getAttribute('data-month-index')),
        data_action: 'totalAmount'
    };

    fetch("db-actions.php", {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
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

};


/**
 * Request expenses table and render
 * @return {html} html table with montly expenses per category
 */
function renderExpensesTable() {

    var data = {
        monthIndex: escapeHtml(currentMonth.getAttribute('data-month-index')),
        data_action: 'expensesTable'
    };

    fetch("db-actions.php", {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
    },
        body: JSON.stringify(data)
    }).then(function (response) {
        // check if response is OK, if not error is displayed in .catch
        if (response.ok) {
            // ReadableStream to text
            return response.text();
        }
        return Promise.reject(response);
    }).then(function(data) {
        expensesTable.innerHTML = data;
    });

};


/**
 * Clear and reset the charts canvas
 */
function resetChartCanvas() {
    // Get chart container and reset it, bugfix for showing previous chart on hover
    document.querySelector('#chartContainer').innerHTML = '';
    document.querySelector('#chartContainer').innerHTML = '<canvas id="myChart"></canvas>';
};


/**
 * Create and render the Pie Chart
 * @param  {array} expensesAndLabels the labels and corresponding expenses
 * @return {Pie chart}               Returns the Pie chart
 */
function renderPieChart(expensesAndLabels) {
    // Init and reset labels for first load and selected months
    var labels = [];
    var expenses = [];

    // Push data values to labels and expenses
    expensesAndLabels.forEach(function (expense, index) {
        labels.push(expensesAndLabels[index].category)
        expenses.push(expensesAndLabels[index].totalAmount);
    });

    // Build chart and add options and data
    var ctx = document.querySelector("#myChart").getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'pie',

        // The data for our dataset
        data: {
            labels: labels,
            datasets: [{
                data: expenses,
                backgroundColor: backgroundColors
            }]
        },

    });
};


/**
 * Fetch the expenses for the labels from the database via PHP
 */
function getExpenseForLabel() {

    var data = {
        monthIndex: escapeHtml(currentMonth.getAttribute('data-month-index')),
        data_action: 'getExpenseForLabel'
    };

    fetch("db-actions.php", {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
    },
        body: JSON.stringify(data)
    }).then(function (response) {
        if (response.ok) {
            // ReadableStream to JSON
            return response.json();
        }
        return Promise.reject(response);
    }).then(function(expensesAndLabels) {
        resetChartCanvas();
        renderPieChart(expensesAndLabels);
    });

};


//
// Event listeners
//

document.addEventListener('click', clickHandler, false);

window.addEventListener('load', function (event) {
    getMonthlyAmountSpend();
    renderExpensesTable();
    getExpenseForLabel();
}, false);
