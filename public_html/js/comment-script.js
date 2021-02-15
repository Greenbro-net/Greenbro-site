// the code below gets right url setting for app 

    var json = $.getJSON({'url': "/url_settings.json", 'async': false});
    json = JSON.parse(json.responseText);
    domen_part = json.domen_part;
    url = json.url;


//  function  addComment(currentElement, response_id, rating, appearence)
function  call_add_comment(product_id) {
    // check it in the future
    var loaderIcon = $(this).closest(".row-item");
    // variable below for user name  
    var  user_name = $("#input-name" + product_id).val();
    // variable below for user email
    var user_email_response = $("#input-email" + product_id).val();
    // variable  below for user rating
    var rating = $(".selected").length;
    // variable below for user comment
    var comment = $("#input-message" + product_id).val();

    
    // alert("call_add_comment function" + rating + user_name + user_email_response + comment);
     
$.ajax({
    type: "POST",
    url : url+"://greenbro."+domen_part+"/response/run_add_new_comment",
    dataType: 'json',
    data : { product_id: product_id, rating: rating, user_name: user_name, user_email_response: user_email_response, comment: comment},
    
    beforeSend : function() {
        // check it in the future
    $(loaderIcon).find("#loader-icon").show();    
    },
    // the response variable below contains echo from php controller 
    success : function (response) {
          
    // check it in the future 
    loaderIcon = $(this).closest(".row-item");
    $(loaderIcon).find("#loader-icon").hide();


  // TO DO create messages for user has already add a rating and user can't add more that one comment for one item
  if (response != "") {
    if (response.posted == "Method addNewRating was executed successful") {
      // the code below displays message
      $("#message_place" + product_id).fadeIn().addClass("success").addClass("display_messages").text("Коментар був успішно доданий");
      // the code below hides messages after 4 sec 
      $("#message_place" + product_id).fadeOut(4000);
         return false;
       }    //block of code below displays message if happened mistake in add method
        else if ((response.posted == "Error is") && (response.success == false)) {
          $("#message_place" + product_id).fadeIn().addClass("unsuccess").addClass("display_messages").text("Сталася помилка коментар не був доданий");
          $("#message_place" + product_id).fadeOut(4000);
          return false;
                   }
            }
    // code if success from responseController equals false 

    if (appearence == 'star') {
    $('#list-' + product_id + ' li').each(
    function(index) {
    $(this).addClass('selected');
    if (index == $('#list-' + product_id + ' li').index(
    currentElement)) {
    return false;
                     }
        });
      } else {
    $(currentElement).addClass('selected');
      }
    },
    // the code below is testing for display error messages in user side 
    error: function(data) {
    //   alert("Error in call_add_comment function");
    }
  });
}


// function below displays window for leaving comment form
function display_comment_form(product_id) {
     jQuery(document).ready(function() {
        $("#main_form_comment_container"+product_id).toggle();
        // alert("display_comment_form");
        call_check_log_in(product_id); 
     });


    //Declare the loading gif as a variable, which will be used later
    $(".default").each(function() {
        var defaultVal = $(this).attr('title');
        $(this).focus(function() {
            if ($(this).val() == defaultVal) {
                $(this).removeClass('active').val('');
            }
        });
        $(this).blur(function() {
            if ($(this).val() == '') {
                $(this).addClass('active').val(defaultVal);
            }
        })
        .blur().addClass('active');
    });

    //Form validation and submit when button is clicked
    $('#submit_addComment' + product_id).click(function() {
    //Declare the function variables - parent form, form URL and the regex for checking the email
       var $formId = $(this).parents('form');
       var formAction = $formId.attr('action');
       default_text_remove();
       var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    //In preparation for validating the form - Remove any active default text and previous errors
       $('li', $formId).removeClass('error');
       $('span.error').remove();


    //the block of code below for input stars
        // variable  below for user rating
    var rating = $(".selected").length;
        // var  inputStar = $("#stars_input" + product_id).val();
        // alert("value:" +   inputStar);
        if (rating ==  '') {
            $("#stars_container" + product_id).addClass('error').append('<span class="error">Заповніть це поле, потрібна твоя оцінка</span>');
        }  

    //Start validation by selecting all inputs with the class "required"
       $('.required',$formId).each(function() {
        // TO DO function or gap how to get value in loop from STARS 
           var inputVal = $(this).val();
           var $parentTag = $(this).parent();
           if (inputVal == '') {
                // the code below adds error message in HTML DOM
                $parentTag.addClass('error').append('<span class="error">Заповніть це поле</span>');  
           }
    
    // Run the email validation using the regex for those input items also having class "email"
        if ($(this).hasClass('email') == true) {
            if(!emailReg.test(inputVal)) {
                $parentTag.addClass('error').append('<span class="error">Введіть правильну електронну адресу</span>');
            }
        }
       });

    //All validation complete - check whether any errors exist - if not submit form
    if ($('span.error').length == "0") {
        $.post(formAction, $formId.serialize(), function() {
            $('.loading').remove();

      });
    } 
    //Use the following to prevent the form being submitted the standard way
      event.preventDefault();
  });
}

