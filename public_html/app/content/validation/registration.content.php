
<!-- the container for registration -->
<div class="registration_container"  id="registration_window">
  <div  class="row mt-3">
    <div class="col-md-6" id="validation_container1">
        <h4 class="mb-3" id="main_title" >Реєстрація</h4>
      <form id="form" class="registration_window" method="post" action="<?php echo $url; ?>://greenbro<?php echo ".$domen_part"; ?>/validation/register">
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
        <!-- the code below for come back to log in window  -->
        <div class="form-group">
          <label class="validation_empty_class" for="confirmPassword">В мене вже є аккаунт</label>
          <p class="validation_empty_class" for="confirmPassword">Увійти</p>
        </div>
        <input type="submit" id="validation_button_submit" class="btn btn-primary" value="Submit" />
      </form>
    </div>
  </div>
</div>


<!-- the code below has to moved to js folder -->
<script>
    $(document).ready(function () {
        $('#form').validate({
          rules: {
            name: {
              required: true
            },
            email: {
              required: true,
              email: true
            },
            contact: {
              required: true,
              rangelength: [10, 12],
              number: true
            },
            password: {
              required: true,
              minlength: 8
            },
            confirmPassword: {
              required: true,
              equalTo: "#password"
            }
          },
          messages: {
            name: 'Введіть ім\'я.',
            email: {
              required: 'Будь ласка введіть електронну адресу.',
              email: 'Будь ласка введіть дійсну електронну пошту.',
            },
            contact: {
              required: 'Будь ласка введіть мобільний номер телефону.',
              rangelength: 'Номер телефону має містити 10 цифр.'
            },
            password: {
              required: 'Будь ласка введіть пароль.',
              minlength: 'Пароль має містити 8 символів.',
            },
            confirmPassword: {
              required: 'Будь ласка підтвердіть пароль.',
              equalTo: 'Введений пароль не співпадає, підтвердіть пароль.',
            }
          },
          submitHandler: function (form) {
            form.submit();
          }
        });
      });

    
    </script>
  



   