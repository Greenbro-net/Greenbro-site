function add() {
    var element = document.getElementById('block-a');
    var link = document.createElement('a');
    var br = document.createElement('br');

    link.innerHTML = 'Go to google';
    link.href = 'http://google.com';

    element.appendChild(br);
    element.appendChild(link); 
}

function delete_element() {
    // gets element with some ID
    var someId = document.getElementById('block-a'); 

    for (let i = 0; i < 2; i++) {
        var lastNode = someId.lastChild;
        lastNode.parentNode.removeChild(lastNode);
    }
}

// functions for add and delete images
function add_window() {
    var element = document.getElementById('block_of_images');
    var link1 = document.createElement('input');
    link1.type="file";
    var blah = document.createElement('img');
    // blah.src="#";
    blah.alt="your image";
    blah.id="blah";

    
    var br1 = document.createElement('br');



    element.appendChild(br1);
    element.appendChild(link1);
    element.appendChild(blah);
    
}

function delete_window() {
    var add_image = document.getElementById('block_of_images');

    for (let a = 0; a < 2; a++) {
        var lastNode_window = add_image.lastChild;
        lastNode_window.parentNode.removeChild(lastNode_window);
    }
}




//The js code below display images before uploading
function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  
  $("#fileToUpload").change(function() {
    readURL(this);
  });