<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up • Expenses Overview</title>

    <link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <div class="container">
        <header class="header">
            <h1 class="header-title">
                Sign Up • Expenses Overview
            </h1>
            <p>It's Quick and Easy</p>
        </header>

        <div class="col-center">
            <div class="form">

                <form action="" method="post">
                    <label class="form-inputLabel" for="name">Name</label>
                    <input class="form-input" type="text" name="name" id="name" required />

                    <label class="form-inputLabel" for="email">Email</label>
                    <input class="form-input" type="email" name="email" id="email" required />

                    <label class="form-inputLabel" for="password">Password</label>
                    <input class="form-input" type="password" name="password" id="password" required />

                    <button class="form-button" type="submit" name="submit" id="submit">
                        Sign up
                    </button>
                </form>

            </div><!-- /form -->
        </div><!-- /col-center -->

    </div> <!-- /container -->

    <footer>
        <p>Code by <a href="https://webbrouwer.com" target="_blank">WebBrouwer</a></p>
    </footer>
    <script src="./js/main.js"></script>

</body>

</html>