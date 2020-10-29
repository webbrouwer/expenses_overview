<?php
/**
 * Check if user is logged in
 */
// include("auth_session.php");

// Silky smooth functions
include('./db-actions.php');

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense • Expenses App</title>

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
            <div class="form">

                <form action="<?php echo htmlspecialchars('./db-actions.php'); ?>" method="POST">
                    <label class="form-inputLabel" for="value">Amount</label>
                    <input class="form-input" type="number" name="value" id="value" required>

                    <label class="form-inputLabel">Category</label>
                    <input class="form-input" type="text" name="category" list="category" placeholder="Select or add category" required />
                    <datalist id="category">
                            <option>Rent</option>
                            <option>Savings</option>
                            <option>Phone bill</option>
                            <option>Insurance</option>
                            <option>Eating outdoor</option>
                            <option>Lunch</option>
                            <option>Groceries</option>
                            <option>Coffee</option>
                            <option>Fun, going out</option>
                            <option>Other</option>
                    </datalist>

                    <label class="form-inputLabel" for="date">Date</label>
                    <input id="js-datePicker" class="form-input" type="date" name="date" id="date" required>

                    <button class="form-button" type="submit" name="add-expense">Submit</button>
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