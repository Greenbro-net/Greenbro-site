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





  // variable response_id is empty
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


