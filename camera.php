<?php require_once "inc/bootstrap.php";
$auth = App::getAuth()->restrict();

?>
<?php require 'inc/header.php'; ?>

<?php
  if(isset($_POST['validation'])) {
	  if(!is_uploaded_file($_FILES['image']['tmp_name'])) {
		  echo 'Un problème est survenu durant l opération. Veuillez réessayer !';
    } else {    
		    $extensions = array('/png', '/gif', '/jpg', '/jpeg');
		    $extension = strrchr($_FILES['image']['type'], '/');           
		    if(!in_array($extension, $extensions)) {
			    echo 'Vous devez uploader un fichier de type png, gif, jpg, jpeg.';
        } else {         
			    define('MAXSIZE', 300000);        
			    if($_FILES['image']['size'] > MAXSIZE) {
			      echo 'Votre image est supérieure à la taille maximale de '.MAXSIZE.' octets';
          } else {
            try {
              $db = new PDO('mysql:host=localhost;dbname=camagru', 'root', 'root');
            } catch (Exception $e) {
              exit('Erreur : ' . $e->getMessage());
            }
            $image = file_get_contents($_FILES['image']['tmp_name']);
				    $req = $db->prepare("INSERT INTO images(nom, description, img, extension) VALUES(:nom, :description, :image, :type)");
				    $req->execute(array(
					    'nom' => $_POST['nom'],
					    'description' => $_POST['description'],
					    'image' => $image,
					    'type' => $_FILES['image']['type']
					  ));
				  echo 'L\'insertion s est bien déroulée !';
        }
      }
    }
  }
?>

<!DOCTYPE html>
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
    <form enctype="multipart/form-data" action="camera.php" method="post">
        <input type="text" name="nom" id="nom" /><br />
        <textarea name="description" id="description" rows="10" cols="50"></textarea>
        <input type="file" name="image" id="image" /><br />
        <input type="submit" name="validation" id="validation" value="Envoyer" />
        <img id="photo" alt="The screen capture will appear in this box.">
    </form>
  </div>
</div>
</body>
</html>
