

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Call_back</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../cssgb.css" />
    <script src="main.js"></script>
</head>
<body>
<div id ="back_home">
<a   href="../index.php">back home</a>
 </div>

 <h2>Form of call_back</h2>
     <form name="feedback" action="callback.php " method="POST">
          <label> From whom:</label><br />
          <input type="text" name="from" size="40" <?php  $from ?>/> <br />
          <span style="color:red"><?=$error_from?></span><br />
          <label> To whom: </label><br />
          <input type="text" name="to" size="40" /> <br />
          <span style="color:red"><?=$error_to?></span><br />
          <label> Topic </label><br />
          <input type="text" name="subject"  size="40" /><br />
          <span style="color:red"><?=$error_subject?></span><br />
          <label> Message: </label><br />
          <textarea name="message" cols="40" rows="20"> </textarea><br />
          <span style="color:red"><?=$error_message?></span><br />
          <input type="submit" name="send" value="To send" /> 
 </body>
</html>