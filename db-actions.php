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

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);

    try {
        $data = [
            'value' => $value,
            'category' => $category,
            'date' => $date
        ];

        $sql = "INSERT INTO expenses (value, category, date) VALUES (:value, :category, :date)";

        $statement = $connection->prepare($sql);
        $statement->execute($data);
    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    header('location: ' . $homeUrl);
}


/**
 * totalAmount description
 * @param  [type] $month [description]
 * @return [type]        [description]
 */
function totalAmount($month) {
    include './config/config.php';

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);

    try {
        $data = [
            'month' => $month
        ];

        $sql = "SELECT value FROM expenses
                WHERE MONTH(date) = :month";

        $statement = $connection->prepare($sql);
        $statement->execute($data);

        $allSpendings = $statement->fetchAll(PDO::FETCH_COLUMN);

        $totalAmout = array_sum($allSpendings);

        header('Content-Type: application/json');
        echo json_encode($totalAmout);

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
function allExpenses($month) {
    include './config/config.php';

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);

    try {
        $data = [
            'month' => $month
        ];

        $sql = "SELECT * FROM expenses
                WHERE MONTH(date) = :month";

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
function expensesTable($month) {
    $expenses = allExpenses($month);

    echo '<table class="expensesTable">
            <thead>
                <td>Amount</td>
                <td>Category</td>
            </thead>';
    foreach ($expenses as $expense) {
        echo '<tr>';
        echo  '<td>€' . $expense["value"] . '</td>';
        echo  '<td class="expensesTable-expensesTableCategory">' . $expense["category"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';

};

function getAllLabels($month) {

    include './config/config.php';

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);

    try {
        $data = [
            'month' => $month
        ];

        $sql = "SELECT category FROM expenses
                WHERE MONTH(date) = :month";

        $statement = $connection->prepare($sql);
        $statement->execute($data);

        return $statement->fetchAll(PDO::FETCH_COLUMN);
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
            totalAmount(intval($decoded['monthIndex']));
            break;
        case 'expensesTable':
            expensesTable(intval($decoded['monthIndex']));
            break;
        }
    } else {
            // Send error back to user.
            echo 'JSON invalid';
    }
};