// the function below clears input fields after form was submitted
function clear_input_fields(product_id) {
    // the code below clears input-form-fields
  $("#input-name" + product_id).val("");
  $("#input-email" + product_id).val("");
  $("#input-message" + product_id).val("");
  //the code below delete clears value from stars 
  $("#stars_container" + product_id).children().each(function()  {
      $(this).removeClass('selected');
  });
}

// function below closes window for leaving comment form
function close_sign_form(product_id) {
     jQuery(document).ready(function() {
        $("#main_form_comment_container"+product_id).toggle();
     });
}

// the function below call validation controller and check was user log in or not
function call_check_log_in(product_id) {
    $.ajax({
        type: "POST",
        url: url+"://greenbro."+domen_part+"/validation/check_log_in",
        dataType: 'json',
        data: {},
        success: function(response) {   
        if (response != "") {
            if ((response.posted == "User did not log in") && (response.success == false)) {
            // the code below display message 
            $("#message_place" + product_id).fadeIn().addClass("unsuccess").addClass("display_messages").text("Щоб залишити коментар зайдіть в особистий " +
            "кабінет чи використайте запропоновані сервіси");
            $("#message_place" + product_id).fadeOut(4000);
            return false;
            }
            // the code below is user has already logged in
            else if ((response.posted == "User was log in") && response.success == true) {
            // the function below get autocomplete user email
            call_get_user_email(product_id);
            return false;
            }
        }
    },
    // the code below for error case 
    error: function(response)  {
        // alert("Error in call_check_log_in");
    }
  });
}

// the function below allows add one comment for item by user after user was log in 
function preparing_comment(product_id) {
    $.ajax({
        type: "POST",
        url: url+"://greenbro."+domen_part+"/validation/check_log_in",
        dataType: "JSON",
        data:  {},
        success: function(response) {

        if (response != "") {
            if ((response.posted == "User did not log in") && (response.success == false)) {
                call_check_log_in(product_id);
                return false;
            }
            else if ((response.posted == "User was log in") && response.success == true) {
            // the block of code above was put in ajax method
        $.ajax({
            type: "POST",
            url: url+"://greenbro."+domen_part+"/response/grab_quantity_comment",
            dataType: 'json',
            data: {product_id: product_id},
            success: function(response) {
    
            if (response != "") {
              if (response.posted == "User has already added a comment for the item") {
                    // the code below display message 
                    $("#message_place" + product_id).fadeIn().addClass("unsuccess").addClass("display_messages").text("Ви можете залишити один коментар для кожного товару");
                    $("#message_place" + product_id).fadeOut(4000);
                    return false;
                    }
             else if (response.posted == "User hasn't added a comment for the item yet") {
                    // the code below allows user leave a comment  
                    // We can execute function in success block it's just like a post parameter beetween functions 
                    call_add_comment(product_id);
                    clear_input_fields(product_id);
                    return false;
                }
            }
          },
          // the code below displays error message
          error: function(response) {
         // alert("Error in call_check_before_comment");
             }
        });
       // the block of code above inserted in ajax method
      }
     }
    },
        // the code below for error case 
        error: function() {
        // alert("Error in preparing_comment function");
        }
    });
}

// the function below get user email by AJAX
function call_get_user_email(product_id) {
    $.ajax({
    type: "POST",
    url: url+"://greenbro."+domen_part+"/validation/get_user_email",
    dataType: 'JSON',
    data: {},
    success: function(response) {
      if (response != "") {
      // block of code below puts user email in input field
      if  ((response.posted) != "" && (response.success == true)) {
          //   alert("There is user email" + response.posted);
          $("#input-email" + product_id).val(response.posted);
        }
      }
    },
    // the code below for error case 
    error: function() {
    //   alert("Error in call_get_user_email");
    }
    });
}


// the function below uses in other function 
function default_text_remove() {
    $('.default').each(function() {
        var defaultVal = $(this).attr('title');
        if ($(this).val() == defaultVal) {
            $(this).val('');
        }
    });
}
