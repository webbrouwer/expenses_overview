//
// Variables
//

var currentMonth = document.querySelector('#js-currentMonth');
var prevMonthButton = document.querySelector('#js-prevMonth');
var nextMonthButton = document.querySelector('#js-nextMonth');
var datePicker = document.querySelector('#js-datePicker');

var expenseTotalValue = document.querySelector('#js-expenseTotal-value');

var expensesTable = document.querySelector('#expensesTable');

var date = moment().format('YYYY-MM-DD');
// var monthIndex = date.getMonth() + 1;

// Background colors labels in Pie Chart
var backgroundColors = [
    'rgba(255, 99, 132)',
    'rgba(54, 162, 235)',
    'rgba(54, 162, 0)',
    'rgba(54, 40, 100)',
    'rgba(0, 67, 122)',
    'rgba(182, 10, 200)',
    'rgba(12, 200, 176)',
    'rgba(201, 28, 10)',
    'rgba(181, 69, 14)',
    'rgba(100, 200, 114)'
];

var expenseChartTitle = document.querySelector('.expenseChart-title');

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
    currentMonth.innerHTML = moment(date).format('MMM YYYY');
};


/**
 * Set the date of today in the datepicker
 */
if(datePicker) {
    today = new Date();
    datePicker.valueAsDate = today;
};


/**
 * Change the month to the next month
 */
function clickHandler() {

    if(!event.target.matches('#js-prevMonth, #js-nextMonth')) return;

    if(event.target.matches('#js-nextMonth')) {
        console.log('1: ' + date);
        date = moment(date).add(1, 'M').format('YYYY-MM-DD');
        console.log('2: ' + date);
    } else if(event.target.matches('#js-prevMonth')) {
        date = moment(date).subtract(1, 'M').format('YYYY-MM-DD');
    }

    currentMonth.innerHTML = moment(date).format('MMM YYYY');

    getMonthlyAmountSpend();
    renderExpensesTable();
    getExpenseForLabel();

};

/**
 * Get the total amount spend for the month index
 */
function getMonthlyAmountSpend() {

    dateMonth = moment(date).format('M');
    dateYear = moment(date).format('YYYY');

    var data = {
        date_month: dateMonth,
        date_year: dateYear,
        data_action: 'totalAmount'
    };

    fetch("db-actions.php", {
        method: "POST",
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
            'Content-Type': 'application/json',
            // 'Accept': 'application/json'
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
        if(data) {
            expenseTotalValue.innerHTML = '€' + data + ',-';
        } else {
            expenseTotalValue.innerHTML = 'No data available, <a href="./add-expense.php">add expense</a>.';
        }
    });

};


/**
 * Request expenses table and render
 * @return {html} html table with montly expenses per category
 */
function renderExpensesTable() {

    dateMonth = moment(date).format('M');
    dateYear = moment(date).format('YYYY');

    var data = {
        date_month: dateMonth,
        date_year: dateYear,
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

    // Init and reset labels for first load and selected month
    var labels = [];
    var expenses = [];

    // Push expensesAndLabels values to labels and expenses for Pie Chart data
    expensesAndLabels.forEach(function (expense, index) {
        labels.push(expensesAndLabels[index].category)
        expenses.push(expensesAndLabels[index].totalAmount);
    });

    // Build chart with label and expenses values
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

    if(typeof expensesAndLabels !== 'undefined' && expensesAndLabels.length > 0) {
        expenseChartTitle.classList.add('display');
        expenseChartTitle.classList.remove('hidden');
    } else {
        expenseChartTitle.classList.remove('display');
        expenseChartTitle.classList.add('hidden');
    }

};


/**
 * Fetch the expenses for the labels from the database via PHP
 */
function getExpenseForLabel() {

    dateMonth = moment(date).format('M');
    dateYear = moment(date).format('YYYY');

    var data = {
        date_month: dateMonth,
        date_year: dateYear,
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
        body: JSON.stringify(data),
    }).then(function (response) {
        if (response.ok) {
            // ReadableStream to JSON
            return response.json();
        }
        return Promise.reject(response);
    }).then(function(expensesAndLabels) {
        resetChartCanvas();
        if(expensesAndLabels)
            renderPieChart(expensesAndLabels);
    });

};


//
// Inits & Event listeners
//

document.addEventListener('click', clickHandler, false);

window.addEventListener('load', function (event) {
    getMonthlyAmountSpend();
    renderExpensesTable();
    getExpenseForLabel();
}, false);
