<?php

include('./controllers/login.php');

session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses App • Log in or sign up</title>

    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <div class="container">
        <header class="header">
            <h1>Expenses Overview</h1>
            <h2>Is this reaching live??</h2>
            <p>Expenses Overview helps you keep track of your money expenses with monthly views and statistics.</p>
        </header>

        <div class="col-center">

            <div class="form">

                <form action="" method="post">

                    <?php echo $accountNotExistErr; ?>
                    <?php echo $emailPwdErr; ?>
                    <?php echo $verificationRequiredErr; ?>
                    <?php echo $email_empty_err; ?>
                    <?php echo $pass_empty_err; ?>

                    <label class="form-inputLabel" for="email">Email</label>
                    <input class="form-input" type="email" name="email_signin" id="email_signin" />

                    <label class="form-inputLabel" for="password">Password</label>
                    <input class="form-input" type="password" name="password_signin" id="password_signin" />

                    <button class="form-button" type="submit" name="login" id="sign_in">
                        Login
                    </button>

                    <!-- @TODO: add password reset function -->
<!--                     <p class="form-forgottenPassword center">
                        <em><a href="./password-reset.php">Forgotten password?</a></em>
                    </p> -->
                </form>

            </div> <!-- /form -->

            <a href="./signup.php" class="alt-button">Create new account</a>

        </div> <!-- /col-center -->

    </div> <!-- /container -->

    <footer>
        <p>Code by <a href="https://webbrouwer.com" target="_blank">WebBrouwer</a></p>
    </footer>
    <script src="./js/main.js"></script>
</body>

</html>