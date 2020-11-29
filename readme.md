# Set up

* Create a config/config.php file and insert code from below. Adjust it to your credentials.
* Visit local HOME_URL/config/install.php to install database
* Run `npm install`.
* Run `composer install`.
* You are good to go. :+1:

* Push to production: `git push production master`

```php
<?php

// Enable us to use Headers
ob_start();

// Set sessions
if(!isset($_SESSION)) {
session_start();
}

/**
 * Basic configuration
 *
 */
 $homeUrl   = "http://localhost/~webbrouwer/expenses_overview";
 $dashboard   = "http://localhost/~webbrouwer/expenses_overview/expenses.php";

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

 $connection = mysqli_connect($host, $username, $password, $dbname) or die("Database connection not established.");


/**
 * Mail login
 *
 */
 $gmailUsername = 'USERNAME';
 $gmailAppPassword = 'APP-PASSWORD';

 ```

 ## TODO

- [ ] Add SSL on server
- [ ] Add deploy cycle from local to server!
- [ ] Add password reset function
- [ ] Add branded activation mail
- [ ] Deploy to the world!
- [x] fix month counting, include years.
- [x] Add accounts and login --> https://www.positronx.io/build-php-mysql-login-and-user-authentication-system/
- [x] Make data personal with accounts
- [x] Make dashboard only visible for logged in users
- [x] feedback for empty of faults in add expense form
- [x] make custom adding expense category possible
- [x] create delete function for expense
- [x] fix recursive adding when switching months
- [x] fix init file with clean DB structure :-)
- [x] display message if no data is present for selected month view
