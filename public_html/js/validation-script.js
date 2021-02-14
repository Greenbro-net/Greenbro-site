
  // TO DO validation like if all fields have to be fill in right way 
  
  // the code below hides  validation window for log in   
  $(document).ready(function () { 
    $('body').click(function(we) {
    
      if ($(we.target).attr("class") == "validation_button") {
            return false;
        }
      if ($(we.target).hasClass('validation_button') || $(we.target).hasClass('validation_window') || $(we.target).hasClass('row mt-3') || $(we.target).hasClass('col-md-6') ||
          $(we.target).hasClass('row mt-3')   || $(we.target).hasClass('mb-3') || $(we.target).hasClass('form-control') || $(we.target).hasClass('form-group') ||
          $(we.target).hasClass('field_title') || $(we.target).hasClass('user_information') || $(we.target).hasClass('validation_empty_class') 
           || $(we.target).hasClass("btn btn-primary")) {
            return false;
        } 
        //  $(".validation_window").toggle();
        $("#log_in_window").removeClass('active_validation');
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

    

    // the code below hides menu for user
    $(document).ready(function() {
      $("body").click(function(we) {
        // the code below prevents of hiding menu after click
        if ($(we.target).attr("class") == "user_info_block" || $(we.target).attr("class") == "user_loggedin_menu_li") {
          return false;
      }
      $("#user_loggedin_menu").hide();
      });
    });

    // the function below displays menu for user, who logged in (testing)
    function display_menu() {
      jQuery(document).ready(function(to) {
        $("#user_loggedin_menu").show();
      });
    }


      

    
    
      
    
      

