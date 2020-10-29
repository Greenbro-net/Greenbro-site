<?php


  //Above HTML
  $name_error = '';
  $email_error = '';
  $password_error = '';
  $output = '';

  if (isset($_POST["validation_submit"]))
  {
      if (empty($_POST["user_name"]))
      {
          $name_error = "<p>Please Enter Name</p>";
      } else {
          if (!preg_match("/^[a-zA-Z ]*$/", $_POST["user_name"]))
          {
              $name_error = "<p>Only Letters and whitespace allowed</p>";
          }
      }
      if (empty($_POST["user_email"]))
      {
          $email_error = "<p>Please Enter Email</p>";
      } else {
          if (!filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL))
          {
              $email_error = "<p>Invalid Email formate</p>";
          }
      }
      if (empty($_POST["user_password"]))
      {
          $password_error = "<p>Please enter your password</p>";
      }

      if ($name_error == "" && $email_error == "" && $password_error == "")
      {
          $output = '<p><label>Output-</label></p>
          <p>Your Name is '.$_POST["user_name"].'</p>
          <p>Your Email is '.$_POST["user_email"].'</p>
          <p>Your Password is hidden :))</p>';
      }
  }



  //   testing code above
    //    var_dump($_SERVER["PHP_SELF"]);
       // unset($_POST['user_name']);
    //    var_dump($_POST['user_name']);


?>



    <!-- the code below for validation system  -->
    <div id="validation_block">
    <form  name="do_validation" action='http://greenbro.com/validator/get_validation_data' method="POST" enctype="multipart/form-data">
       <!-- user name  -->
       <p>
       <label class="field_title" for="user_name">Ім'я</label>           
       <input id="validation_user_name"  type="text" name="user_name" class="user_information"   placeholder="Введіть ім'я" pattern="[a-zA-Z0-9]{3,25}" title="Ім'я може складатися тільки з англійського алфавіту та цифр" required>
        </p>
        <span class="text-danger"><?php echo $name_error; ?></span>
       <!-- enter email -->
       <p>
       <label class="field_title" for="user_email">Електронна адреса</label>
       <input id="validation_user_email"  type="text" name="user_email" class="user_information"  placeholder="Введіть електронну адресу" title="Електронна адреса може містити літери англійського алфавіту, цифри та знак @" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
       </p>
       <span class="text-danger"><?php echo $email_error; ?></span>
       <!-- user password  -->
       <p>
       <label class="field_title" for="user_password">Пароль користувача</label>
       <input id="validation_user_password" type="password" name="user_password" class="user_information" placeholder="Введіть пароль" title="Пароль може містити літери англійського алфавіту, цифри та знаки" >
       </p>
       <span class="text-danger"><?php echo $password_error; ?></span>
       <div>
       <!-- <input type="submit" name="validation_submit"> -->
       <button type="submit" id="button_submit">Submit data</button>
       </div>
    </form> 
    <!-- the code below displays us successful message after full validation -->
    <div><?php
    //  echo $output; 
    if (!empty($_POST['validation_submit']) &&!empty($_POST["user_name"] && $_POST["user_email"]  && $_POST["user_password"]) ) {
        // echo "Everything is fine";
    
        header('Location: http://greenbro.com/validator/get_validation_data');
        exit;
    }
    
     ?>

     </div>
    </div>

  