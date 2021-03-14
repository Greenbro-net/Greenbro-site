// function below displays window for adding new manager
function display_add_new_manager_form() {
    jQuery(document).ready(function() {
        $("#add_manager_window").toggle();
    })
}

// function below for downloading images
function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
                // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {
        // Only process image files.
    if (!f.type.match('image.*')) {
        alert("Image only please....");
    }
    var reader = new FileReader();
    // Closure to capture the file information.
    reader.onload = (function (theFile) {
        return function (e) {
            // Render thumbnail.
            var span = document.createElement('span');
            span.innerHTML = ['<img class="thumb" title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
            document.getElementById('outputMulti').insertBefore(span, null);
        };
    })(f);
    // Read in the image file as a data URL.
    reader.readAsDataURL(f);
            }
        }
        // document.getElementById('fileMulti').addEventListener('change', handleFileSelect(), false);


    //function for main_image
        var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
            }
        };