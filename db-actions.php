<?php 

require './config/config.php';

/**
*
* Add to DB
*
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
*
* Total amount spend in month
*
*/
function totalAmount() {
    include './config/config.php';

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);  

    try {
        $sql = "SELECT value FROM expenses";

        $statement = $connection->prepare($sql);
        $statement->execute();

        $allSpendings = $statement->fetchAll(PDO::FETCH_COLUMN);

        return array_sum($allSpendings);
    }   
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }    
}

/**
*
* Total amount spend in month
*
*/
function allExpenses() {
    include './config/config.php';

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);  

    try {
        $sql = "SELECT * FROM expenses";

        $statement = $connection->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }   
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }    
}


/**
*
* Total amount spend for category in specific month
*
*/
function totalSpendCategoryMonth($category, $month) {
    
    include './config/config.php';

    // Connection
    $connection = new PDO($dsn, $username, $password, $options);  

    try {
        $data = [
            'category' => $category,
            'month' => $month
        ];

        $sql = "SELECT value 
                FROM expenses 
                WHERE category=:category 
                AND MONTH(date) = :month";
    
        $statement = $connection->prepare($sql);
        $statement->execute($data);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }   
    
    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }    
}


