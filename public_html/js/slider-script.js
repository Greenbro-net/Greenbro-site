// SLIDER DOESN'T WORK PROPERLY IT HAS TO BE REEDIT 

// the part of code below for image slider
function zoomIn(zoom) {

    if (zoom == 'bigger') {
        $('.slider img').addClass('bigger');
    }
};

//  variable direction equals next or prev 
function changeSlide(direction) {
 //  alert("changSlide function");
//   create variable which has acces to  element with .active 
// A $ sign to define/access jQuery
  var currentImg = $('.active');

//The next() method returns the next sibling element(or first) of 
// the selected element.
  var nextImg = currentImg.next();
  var previousImg = currentImg.prev();

    if (direction == 'next') {

        if (nextImg.length) {
            nextImg.addClass('active');
        }
     else
//the action below makes first img element equal 'active' class 
        $('#images' + id).children().first().addClass('active');
    } else {

        if(previousImg.length) {
        previousImg.addClass('active');
    }
     else
       $('#images' + id).children().last().addClass('active');
    }
    currentImg.removeClass('active');
}

$(document).mouseup(function (e) { 
    if ($(e.target).closest("img").length 
                === 0) { 
        $(".slider img").removeClass('bigger');
    } 
}); 
