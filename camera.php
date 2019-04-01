<?php require_once "inc/bootstrap.php";
$auth = App::getAuth()->restrict();
?>
<?php require 'inc/header.php'; ?>

<!doctype html>
<html>
<head>
  <meta charset='utf-8'>
  <link rel="stylesheet" href="style.css" type="text/css" media="all">
  <script src="camera.js">
  </script>
<body>
<div class="contentarea">
  <h1 style="text-align: center;">Caméra</h1>
  <div class="camera">
    <video id="video">Video stream not available.</video>
    <button id="startbutton">Take photo</button> 
  </div>
  <canvas id="canvas">
  </canvas>
  <div class="output">
    <img id="photo" alt="The screen capture will appear in this box."> 
  </div>
</div>
</body>
</html>
