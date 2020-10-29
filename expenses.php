<?php
var_dump($_SESSION);

/**
 * Check if user is logged in
 */
include('./auth_session.php');

include('./db-actions.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Overview • Expenses App</title>

    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="headerNav">
                <a href="./add-expense.php" class="headerNav-link">Add expense</a>
                <a href="./logout.php" class="headerNav-link">logout</a>
            </div>

            <h1 class="header-title">
                Expenses - <span id="js-currentMonth"></span>
            </h1>
            <button id="js-prevMonth" class="header-buttonPrevMonth"><</button>
            <button id="js-nextMonth" class="header-buttonNextMonth">></button>

            <div class="expenseTotal">
                <p class="expenseTotal-text">
                    <span class="expenseTotal-text--strong">Total:</span> <span id="js-expenseTotal-value"></span>
                </p>
            </div>
        </header>

        <div class="col primary">

            <div class="allExpenses">

                <div id="expensesTable"></div>

            </div> <!-- allExpenses -->

        </div>

        <div class="col secundairy expenseChart">
            <h2 class="expenseChart-title">Expenses Pie Chart</h2>

            <div id="chartContainer">
                <canvas id="myChart"></canvas>
            </div>

        </div>

    </div> <!-- /container -->

    <footer>
        <p>Code by <a href="https://webbrouwer.com" target="_blank">WebBrouwer</a></p>
    </footer>
    <script src="./node_modules/chart.js/dist/Chart.js"></script>
    <script src="./node_modules/moment/min/moment.min.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>