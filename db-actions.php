<?php

require './config/config.php';

/**
 * Add to DB
 */
if (isset($_REQUEST['add-expense'])) {
    // Collect variables form form
    $value = htmlspecialchars($_POST['value'], ENT_QUOTES, 'utf-8');
    $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'utf-8');
    $date = htmlspecialchars($_POST['date'], ENT_QUOTES, 'utf-8');
    $user_id = htmlspecialchars($_SESSION['id'], ENT_QUOTES, 'utf-8');

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);

    try {
        $data = [
            'value' => $value,
            'category' => $category,
            'date' => $date,
            'user_id' => $user_id
        ];

        $sql = "INSERT INTO expenses (value, category, user_id, date) VALUES (:value, :category, :user_id, :date)";

        $statement = $connection->prepare($sql);
        $statement->execute($data);
    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    header('location: ' . $dashboard);
};


/**
 * totalAmount description
 * @param  [type] $month [description]
 * @return [type]        [description]
 */
function totalAmount($month, $year) {
    include './config/config.php';

    $user_id = htmlspecialchars($_SESSION['id'], ENT_QUOTES, 'utf-8');

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);

    try {
        $data = [
            'month' => $month,
            'year' => $year,
            'user_id' => $user_id
        ];

        $sql = "SELECT value FROM expenses
                WHERE YEAR(Date) = :year
                AND MONTH(Date) = :month
                AND user_id = :user_id";

        $statement = $connection->prepare($sql);
        $statement->execute($data);

        $allSpendings = $statement->fetchAll(PDO::FETCH_COLUMN);

        $totalAmount = array_sum($allSpendings);

        header('Content-Type: application/json');
        echo json_encode($totalAmount);

    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
};


/**
*
* All expenses
*
*/
function allExpenses($month, $year) {
    include './config/config.php';

    $user_id = htmlspecialchars($_SESSION['id'], ENT_QUOTES, 'utf-8');

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);

    try {
        $data = [
            'month' => $month,
            'year' => $year,
            'user_id' => $user_id
        ];

        $sql = "SELECT * FROM expenses
                WHERE YEAR(Date) = :year
                AND MONTH(Date) = :month
                AND user_id = :user_id";

        $statement = $connection->prepare($sql);
        $statement->execute($data);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

};


/**
 * Render retrieve and render expenses table
 * @return html the html for the expenses table
 */
function expensesTable($month, $year) {
    $expenses = allExpenses($month, $year);

    if($expenses)

    echo '<h2>All Expenses</h2>
            <table class="expensesTable">
            <thead>
                <td>Amount</td>
                <td>Category</td>
                <td></td>
            </thead>';
    foreach ($expenses as $expense) {
        echo '<tr>';
        echo  '<td>€' . $expense["value"] . '</td>';
        echo  '<td class="expensesTable-expensesTableCategory">' . $expense["category"] . '</td>';
        echo  '<td>
                <form method="POST">
                    <input type="hidden" name="expenseId" value="' . $expense["id"] . '">
                    <button type="submit" name="deleteExpense">X</button>
                </form>
               </td>';
        echo '</tr>';
    }
    echo '</table>';

};


/**
 * deleteExpense
 */
function deleteExpense($id) {
    include './config/config.php';

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);

    try {
        $data = [
            'id' => $id
        ];

        $sql = "DELETE FROM expenses
                WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->execute($data);

    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    header('location: ' . $dashboard);

};


/*
 * If the delete buttons is clicked init delete function
 */
if(isset($_POST['deleteExpense'])) {

    // Collect the id from the expenses that is deleted
    $id = htmlspecialchars($_POST['expenseId'], ENT_QUOTES, 'utf-8');

    // Delete expense
    deleteExpense($id);

};


/**
 * Get expense per label
 */
function getExpenseForLabel($month, $year) {

    include './config/config.php';

    $user_id = htmlspecialchars($_SESSION['id'], ENT_QUOTES, 'utf-8');

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);

    try {
        $data = [
            'month' => $month,
            'year' => $year,
            'user_id' => $user_id
        ];

         $sql = "SELECT category, SUM(value) totalAmount
                FROM expenses
                WHERE MONTH(Date) = :month
                AND YEAR(Date) = :year
                AND user_id = :user_id
                GROUP BY category";

        $statement = $connection->prepare($sql);
        $statement->execute($data);

        $expenseForLabel = $statement->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($expenseForLabel);

    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

};


/**
 * Receive clicked data from JS AJAX
 */
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {
    //Receive the RAW post data.
    $content = trim(file_get_contents("php://input"));
    // var_dump($content);
    $decoded = json_decode($content, true);
    // var_dump($decoded);

    // If json_decode failed, the JSON is invalid.
    if(is_array($decoded)) {
        $action = $decoded['data_action'];
    switch($action) {
        case 'totalAmount':
            totalAmount(intval($decoded['date_month']), intval($decoded['date_year']));
            break;
        case 'expensesTable':
            expensesTable(intval($decoded['date_month']), intval($decoded['date_year']));
            break;
        case 'getExpenseForLabel':
            getExpenseForLabel(intval($decoded['date_month']), intval($decoded['date_year']));
            break;
        }
    } else {
            // Send error back to user.
            echo 'JSON invalid';
    }
};
