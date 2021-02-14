  // the code below gets right url setting for app 
    var json = $.getJSON({'url': "/url_settings.json", 'async': false});
    json = JSON.parse(json.responseText);
    domen_part = json.domen_part;
    url = json.url;
  

    

// the function below logout user from system 
function logout_user() {
     jQuery(document).ready(function() {
    // the url below is right path for all pages
    var current_url = window.location.href;
 $.ajax({
     type: "POST",
     url: 'index.php?action=logout',
     data: {},
     success: function(data) {
        //  the code below displays messages
        // alert("Function logout_user was executed");
        // dublicate the reload block for better execution
        $("#reload_window_1").load(current_url + "/" + " #reload_window_1");
     }
     
  });
    // the code below reload validation button and displays correct info of item after updating
        $("#reload_window_1").load(current_url + "/" + " #reload_window_1");
      });
  };


//function below for log in user
function log_in_user() {
    jQuery(document).ready(function() {
        
      var username = $('#login_name').val();
      var password = $('#login_password').val();
      // the url below is right path for all pages
      var current_url = window.location.href;
      // the code below remove error-class from DOM
      $(".error").remove();

      if (username.length < 1) {
        $('#login_name').after('<span class="error">Введіть ім\'я.</span>');
        return false;
      } 
      if (password.length < 8) {
        $('#login_password').after('<span class="error">Пароль має містити мінімум 8 символів</span>'); 
        return false;
      } else {
          $('#error_message').html('');
          $.ajax({
              url: url+"://greenbro."+domen_part+"/validation/login",
              method:"POST",
              dataType: 'json',
              data:{username:username, password:password},
              success:function(response) {
                // $("form").trigger("reset");
               
              if (response !=  "") {
                if ((response.posted == "User was log in") && (response.success == true)) {
                  // alert("Hello" + response.posted + response.success);
                  $("#login_message_place").fadeIn().addClass("success").addClass("display_messages").text("Ви успішно увійшли в систему");
                  $("#login_message_place").fadeOut(4000);
                  // dublicate the reload block for better execution 
                  $("#reload_window_1").load(current_url + "/" + " #reload_window_1");
                  // the code below hides login window
                  $("#log_in_window").removeClass('active_validation');
                  return false;
                      }
                  //block of code below displays message if happened mistake in login method
                else if ((response.posted == "User did not log in") && (response.success == false)) {
                  $("#login_message_place").fadeIn().addClass("unsuccess").addClass("display_messages").text("Ви не увійшли в систему");
                  $("#login_message_place").fadeOut(4000);
                  return false;
                      }
              } 
                            
              },
              error:function(response) {
                $("#login_message_place").fadeIn().addClass("unsuccess").addClass("display_messages").text("Ви не увійшли в систему");
                $("#login_message_place").fadeOut(4000);
                 return false;
              }
          });
      }
          // the code below reload validation button and displays correct info of item after updating
    $("#reload_window_1").load(current_url + "/" + " #reload_window_1");
  
  });
};
    
 
