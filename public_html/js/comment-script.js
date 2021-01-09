 // TO DO that function will be change and delete 
// origin version currentElement, courseId, ratingValue, appearence
// origin version of data "index" + ratingValue + "&course_id=" + courseId
//  function  addComment(currentElement, response_id, rating, appearence)
function  addComment(product_id, rating) {

    // check it in the future
    var loaderIcon = $(this).closest(".row-item");
    // variable below for user name  
    var  user_name = $("#input-name").val();
    // variable below for user email
    var user_email_response = $("#input-email").val();
    // variable  below for user rating
    var rating = $(".selected").length;
    // variable below for user comment
    var comment = $("#input-message").val();

    


    alert( user_email_response);

$.ajax({
    // we should change it on the server side
    type: "POST",
    url : "http://greenbro.com/response/call_addNewComment",
    dataType: 'json',
    data : { product_id: product_id, rating: rating, user_name: user_name, user_email_response: user_email_response, comment: comment},
    
    beforeSend : function() {
        // check it in the future
    $(loaderIcon).find("#loader-icon").show();    
    },
    // the response variable below contains echo from php controller 
    success : function (response) {
        alert("It was success" + response.posted + product_id + user_name + user_email_response + rating + comment);
          

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
       }   //block of code below displays message if user don't log in 
        else if ((response.posted == "User did not log in") && (response.success == false))  {
         $("#message_place" + product_id).fadeIn().addClass("unsuccess").addClass("display_messages").text("Щоб залишити коментар зайдіть в особистий " +
            "кабінет чи використайте запропоновані сервіси");
         $("#message_place" + product_id).fadeOut(4000);
            return false;
                   } //block of code below displays message if happened mistake in add method
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
    // the code above is success block 
    // the code below is testing for display error messages in user side 
    error: function(data) {
      alert("Error" + data);
    }
    // the code above is testing 
  });

}


// testing code above 
jQuery(document).ready(function($) {
    // The code below displays comment write form in the top 
    $("#leave_comment_button").click(function() {
        $("#main_form_comment_container").toggle();
        // create there function which returns message if user didn't log in  
        
        // url: "http://greenbro.com/response/call_addNewComment",


    }); 

    // The code below hides comment form after click
    $("#close_sign").click(function() {
        $("#main_form_comment_container").toggle();
    });


    





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
