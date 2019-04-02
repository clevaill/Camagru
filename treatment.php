<?php
  if(isset($_POST['validation'])) {
	 if(!is_uploaded_file($_FILES['image']['tmp_name']))
		echo 'Un problème est survenu durant l opération. Veuillez réessayer !';
	 else {    
		$extensions = array('/png', '/gif', '/jpg', '/jpeg');
		$extension = strrchr($_FILES['image']['type'], '/');           
		if(!in_array($extension, $extensions))
			echo 'Vous devez uploader un fichier de type png, gif, jpg, jpeg.';
		else {         
			define('MAXSIZE', 300000);        
			if($_FILES['image']['size'] > MAXSIZE)
			   echo 'Votre image est supérieure à la taille maximale de '.MAXSIZE.' octets';
			else {
				try {
					$bdd = new PDO('mysql:host=localhost;dbname=camagru', 'root', 'root');
				} catch (Exception $e) {
					exit('Erreur : ' . $e->getMessage());
				}
				$image = file_get_contents($_FILES['image']['tmp_name']);
 
				$req = $bdd->prepare("INSERT INTO images(nom, description, img, extension) VALUES(:nom, :description, :image, :type)");
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