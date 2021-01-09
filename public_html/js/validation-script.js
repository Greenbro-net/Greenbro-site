
  // TO DO validation like if all fields have to be fill in right way 
  // the code below hides  validation window for log in   
  $(document).ready(function () { 
    $('body').click(function(we) {
    
      if ($(we.target).attr("class") == "validation_button") {
            return false;
        }
      if ($(we.target).hasClass('validation_button') || $(we.target).hasClass('validation_window') || $(we.target).hasClass('row mt-3') || $(we.target).hasClass('col-md-6') ||
          $(we.target).hasClass('row mt-3')   || $(we.target).hasClass('mb-3') || $(we.target).hasClass('form-control') || $(we.target).hasClass('form-group') ||
          $(we.target).hasClass('field_title') || $(we.target).hasClass('user_information') || $(we.target).hasClass('validation_empty_class') ) {
            return false;
        } 
        //  $(".validation_window").toggle();
        $("#log_in_window").removeClass('active_validation');
        });
    });
  

    $(document).ready(function () {
        $('#form').validate({
          rules: {
            name: {
              required: true
            },
            password: {
              required: true,
              minlength: 8
            },
          },
        //   the below input field should get email or user name 
          messages: {
            name: 'Введіть ім\'я.',
            email: {
              required: 'Будь ласка введіть електронну адресу.',
              email: 'Будь ласка введіть дійсну електронну пошту.',
            },
            password: {
              required: 'Будь ласка введіть пароль.',
              minlength: 'Пароль має містити 8 символів.',
            },
          },
          submitHandler: function (form) {
            form.submit();
          }
        });
      });


    // the function below displays  window for log in
    function show_log_in()  {
      jQuery(document).ready(function(re) {
      
          if ($(re.target).hasClass('validation_window') || $(re.target).hasClass('row mt-3') || $(re.target).hasClass('col-md-6') ||
              $(re.target).hasClass('row mt-3')   || $(re.target).hasClass('mb-3') || $(re.target).hasClass('form-control') || $(re.target).hasClass('form-group') ||
              $(re.target).hasClass('field_title') || $(re.target).hasClass('user_information') || $(re.target).hasClass('validation_empty_class') || 
              $(re.target).hasClass('switch_registration') ) { 
            return false;
                          }
            $("#log_in_window").addClass("active_validation");
            $('.validation_window').show(); 
            // alert("You knocked button for log");
            $('#registration_window').hide();
      
      });
    }   





      
    // the code below window for registration
    // the function below displays  window for registration 
    $(document).ready(function (log) {
      $("#switch_to_registration_id, #validation_window").click(function () {
      // the code below hide validation window 
      // $('.validation_container').hide();
      $('.registration_container').show();
      $("#validation_window").addClass("active_validation");
      alert("Your should see validation_window for registration");
      // the code below can delete class 
      $("#registration_window").removeClass("hide_things");
         });
    });
    
      
    // TO DO validation like if all fields have to be fill in right way 
    // the code below hides  validation window for registration
    $(document).ready(function () {
     $('body').click(function(we) {
    
      if ($(we.target).attr("class") == "validation_button") {
            return false;
        }
      if ($(we.target).hasClass('validation_button') || $(we.target).hasClass('validation_window') || $(we.target).hasClass('row mt-3') || $(we.target).hasClass('col-md-6') ||
          $(we.target).hasClass('row mt-3')   || $(we.target).hasClass('mb-3') || $(we.target).hasClass('form-control') || $(we.target).hasClass('form-group') ||
          $(we.target).hasClass('field_title') || $(we.target).hasClass('user_information') || $(we.target).hasClass('validation_empty_class') || 
          $(we.target).hasClass('switch_registration') ) { 
            return false;
        } 
         $(".validation_window").hide();
        // $("#validation_window").removeClass('active_validation');
        });
    });
  
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


      

