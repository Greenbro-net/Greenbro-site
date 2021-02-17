// the code below gets right url setting for app 
var json = $.getJSON({'url': "/url_settings.json", 'async': false});
json = JSON.parse(json.responseText);
domen_part = json.domen_part;
url = json.url;




// TO DO throw argument to delete_user_data function by POST from hidden field makes it from session user_id to alphanumeric 
// the function below starts deletion user data by of user_id
function delete_user_data() {
    jQuery(document).ready(function() {

    $.ajax({
        url: url+"://greenbro."+domen_part+"/eraseuserdata/erase_data",
        method:"POST",
        dataType: "JSON",
        data:{},
        success:function(response) {
        
        if (response != "") {
            if ((response.posted == "Success") && (response.success == true)) {
                alert("Function delete_user_data was success");
            } else {
                alert("Function delete_user_data wasn't success")
            }
        }
            
        },
        error:function(response) {
            alert("Occurs a mistake in request");
        }
    });
  });
}