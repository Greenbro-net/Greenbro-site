<html>
    <head>
        <title>HTML form with captcha PHP(5)</title>
    </head>
    <body>
        <form method="POST" action="<?php echo $url; ?>://greenbro<?php echo ".$domen_part"; ?>/admin/captcha_checking">
            <input class="input" type="text" name="norobot" />
            <img src="<?php echo $url; ?>://greenbro<?php echo ".$domen_part"; ?>/captcha/captcha.php" />
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>
    