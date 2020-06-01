# Set up

* Create a config/config.php file and insert below code. Adjust to your credentials
* Run `npm install`
* You are good to go

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
 $host      = "localgo";
 $username  = "root";
 $password  = "root";
 $dbname    = "DB_NAME";
 $dsn       = "mysql:host=$host;dbname=$dbname";
 $options   = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); 
 ```