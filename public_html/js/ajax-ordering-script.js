// the code below gets right url setting for app 

var json = $.getJSON({'url': "/config_settings.json", 'async': false});
json = JSON.parse(json.responseText);
domen_part = json.domen_part;
url = json.url;

// function below starts fill in user data in ordering process
function call_fill_in_customer_data() {
    $.ajax({
        type: "POST",
        url: url+"://greenbro."+domen_part+"/customer/fill_in_customer_data",
        dataType: 'JSON',
        data: {},
        success: function(response) {
            // block of code below puts customer data in input fields 
            if (response != "") {
                if ((response.posted) != "" && (response.success == true)) {
                    // alert("There is user data" + response.user_email+ response.phone_number);
                    // fill in html element with user data
                    $("#contact_user_email").val(response.user_email).animate({opacity: '0.7'});
                    $("#contact_recipient_mobile_number").val(response.phone_number).animate({opacity: '0.7'});
                }
            }
        },
        // the code below for error case
        error: function() {
            // alert("Error in call_fill_in_customer_data");
        }
    });
}