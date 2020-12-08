<?php include('./controllers/user_activation.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses App • Log in or sign up</title>

    <link rel="icon" type="image/png" href="/favicon.ico"/>

    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <div class="container">
        <header class="header">
            <h1>Expenses Overview</h1>
            <p>Expenses Overview helps you keep track of your money expenses with monthly views and statistics.</p>
        </header>

        <div class="col-center">

            <h3 class="center">Email Verification</h3>
            <div class="center">
                <?php echo $email_already_verified; ?>
                <?php echo $email_verified; ?>
                <?php echo $activation_error; ?>
            </div>
            <br>
            <a class="alt-button" href="./index.php"
               >Click to Login
            </a>

        </div> <!-- /col-center -->

    </div> <!-- /container -->

    <footer>
        <p>Code by <a href="https://webbrouwer.com" target="_blank">WebBrouwer</a></p>
    </footer>
    <script src="./js/main.js"></script>

</body>

</html>