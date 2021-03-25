
// the part of code below for image slider
function zoomIn(zoom) {

    if (zoom == 'bigger') {
        $('.slider img').addClass('bigger');
    }
};

//  variable direction equals next or prev 
function changeSlide(direction) {
//   alert("changSlide function" + id);
//   create variable which has acces to  element with .active_slider 
// A $ sign to define/access jQuery
  var currentImg = $('.active_slider');

//The next() method returns the next sibling element(or first) of 
// the selected element.
  var nextImg = currentImg.next();
  var previousImg = currentImg.prev();

    if (direction == 'next') {
        
        if (nextImg.length) {
            nextImg.addClass('active_slider');
        } else {
           //the action below makes first img element equal 'active_slider' class 
          $('#images' + id).children().first().addClass('active_slider');
               }
               currentImg.removeClass('active_slider');
    } 
    
    if (direction == 'prev') {

        if(previousImg.length) {
        
        previousImg.addClass('active_slider');      
    } else  {
        $('#images' + id).children().last().addClass('active_slider');
            }
            currentImg.removeClass('active_slider');
    }
    
}

// the function below testing for change image by of src name
function changeSrc() {
    src = $("#img_description_" + id).attr('src');
    alert(src);
    new_src = $("#img_description_" + id).attr('src', '../images/item_images/242/' + name + '.jpg');
    alert(new_src);
    name ++;
}


// the function below returns bigger image to the normar size
$(document).mouseup(function (e) { 
    if ($(e.target).closest("img").length 
                === 0) { 
        $(".slider img").removeClass('bigger');
    } 
}); 





















