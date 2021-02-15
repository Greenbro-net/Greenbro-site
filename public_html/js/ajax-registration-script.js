  // the code below gets right url setting for app 
  var json = $.getJSON({'url': "/url_settings.json", 'async': false});
  json = JSON.parse(json.responseText);
  domen_part = json.domen_part;
  url = json.url;


// the function below displays  window for registration 
$(document).ready(function () {
    $("#switch_to_registration_id, #validation_window").click(function () {
    // the code below hide validation window 
    $('.registration_container').show();
    $("#validation_window").addClass("active_validation");
    // alert("You should see validation_window for registration");
    // the code below can delete class 
    $("#registration_window").removeClass("hide_things");
       });
  });

// TO DO validation like if all fields have to be fill in right way 
// the code below hides  validation window for registration
$(document).ready(function () {
    $('body').click(function(we) {
    
    if ($(we.target).attr("class") == "registration_button_submit") {
        return false;
    }
    if ($(we.target).hasClass('btn btn-primary') || $(we.target).hasClass('validation_window') || $(we.target).hasClass('row mt-3') || $(we.target).hasClass('col-md-6') ||
        $(we.target).hasClass('row mt-3')   || $(we.target).hasClass('mb-3') || $(we.target).hasClass('form-control') || $(we.target).hasClass('form-group') ||
        $(we.target).hasClass('field_title') || $(we.target).hasClass('user_information') || $(we.target).hasClass('validation_empty_class') || 
        $(we.target).hasClass('switch_registration') || $(we.target).hasClass('error') ) { 
        return false;
    } 
    $(".validation_window").hide();
    // $("#validation_window").removeClass('active_validation');
    });
  });
    
        
        
function registration_user() {
    jQuery(document).ready(function() {
    //  f.preventDefault();
    var username = $('#name').val();
    var email = $('#email').val();
    var phone_number = $('#contact').val();
    var password = $('#password').val();
    var confirm_password = $('#confirmPassword').val();
    // the url below is right path for all pages
    var current_url = window.location.href;
    // the code below remove error-class from DOM
    $(".error").remove();

    if (username.length < 1) {
    $('#name').after('<span class="error">Введіть ім\'я.</span>');
    return false;
    }
    if (email.length < 1) {
    $('#email').after('<span class="error">Будь ласка введіть електронну адресу.</span>');
    return false;
    }
    if (email.length > 2) {
    var regEx = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;;
    var validEmail = regEx.test(email);
    if (!validEmail) {
        $('#email').after('<span class="error">Будь ласка введіть дійсну електронну пошту</span>');
        return false;
            }
    }
    if (phone_number.length < 10) {
    $('#contact').after('<span class="error">Будь ласка введіть мобільний номер телефону</span>');
    return false;
    }
    if (password.length < 8) {
    $('#password').after('<span class="error">Пароль має містити мінімум 8 символів</span>');
    return false;
    }
    if (password != confirm_password) {
    $('#confirmPassword').after('<span class="error">Введений пароль не співпадає, підтвердіть пароль</span>');
    return  false;
    }


    // the code below call controller method by of ajax
    $.ajax({
        url: url+"://greenbro."+domen_part+"/validation/register",
        method:"POST",
        dataType: 'json',
        data:{username:username, email:email, phone_number:phone_number,
              password:password, confirm_password:confirm_password},
        success:function(response) {
            if (response != "") {
               if (response.success == true) {
                // alert("Success in function"  + response.success + response.posted);
                // the code below displays and hides message 
                $("#registration_message_place").fadeIn().addClass("success").addClass("validation_display_messages").text(response.posted);
                $("#registration_message_place").fadeOut(4000);
                // dublicate the reload block for better execution 
                $("#reload_window_1").load(current_url + "/" + " #reload_window_1");
                // the code below hides registration window
                $('.registration_container').fadeOut(2000);
                $("#validation_window").removeClass("active_validation");
                return false;
               // the code below displays with error class(red)
               } else if (response.success == false){
                $("#registration_message_place").fadeIn().addClass("unsuccess").addClass("validation_display_messages").text(response.posted);
                $("#registration_message_place").fadeOut(4000);
                return false;
               }
            }
            
        },
        error: function(response) {
            // alert("Error in funciton" + response.success + response.posted);
            $("#registration_message_place").fadeIn().addClass("unsuccess").addClass("validation_display_messages").text("Сталася помилка, ви не увійшли в систему");
            $("#registration_message_place").fadeOut(4000);
            return false;
        }
        
    });
        // the code below remove class from message place
        $("#registration_message_place").removeClass("unsuccess");
        // dublicate the reload block for better execution 
        $("#reload_window_1").load(current_url + "/" + " #reload_window_1");
                  
    });



}



