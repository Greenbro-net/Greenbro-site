<!-- the container for log in the system  -->
<div class="validation_container"  id="log_in_window">
  <div  class="row mt-3">
    <div class="col-md-6" id="validation_container1">
    <!-- testing form code below  -->
    <form id="form" class="validation_window">

    <!-- <form id="form" class="validation_window" method="post" action="http://greenbro.com/validation/login"> -->
        <h4 class="mb-3" id="main_title" >Вхід в особистий кабінет</h4>
        <div class="form-group">
          <label class="validation_empty_class" for="name">Ім'я або email</label>
          <input type="text" class="form-control" name="username" id="name" placeholder="Username *" autocomplete="username">
             <!-- the code below for displays error message  -->
             <span class="invalidFeedback">
               <!-- <?php echo $data['usernameError']; ?> -->
             </span>
             <!-- the code above for displays error message  -->
        </div>
        <div class="form-group">
          <label class="validation_empty_class" for="password">Пароль</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Password *" autocomplete="new-password">
             <!-- the code below for displays error message  -->
             <span class="invalidFeedback">
               <!-- <?php echo $data['usernameError']; ?> -->
             </span>
             <!-- the code above for displays error message  -->
        </div>
                         
     <!-- testing code below  -->
<?php
    




// testing code below for autoloading 
$facebook = new \Facebook\Facebook([
    'app_id' => '884265225709842',
    'app_secret' => '88a78eda35cbb12323f383fdd7eac19e',
    'default_graph_version' => 'v9.0'
]);

 

        $handler = $facebook->getRedirectLoginHelper();

        $redirectTo = 'https://greenbro.net/facebook/fb_callback';
        $data = ['email'];
        $fullURL = $handler->getLoginUrl($redirectTo,  $data);



?>
<!-- <input type="button" onclick="window.location = '<?php echo $fullURL; ?>'" value="Login with Facebook"> -->

  <!-- testing code above for implementation of FB -->



      <h5 class="mb-3"><a href="<?php echo $url; ?>://greenbro<?php echo ".$domen_part"; ?>/facebook/login" target="_blank">Увійти через Facebook</a></h5>




      <!-- testing code above -->

      <h5 class="mb-3"><a href="https://www.cluemediator.com" target="_blank">Увійти через Google</a></h5>
      
        
        <div id="block_enter_forgot">
          <!-- testing form code below  -->
          <!-- test with inserted function below -->
          <input  type="button" name="submit" onclick="log_in_user()" id="submit" class="btn btn-primary" value="Вхід"/>
          <span id="error_message" class="text-danger"></span>
          <span id="success_message" class="text-success"></span>

          <!-- <input class="btn btn-primary" type="submit" id="validation_button_submit" class="btn btn-primary" value="Вхід"/> -->
          <a href="" class="block_enter_forgot" type="submit" id="validation_forget_password" class="btn btn-primary" value="Забули пароль?">Забули пароль?</a>      
        </div>

        <!-- testing code  -->
        <div class="switch_to_registration" id="switch_to_registration_id">
                <div class="switch_registration" id="registration_question">Ще не зареєструвалися?</div>
                 <div class="switch_registration" id="div_registration_from_login">Зареєструватися</div>
        </div>
        <!-- testing code  -->
    </div>
  
  </div>

</div>
</form>




