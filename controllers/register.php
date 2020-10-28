<?php

    // Database connection
    include('config/config.php');

    // Swiftmailer lib
    require_once './vendor/autoload.php';

    // Error & success messages
    global $success_msg, $email_exist, $_nameErr, $_emailErr, $_passwordErr;
    global $nameEmptyErr, $emailEmptyErr, $passwordEmptyErr, $email_verify_err, $email_verify_success;

    // Set empty form vars for validation mapping
    $_name = $_email = $_password = "";

    if(isset($_POST["submit"])) {
        $name          = $_POST["name"];
        $email         = $_POST["email"];
        $password      = $_POST["password"];

        // check if email already exist
        $email_check_query = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$email}' ");
        $rowCount = mysqli_num_rows($email_check_query);

        // PHP validation
        // Verify if form values are not empty
        if(!empty($name) &&  !empty($email) && !empty($password)){

            // check if user email already exist
            if($rowCount > 0) {
                $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with email already exist!
                    </div>
                ';
            } else {
                // clean the form data before sending to database
                $_name = mysqli_real_escape_string($connection, $name);
                $_email = mysqli_real_escape_string($connection, $email);
                $_password = mysqli_real_escape_string($connection, $password);

                // perform validation
                if(!preg_match("/^[a-zA-Z ]*$/", $_name)) {
                    $_nameErr = '<div class="alert alert-danger">
                            Only letters and white space allowed.
                        </div>';
                }
                if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="alert alert-danger">
                            Email format is invalid.
                        </div>';
                }
                if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $_password)) {
                    $_passwordErr = '<div class="alert alert-danger">
                             Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                        </div>';
                }

                // Store the data in db, if all the preg_match condition met
                if(
                    (preg_match("/^[a-zA-Z ]*$/", $_name)) &&
                    (filter_var($_email, FILTER_VALIDATE_EMAIL)) &&
                    (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $_password))){

                    // Generate random activation token
                    $token = md5(rand().time());

                    // Password hash
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);

                    // Query
                    $sql = "INSERT INTO users (name, email, password, token, is_active,
                    date_time) VALUES ('{$name}', '{$email}', '{$password_hash}',
                    '{$token}', '0', now())";

                    // Create mysql query
                    $sqlQuery = mysqli_query($connection, $sql);

                    if(!$sqlQuery){
                        die("MySQL query failed!" . mysqli_error($connection));
                    }

                    // Send verification email
                    if($sqlQuery) {
                        $msg = 'Click on the activation link to verify your email. <br><br>
                          <a href="http://localhost/~webbrouwer/expenses_overview/user_verificaiton.php?token='.$token.'"> Click here to verify email</a>
                        ';

                        // Create the Transport
                        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                        ->setUsername('mickeybrouwer')
                        ->setPassword('khntvravqyxaurag');

                        // Create the Mailer using your created Transport
                        $mailer = new Swift_Mailer($transport);

                        // Create a message
                        $message = (new Swift_Message('Please Verify Email Address!'))
                        ->setFrom([$email => $name . ' ' . $lastname])
                        ->setTo($email)
                        ->addPart($msg, "text/html")
                        ->setBody('Hello! User');

                        // Send the message
                        $result = $mailer->send($message);

                        if(!$result){
                            $email_verify_err = '<div class="alert alert-danger">
                                Verification email coud not be sent!
                            </div>';
                        } else {
                            $email_verify_success = '<div class="alert alert-success">
                                Verification email has been sent!
                            </div>';
                        }
                    }
                }
            }
        } else {
            if(empty($name)){
                $nameEmptyErr = '<div class="alert alert-danger">
                    Name can not be blank.
                </div>';
            }
            if(empty($email)){
                $emailEmptyErr = '<div class="alert alert-danger">
                    Email can not be blank.
                </div>';
            }
            if(empty($password)){
                $passwordEmptyErr = '<div class="alert alert-danger">
                    Password can not be blank.
                </div>';
            }
        }
    }
