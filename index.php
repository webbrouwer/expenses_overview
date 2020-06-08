<?php
// Silky smooth functions
include "./db-actions.php";
include "./functions.php";

$month = getMonthIndex();

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Overview</title>

    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css"> 
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <button id="js-prevMonth" class="header-buttonPrevMonth"><</button>
            <h1 class="header-title">
                Expenses - <span id="js-currentMonth"></span>
            </h1>
            <button id="js-nextMonth" class="header-buttonNextMonth">></button>

            <div class="expenseTotal">
                <p class="expenseTotal-text">
                    <span class="expenseTotal-text--strong">Monthly total:</span> €<span id="js-expenseTotal-value"><?php echo totalAmount($month); ?></span>,-
                </p>
            </div>
        </header>

        <div class="col primary">
            <div class="addExpense">
                
                <form action="<?php echo htmlspecialchars('./db-actions.php'); ?>" method="POST">
                    <label class="addExpense-inputLabel" for="value">Expenses</label>
                    <input class="addExpense-input" type="number" name="value" id="value">

                    <label class="addExpense-inputLabel" for="category">Category</label>
                    <select class="addExpense-input" name="category" id="category">
                        <option value="huur">Rent</option>
                        <option value="boodschappen">Groceries</option>  
                    </select>

                    <label class="addExpense-inputLabel" for="date">Date</label>
                    <input id="js-datePicker" class="addExpense-input" type="date" name="date" id="date">

                    <button class="addExpense-button" type="submit" name="add-expense">Submit</button>
                </form>
            </div>
            
            <div class="allExpenses">
            <?php $expenses = allExpenses($month); ?>
                <h2>Expenses Table</h2>

                <table class="expensesTable">
                    <thead>
                        <td>Amount</td>
                        <td>Category</td>
                    </thead>
                    <?php foreach ($expenses as $name) { ?>
                    <tr>
                        <td><?php echo '€' . $name['value'];  ?></td>
                        <td class="expensesTable-expensesTableCategory"><?php echo $name['category']; ?></td>                            
                    </tr>
                    <?php  } ?>                       
                </table>
            </div> <!-- allExpenses -->

        </div>

        <div class="col secundairy expenseChart">

            <h2 class="expenseChart-title">Expenses Pie</h2>

            <canvas id="myChart"></canvas>

        </div>    
        
    </div> <!-- /container -->    

    <footer>
        <p>Code by <a href="https://webbrouwer.com" target="_blank">WebBrouwer</a></p>
    </footer>           
    <script src="./node_modules/chart.js/dist/Chart.js"></script>
    <script src="./js/main.js"></script>
    <script>

    <?php $result = totalSpendCategoryMonth('huur', $month); ?>        
    /**
    *
    * Pie chart from chart.js
    *
    */
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'pie',

        // The data for our dataset
        data: {
            labels: [
                'Huur',
                'Boodschappen'
            ],                
            datasets: [{
                data: [<?php echo 10; ?>, 20],
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(54, 162, 235)'
                ] 
            }] 
        },

        // Configuration options go here
        options: {}
    });    
    </script>                            
</body>
</html>