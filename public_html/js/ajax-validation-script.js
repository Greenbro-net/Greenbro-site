// the function below logout user from system 
function logout_user() {
 $.ajax({
     type: "POST",
     url: 'index.php?action=logout',
     data: {},
     success: function(data) {
        //  the code below displays messages
        alert("Function logout_user was executed");
     }
  });
    //  TO DO but after reload it doesn't work after click
    // the code below reload validation button and displays correct info of item after updating
    $("#reload_window_1").load("http://greenbro.com/food/show_food/ #reload_window_1");
    // tesitng code below
    // $("#validation_button").live('click', function(e){
    //     alert('this is a click');
    // });
}

// the function below login user to system 
function login_user() {
    $.ajax({
        type: "POST",
        url: 'index.php?action=login',
        data: {},
        success: function() {
            // the code below display messages
            arert("Function login_user was executed");
         }
    });
}