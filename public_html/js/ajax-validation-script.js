  // the code below gets right url setting for app 

    var json = $.getJSON({'url': "/url_settings.json", 'async': false});
    json = JSON.parse(json.responseText);
    domen_part = json.domen_part;
    url = json.url;
  

    

// the function below logout user from system 
function logout_user() {
     jQuery(document).ready(function() {
    // the url below is right path for all pages
    var current_url = window.location.href;
 $.ajax({
     type: "POST",
     url: 'index.php?action=logout',
     data: {},
     success: function(data) {
        //  the code below displays messages
        alert("Function logout_user was executed");
     }
  });
    // the code below reload validation button and displays correct info of item after updating
        $("#reload_window_1").load(current_url + "/" + " #reload_window_1");
      });
  };


//function below for log in user
function log_in_user() {
    jQuery(document).ready(function() {
        
               var username = $('#name').val();
               var password = $('#password').val();
              // the url below is right path for all pages
              var current_url = window.location.href;
          
               if (username == '' || password == '')
               {
                   $('#error_message').html("All Fields are required");
                   // the return false doesn't allow click the button with  empty fields
                   alert("Function has to be stopped");
                   return false;
               } else {
                   $('#error_message').html('');
                   $.ajax({
                       url: url+"://greenbro."+domen_part+"/validation/login",
                       method:"POST",
                       data:{username:username, password:password},
                       success:function(data) {
                         $("form").trigger("reset");
                         $("#success_message").fadeIn().html(data);
              // dublicate the reload block for better execution 
              $("#reload_window_1").load(current_url + "/" + " #reload_window_1");
                        
                        //  the code below doesn't work properly
                         setTimeout(function(){
                           $('#success_message').fadeOut('slow');
                         }, 4000);
                       }
                   });
               }
                   // the code below reload validation button and displays correct info of item after updating
              $("#reload_window_1").load(current_url + "/" + " #reload_window_1");
            
            });
            
          };
    
 
