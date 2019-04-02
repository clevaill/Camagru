<!DOCTYPE html>
<html>
<head>
    <title>Ma galerie d'images</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <style type="text/css">
		body {
			width: 95%;
		}
 
		div {
			width: 22%;
			float: left;
			text-align: center;
			border: 1px solid black;
			margin: 5px;
			padding:  5px;
		}
 
		p {
			text-align: left;
		}
 
		a {
			color: #000000;
			text-decoration: none;
		}
	   </style>
</head>
<body>
    <h1>Ma galerie d'images</h1>

    <?php
        try {
        $bdd = new PDO('mysql:host=localhost;dbname=camagru', 'root', 'root');
            } catch (Exception $e) {
        exit('Erreur : ' . $e->getMessage());
        }

        $reponse = $bdd->query('SELECT id, nom, description FROM images');
        while($result = $reponse->fetch()) {

        echo '<div>';
        echo '<a href="preview.php?id='.$result['id'].'"><img src="preview.php?id='.$result['id'].'" alt="'.$result['nom'].'" title="'.$result['nom'].'" /></a>';
        echo '<p>Description : '.$result["description"].'</p>';
        echo '</div>';
        }

        $reponse->closeCursor();
    ?>
</body>
</html>