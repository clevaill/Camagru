<?php

require_once 'inc/bootstrap.php';

if (!empty($_POST)){
	
	$errors = array();
	
	$db = App::getDatabase();
	$validator = new Validator($_POST);
	$validator->isAlpha('username', "Le nom d'utilisateur n'est pas valide !");
	if ($validator->isValid()) {
		$validator->isUniq('username', $db, 'users', "Cette nom d'utilisateur est déjà utilisé");
	}
	$validator->isEmail('email', "Votre mail n'est pas valide !");
	if ($validator->isValid()) {
		$validator->isUniq('email', $db, 'users', 'Cet email est déjà utilisé');
	}
	$validator->isConfirmed('password', 'Vous devez entrez un mot de passe valide');
    
    if ($validator->isValid()) {
        App::getAuth()->register($db, htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']), htmlspecialchars($_POST['email']));
        Session::getInstance()->setFlash('success', 'Un email de confirmation vous a été envoyé pour valider votre compte');
        App::redirect('login.php');
    } else {
    	$errors = $validator->getErrors();
    }
}
?>

<?php require 'inc/header.php'; ?>

<h1>S'inscrire</h1>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    <p>Le formulaire n'a pas été rempli correctement !</p>
    <ul>
	    <?php foreach($errors as $error): ?>
	        <li><?= $error; ?></li>
	    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form action="" method="POST">
	<div class="form-group">
		<label for="">Nom d'utilisateur</label>
		<input type="text" name="username" class="form-control" />
	</div>

	<div class="form-group">
		<label for="">Adresse mail</label>
		<input type="email" name="email" class="form-control" />
	</div>

	<div class="form-group">
		<label for="">Mot de passe</label>
		<input type="password" name="password" class="form-control" />
	</div>

	<div class="form-group">
		<label for="">Confirmer votre mot de passe</label>
		<input type="password" name="password_confirm" class="form-control" />
	</div>

	<button type="submit" class="btn btn-primary">M'inscrire</button>
</form>

<?php require 'inc/footer.php'; ?>
