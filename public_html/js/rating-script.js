// that file contains url which has to be change on the server side 
// courseId we change to response_id

function mouseOverRating(response_id, rating, appearance) {
    if (appearance == "star") {
        for (var i = 1; i <= rating; i++) {
        // the code below makes id for star 
        $('#' + response_id + "_" + i + ' img').attr('src',
        "../images/comment_image/" + appearance + "-filled.png");
           }
        } else {
        ratingIconPrefix = "../images/comment_image/" + appearance;
        for (var i = 1; i <= rating; i++) {
        if (appearance == "star") {
        ratingIconPrefix = "../images/comment_image/" + appearance + "1";
           }
        if (i == rating) {
        $('#' + response_id + "_" + i + ' img').attr('src',
        ratingIconPrefix + "-filled.png");
            }
        }
    }
}

function mouseOutRating(response_id, rating, appearance) {
    if (appearance == "star") {
    if (rating != 0) {
    for (var i = 1; i <= rating; i++) {
    $('#' + response_id + "_" + i + ' img').attr('src',
    "../images/comment_image/" + appearance + "-filled.png");
            }
        }
    if (rating <= 5) {
    for (var i = (rating + 1); i <= 5; i++) {
    $('#' + response_id + "_" + i + ' img').attr('src',  
    "../images/comment_image/" + appearance + "-open.png");
                          }
                               }

    $(".selected img").attr('src', "../images/comment_image/" + appearance + "-filled.png");
    } else {
        ratingIconPrefix = "../images/comment_image/" + appearance;
    
    if (rating <= 5) {
          for (var i = 1; i <= 5; i++) {
          if (appearance == "star") {
          ratingIconPrefix = "../images/comment_image/" + appearence + i;
        }  
    
    if (rating == i) {
    $('#' + response_id + "_" + i + ' img').attr('src',
    ratingIconPrefix + "-filled.png");
    } else {
    $('#' + response_id + "_" + i + ' img').attr('src',
    ratingIconPrefix + "-open.png");                    
                }
        }
      } 
    var selectedImageSource = $(".selected img").attr('src');
    if (selectedImageSource) {
    selectedImageSource = selectedImageSource.replace('open', "filled");
    $(".selected img").attr('src', selectedImageSource);
       }
    }   
}




// TO DO that function will be change and delete 
// origin version currentElement, courseId, ratingValue, appearence
// origin version of data "index" + ratingValue + "&course_id=" + courseId
function  addComment(currentElement, response_id, rating, appearence) {
    var keep_rating = rating;
    var loaderIcon = $(currentElement).closest(".row-item");

    // alert(keep_rating);
$.ajax({
    // we should change it on the server side
    type: "POST",
    url : "http://greenbro.com/response/call_addNewComment",
    dataType: 'json',
    data : { response_id: response_id, rating: rating},
    
    beforeSend : function() {
    $(loaderIcon).find("#loader-icon").show();    
    },
    // the response variable below contains echo from php controller 
    success : function (response) {
          

    loaderIcon = $(currentElement).closest(".row-item");
    $(loaderIcon).find("#loader-icon").hide();


    


  // TO DO create messages for user has already add a rating and user can't add more that one comment for one item
  if (response != "") {
    if (response.posted == "Method addNewRating was executed successful") {
      // the code below displays message
      $("#message_place" + response_id).fadeIn().addClass("success").addClass("display_messages").text("Коментар був успішно доданий");
      // the code below hides messages after 4 sec 
      $("#message_place" + response_id).fadeOut(4000);
         return false;
       }   //block of code below displays message if user don't log in 
        else if ((response.posted == "User did not log in") && (response.success == false))  {
         $("#message_place" + response_id).fadeIn().addClass("unsuccess").addClass("display_messages").text("Щоб залишити коментар зайдіть в особистий " +
            "кабінет чи використайте запропоновані сервіси");
         $("#message_place" + response_id).fadeOut(4000);
            return false;
                   } //block of code below displays message if happened mistake in add method
        else if ((response.posted == "Error is") && (response.success == false)) {
          $("#message_place" + response_id).fadeIn().addClass("unsuccess").addClass("display_messages").text("Сталася помилка коментар не був доданий");
          $("#message_place" + response_id).fadeOut(4000);
          return false;
                   }
            }
    // code if success from responseController equals false 

    if (appearence == 'star') {
    $('#list-' + response_id + ' li').each(
    function(index) {
    $(this).addClass('selected');
    if (index == $('#list-' + response_id + ' li').index(
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
    // error: function(data) {
    //   alert("Error" + data);
    // }
    // the code above is testing 
  });

}


  // function for safe rating and add  class for star 
  function addClassStar(currentElement, response_id, rating, appearence) {
    var keep_rating = rating;
    var loaderIcon = $(currentElement).closest(".row-item");

    
          
    loaderIcon = $(currentElement).closest(".row-item");
    $(loaderIcon).find("#loader-icon").hide();

    // the code below adds value in stars_input
    $("#stars_input").val(keep_rating);

    if (appearence == 'star') {
    $('#stars_container' +    ' li').each(
    function(index) {
    // the index method returns us index from Element, starts from 0
    if (index == $('#stars_container' + ' li').index(
    currentElement)) {
    return false;
                     }
        });
      } else {
    //the  loop below for delete classes 
      $('#stars_container' + ' li').each(
        function() {
          $('li').removeClass('selected');
        });
    $(currentElement).addClass('selected');
    $(currentElement).prevAll().addClass('selected');
    
      }
                                             
  }


