<!-- the container for registration -->
<div class="registration_container"  id="registration_window">
  <div  class="row mt-3">
    <div class="col-md-6" id="validation_container1">
        <h4 class="mb-3" id="main_title" >Реєстрація</h4>
      <form id="form_registration" class="registration_window" method="POST">
        <div class="form-group">
          <label class="validation_empty_class" for="name">Ім'я</label>
          <input type="text" class="form-control" name="username" id="name" autocomplete="username">
        </div>
        <div class="form-group">
          <label class="validation_empty_class" for="email">Електронна адреса</label>
          <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
          <label class="validation_empty_class" for="contact">Контактний номер телефону</label>
          <input type="text" class="form-control" name="contact" id="contact">
        </div>
        <div class="form-group">
          <label class="validation_empty_class" for="password">Пароль</label>
          <input type="password" class="form-control" name="password" id="password" autocomplete="new-password">
        </div>
        <div class="form-group">
          <label class="validation_empty_class" for="confirmPassword">Підтвердіть пароль</label>
          <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" autocomplete="new-password">
        </div>
        

        <input type="button" name="submit" onclick="registration_user()" id="registration_button_submit" class="btn btn-primary" value="Зареєструватися" />
      </form>

      <!-- the code below for come back to log in window  -->
      <div class="form-group_go_back" id="go_back_login" onclick="show_log_in()">
          <label class="form-group_go_back">В мене вже є аккаунт</label>
          <p class="form-group_go_back">Увійти</p>
      </div>

    </div>
  </div>
</div>


    
    