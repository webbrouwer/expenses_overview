# Set up

* Create a config/config.php file and insert code from below. Adjust to it your credentials.
* Run `npm install`.
* You are good to go. :+1:

```php
<?php
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

- [ ] fix init file with clean DB structure :-)
- [ ] make table names in db-actions variables
- [x] fix recursive adding when switching months
- [ ] make custom adding expense category possible
- [ ] create delete function for expense
- [ ] fix month counting, include years.
- [ ] feedback for empty of faults in add expense form
- [x] display message if no data is present for selected month view
