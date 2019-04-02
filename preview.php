<?php
    if(!empty($_GET['id'])) {
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=camagru', 'root', 'root');
	} catch (Exception $e) {
		exit('Erreur : ' . $e->getMessage());
	}
	$idImg = intval($_GET['id']);
	$req = $bdd->prepare('SELECT extension, img FROM images WHERE id = ?');
	$req->execute(array($idImg));		
 
	if($req->rowCount() != 1)
		echo 'L\'image n\'existe pas !';
	else {
		$donnees = $req->fetch();		
		header ("Content-type: ".$donnees['extension']);
		echo $donnees['img'];
	}
	$req->closeCursor();
    } else
        echo 'Vous n avez pas sélectionné d image !';
?>