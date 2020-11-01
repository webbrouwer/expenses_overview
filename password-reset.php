<?php

include('./controllers/password_reset.php');

// session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses App • Password reset</title>

    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <div class="container">
        <header class="header">
            <h1>Expenses Overview • Password Reset</h1>
        </header>

        <div class="col-center">

            <div class="form">

                <form action="" method="post">

                    <?php echo $email_doesnt_exist; ?>
                    <?php echo $accountNotExistErr; ?>
                    <?php echo $emailPwdErr; ?>
                    <?php echo $verificationRequiredErr; ?>
                    <?php echo $email_empty_err; ?>

                    <label class="form-inputLabel" for="email">Email</label>
                    <input class="form-input" type="email" name="email" id="email" />

                    <button class="form-button" type="submit" name="password_reset">
                        Reset password
                    </button>
                </form>

            </div> <!-- /form -->

            <a href="./signup.php" class="alt-button">Or create account</a>

        </div> <!-- /col-center -->

    </div> <!-- /container -->

    <footer>
        <p>Code by <a href="https://webbrouwer.com" target="_blank">WebBrouwer</a></p>
    </footer>
    <script src="./js/main.js"></script>
</body>

</html>