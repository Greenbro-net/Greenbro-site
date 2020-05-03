

<form id= "manage_goods" name="manage_images" action="test_images.php " method="POST"
                     enctype="multipart/form-data">
<div class="container">
    <div class="row">

<!-- the code below for uploading main image -->
<h3>Main image download</h3>
        <input type="file" id="main_image" name="main_image"  accept=".jpg, .jpeg, .png" onchange="loadFile(event)">
        <img id="output"/>


<!-- the code below for uploading images -->
<h3>Multiple download:</h3>
        <!-- the code below makes limitation for file size -->
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        
        <p><input type="file" id="fileMulti" name="fileMulti[]" accept=".jpg, .jpeg, .png"  multiple/></p>
        
    </div>
    <div class="row">
        <span id="outputMulti"></span>
    </div>
</div>




<script>
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
document.getElementById('fileMulti').addEventListener('change', handleFileSelect, false);


// for main_image
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };


</script>

  <p><input type="submit" value="Send images"></p>
</form>