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
            <p>Expenses Overview helps you keep track of your money expenses with monthly views and statistics.</p>
        </header>

        <div class="col-center">

            <div class="form">

                <form action="" method="post">
                    <label class="form-inputLabel" for="name">Email</label>
                    <input class="form-input" type="text" name="name" id="name" required />

                    <label class="form-inputLabel" for="email">Password</label>
                    <input class="form-input" type="email" name="email" id="email" required />

                    <button class="form-button" type="submit" name="submit" id="submit">
                        Login
                    </button>

                    <p class="form-forgottenPassword center">
                        <em><a href="#">Forgotten password?</a></em>
                    </p>
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