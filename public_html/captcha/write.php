<html>
    <head>
        <title>HTML form with captcha PHP(5)</title>
    </head>
    <body>
        <form method = "POST" action = "/captcha/captcha_checking.php">
            <input class = "input" type="text" name = "norobot" />
            <img src = "/captcha/captcha.php" />
            <input type = "submit" value = "Submit" />
        </form>
</body>
</html>
    