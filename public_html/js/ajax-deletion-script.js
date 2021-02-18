// the code below gets right url setting for app 
var json = $.getJSON({'url': "/url_settings.json", 'async': false});
json = JSON.parse(json.responseText);
domen_part = json.domen_part;
url = json.url;




// TO DO throw argument to delete_user_data function by POST from hidden field makes it from session user_id to alphanumeric 
// the function below starts deletion user data by of user_id
function delete_user_data() {
    jQuery(document).ready(function() {
        var user_code = $("#deletion_button").val();


    $.ajax({
        url: url+"://greenbro."+domen_part+"/eraseuserdata/erase_data",
        method:"POST",
        dataType: "JSON",
        data:{user_code:user_code},
        success:function(response) {
        
        if (response != "") {
            if ((response.posted == "Дані успішно видалені") && (response.success == true)) {
                alert("Function delete_user_data was success");
                // the code below displays and hides message
                $("#deletion_window_message_id").addClass("success").addClass("deletion_window_message");
                $("#deletion_window_message_id").show();
                // $("#deletion_message_place").fadeOut(4000);
            } else {
                // alert("Function delete_user_data wasn't success")
                $("#deletion_message_place").fadeIn().addClass("unsuccess").addClass("deletion_display_messages").text(response.posted);
                $("#deletion_message_place").fadeOut(4000);
            }
        }
            
        },
        error:function(response) {
            // alert("Occurs a mistake in request" + response.posted);
            $("#deletion_message_place").fadeIn().addClass("unsuccess").addClass("deletion_display_messages").text("Дані не були видалені, сталася помилка");
                $("#deletion_message_place").fadeOut(4000);
        }
    });
        // the code below remove class from message place
        $("#registration_message_place").removeClass("unsuccess");
        
  });
}