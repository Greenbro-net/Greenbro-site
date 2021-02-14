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

    alert("Function registration_user");
    // the code below call controller method by of ajax
    $.ajax({
        url: url+"://greenbro."+domen_part+"/validation/register",
        method:"POST",
        data:{username:username, email:email, phone_number:contact,
              password:password, confirm_password:confirmPassword},
        success:function(response) {
            alert("Success  in function"  + response);
        },
        error: function(response) {
            alert("Error in funciton" + response);
        }

    });

    });



}



