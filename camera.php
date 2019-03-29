<?php require_once "inc/bootstrap.php";
$auth = App::getAuth()->restrict();
?>
<?php require 'inc/header.php'; ?>

<div class="camera">
  <video id="video">Video stream not available</video>
  <button id="startbutton">Take photo</button>
</div>
<canvas id="canvas">
</canvas>
<div class="output">
  <img id="photo" alt="The screen capture will appear in this box.">
</div>
<script type="text/javascript">

(function() {
  var width = 320;
  var height = 0;

  var streaming = false;

  var video = null;
  var canvas = null;
  var photo = null;
  var startbutton = null;
})

function startup() {
  video = document.getElementById('video');
  canvas = document.getElementById('canvas');
  photo = document.getElementById('photo');
  startbutton = document.getElementsById('startbutton');

  navigator.mediaDevices.getUserMedia({video: true, audio: false})
    .then(function(stream) {
      video.srcObject = stream;
      video.play();
    })
    .catch(function(err) {
      console.log("An error occured: " + err);
    });

  video.addEventListener('canplay', function(ev) {
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth);

      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  startbutton.addEventListener('click', function(ev) {
    takepicture();
    ev.preventDefault();
  }, false);
  clearphoto();
}

function clearphoto() {
  var context = canvas.getContext('2d');
  context.fillStyle = "#AAA";
  context.fillRect(0, 0, canvas.width, canvas.height);

  var data = canvas.toDataURL('image/png');
  photo.setAttribute('src', data);
}

function takePicture() {
  var context = canvas.getContext('2d');
  if (width && height) {
    canvas.width = width;
    canvas.height = height;
    context.drawImage(video, 0, 0, width, height);

    var data = canvas/toDataURL('image/png');
    photo.setAttribute('src', data);
  } else {
    clearphoto();
  }
}

</script>