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
    <title>Add Expense</title>

    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="headerNav">
                <a href="./index.php" class="headerNav-link">Home</a>
            </div>

            <h1 class="header-title">
                Add Expense
            </h1>
        </header>

        <div class="col-center">
            <div class="addExpense">

                <form action="<?php echo htmlspecialchars('./db-actions.php'); ?>" method="POST">
                    <label class="addExpense-inputLabel" for="value">Amount</label>
                    <input class="addExpense-input" type="number" name="value" id="value">

                    <label class="addExpense-inputLabel" for="category">Category</label>
                    <select class="addExpense-input" name="category" id="category">
                        <option value="rent">Rent</option>
                        <option value="groceries">Groceries</option>
                    </select>

                    <label class="addExpense-inputLabel" for="date">Date</label>
                    <input id="js-datePicker" class="addExpense-input" type="date" name="date" id="date">

                    <button class="addExpense-button" type="submit" name="add-expense">Submit</button>
                </form>
            </div>
        </div>

    </div> <!-- /container -->

    <footer>
        <p>Code by <a href="https://webbrouwer.com" target="_blank">WebBrouwer</a></p>
    </footer>
    <script src="./js/main.js"></script>
</body>
</html>