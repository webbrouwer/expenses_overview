<?php
// Silky smooth functions
include "./db-actions.php";
include "./functions.php";

$month = getMonthIndex();

setlocale(LC_TIME, 'NL_nl');

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Overview</title>

    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <span>Vorige maand</span>
            <h1 class="header-title">Uitgaven Overzicht - <?php echo ucfirst(strftime('%B %Y',time())); ?></h1>
            <span>Volgende maand</span>
        </header>

        <div>
            <div class="col primary">
                <div class="addExpense">
                    
                    <form action="<?php echo htmlspecialchars('./db-actions.php'); ?>" method="POST">
                        <label class="addExpense-inputLabel" for="value">Toevoegen</label>
                        <input type="number" name="value" id="value">

                        <label class="addExpense-inputLabel" for="category">Categorie</label>
                        <select name="category" id="category">
                            <option value="huur">Huur</option>
                            <option value="boodschappen">boodschappen</option>  
                        </select>

                        <label class="addExpense-inputLabel" for="date">Datum</label>
                        <input type="date" name="date" id="date">

                        <button class="addExpense-button" type="submit">Toevoegen</button>
                    </form>
                </div>
                
                <div class="allExpenses">
                <?php $expenses = allExpenses(); ?>
                    <h2>Totaal overzicht</h2>

                    <div class="expenseTotal">
                        <p class="expenseTotal-text">
                            <span class="expenseTotal-text--strong">Totaal:</span> €<?php echo totalAmount(); ?>,-
                        </p>
                    </div>    

                    <table class="expensesTable">
                        <thead>
                            <td>Bedrag</td>
                            <td>Categorie</td>
                        </thead>
                        <?php foreach ($expenses as $name) { ?>
                        <tr>
                            <td><?php echo '€' . $name['value'];  ?></td>
                            <td><?php echo $name['category']; ?></td>                            
                        </tr>
                       <?php  } ?>                       
                    </table>
                </div>
            </div>

            <div class="col secundairy expenseChart">

                <canvas id="myChart"></canvas>

            </div>

        </div>

        <?php $result = totalSpendCategoryMonth('huur', $month); ?>
        <?php echo '<pre>'; ?>
        <?php var_dump($result); ?>
        
    </div>
    <script src="./node_modules/chart.js/dist/Chart.js"></script>
    <script>
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