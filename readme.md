# Set up

* Create a config/config.php file and insert code from below. Adjust to it your credentials.
* Visit local HOME_URL/config/install.php to install database
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
 $dbname    = "expenses_overview";
 $dsn       = "mysql:host=$host;dbname=$dbname";
 $options   = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

 ```

 ## TODO

- [x] fix month counting, include years.
- [x] Add accounts and login --> https://www.positronx.io/build-php-mysql-login-and-user-authentication-system/
- [ ] Make data personal with accounts
- [ ] Make dashboard only visible for logged in users
- [ ] Password reset
- [ ] Deploy to the world!
- [x] feedback for empty of faults in add expense form
- [x] make custom adding expense category possible
- [x] create delete function for expense
- [x] fix recursive adding when switching months
- [x] fix init file with clean DB structure :-)
- [x] display message if no data is present for selected month view
