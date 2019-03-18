<?php require_once "inc/bootstrap.php";
$auth = App::getAuth()->restrict();

?>
<?php require 'inc/header.php'; ?>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style type="text/css">
    html {
      height: 100%;
    }

    h1 {
      text-align: center;
    }

    video, canvas, #startbutton, #send_snap {
      display: block;
      float: left;
      border: 2.5px solid grey;
      border-radius: 10px;
    }
    #startbutton {
      background: green;
      border: none;
      color: #fff;
      margin: 100px 20px 20px 20px;
      padding: 10px 20px;
      font-size: 20px;
    }
    #container {
      overflow: hidden;
      width: 880px;
      margin: 20px auto;
    }

    #send_snap {
      background: blue;
      border: none;
      color: #fff;
      margin: 100px 20px 20px 20px;
      padding: 10px 20px;
      font-size: 20px;
      margin : auto;
    }
  </style>
</head>

<body>

  <h1>Caméra</h1>
  <div id="container">
    <video id="video"></video>
    <button id="startbutton">Prendre la photo</button>
    <canvas id="canvas"></canvas>
    <button id="send_snap">Envoyer</button>
  </div>

<script type="text/javascript">

(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 320,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.srcObject = stream;
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/jpeg');
    photo.setAttribute('src', data);
  }

  function uploadimage() {
    
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

  startbutton.addEventListener('click', function(ev)){

  }

})();

</script>
</body>
</html>

<?php require 'inc/footer.php'; ?>

