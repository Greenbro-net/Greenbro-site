

<!-- the container for registration new manager -->
<div class="registration_container"  id="add_manager_window">
  <div  class="row mt-3">
    <div class="col-md-6" id="validation_container1">
        <h4 class="mb-3" id="main_title" >Registration new manager</h4>
      <form action="<?php echo $url; ?>://greenbro<?php echo ".$domen_part"; ?>/admin/call_add_new_manager"
      id="form_registration" class="registration_window" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label class="validation_empty_class" for="name">Manager name</label>
          <input type="text" class="form-control" name="manager_name" id="name" autocomplete="username">
        </div>
        <!-- the code below set up manager access -->
        <h6>Set up manager access</h6>
            <label class="container">Casual access
              <input type="radio" value="1" checked="checked" name="manager_access">
              <span class="checkmark"></span>
            </label>
            <label class="container">Full access
              <input type="radio" value="5" name="manager_access">
              <span class="checkmark"></span>
            </label>

        <div class="form-group">
          <label class="validation_empty_class" for="password">Password</label>
          <input type="password" class="form-control" name="manager_password" id="password" autocomplete="new-password">
        </div>

        <div class="form-group">
          <label class="validation_empty_class" for="confirmPassword">Confirm password</label>
          <input type="password" class="form-control" name="manager_confirm_password" id="confirmPassword" autocomplete="new-password">
        </div>
        

        <input type="submit" name="submit" id="add_manager_button_submit" class="button_add_manager" value="Add new manager" />
      </form>


    </div>
  </div>
</div>

