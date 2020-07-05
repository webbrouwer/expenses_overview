# Set up

* Create a config/config.php file and insert code from below. Adjust to it your credentials.
* Run `npm install`.
* You are good to go. :+1:

```php
/**
 * Basic configuration
 *
 */
 $homeUrl      = "HOME_URL";

/**
 * Configuration for database connection
 *
 */
 $host      = "localhost";
 $username  = "USERNAME";
 $password  = "PASSWORD";
 $dbname    = "DB_NAME";
 $dsn       = "mysql:host=$host;dbname=$dbname";
 $options   = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
 ```

 ## TODO

 * Add userMonthIndex to localStorage / cookie.
 * Reload page on prev or next month.
 * Use userMonthIndex on page load to load data in all expenses and pie chart.