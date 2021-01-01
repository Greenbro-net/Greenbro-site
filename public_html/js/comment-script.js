jQuery(document).ready(function($) {
    // The code below displays comment write form in the top 
    $("#leave_comment_button").click(function() {
        $("#main_form_comment_container").toggle();
        // create there function which returns message if user didn't log in  
        
    


    }); 

    // The code below hides comment form after click
    $("#close_sign").click(function() {
        $("#main_form_comment_container").toggle();
    });


    // TO DO!!!
    // the method below makes message for user 
    function checkUser_id() {
        $.ajax({
            type: "POST",
            url: "http://greenbro.com/response/call_addNewComment",
            dataType:  "json",
        })
      }


    //Declare the loading gif as a variable, which will be used later
    var $loading = $('<div class="loading"><img src="../images/comment_image/loading.gif" alt="" /></div>');
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
    $('.btn-submit').click(function(e) {

    //Declare the function variables - parent form, form URL and the regex for checking the email
       var $formId = $(this).parents('form');
       var formAction = $formId.attr('action');
       defaulttextRemove();
       var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    //In preparation for validating the form - Remove any active default text and previous errors
       
       $('li', $formId).removeClass('error');
       $('span.error').remove();

    //Start validation by selecting all inputs with the class "required"
       $('.required',$formId).each(function() {
           var inputVal = $(this).val();
           var $parentTag = $(this).parent();
           if (inputVal == '') {
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
        $formId.append($loading.clone());
        $('fieldset',$formId).hide();
        $.post(formAction, $formId.serialize(), function(data) {
            $('.loading').remove();
            $formId.append(data).fadeIn();
        });
    } 
    //Use the following to prevent the form being submitted the standard way
      e.preventDefault();
  });
});
function defaulttextRemove() {
    $('.default').each(function() {
        var defaultVal = $(this).attr('title');
        if ($(this).val() == defaultVal) {
            $(this).val('');
        }
    });
}
