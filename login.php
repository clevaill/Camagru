<?php

require_once 'inc/bootstrap.php';

$auth = App::getAuth();
$db = App::getDatabase();
$session = Session::getInstance();
$auth->connectFromCookie($db);

if ($auth->user()){
    App::redirect("account.php");
}

if (!empty($_POST) && !empty(htmlspecialchars($_POST['username'])) && !empty(htmlspecialchars($_POST['password']))){
    $user = $auth->login($db, htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']), isset($_POST['remember']));

    if ($user) {
        $session->setFlash('success', 'Connexion effectuée');
        App::redirect('account.php');
        exit();
    } else {
        $session->setFlash('danger', 'Identifiant ou mot de passe incorrect');
    }
}
?>

<?php require 'inc/header.php'; ?>

	<h1>Se connecter</h1>

	<form action="" method="POST">
	<div class="form-group">
		<label for="">Nom d'utilisaeur ou email</label>
		<input type="text" name="username" class="form-control" />
	</div>

	<div class="form-group">
		<label for="">Mot de passe <a href="forget.php">(mot de passe oublié ?)</a></label>
		<input type="password" name="password" class="form-control" />
	</div>

	<div class="form-group">
		<label>
			<input type="checkbox" name="remember" value="1" />Se souvenir de moi
		</label>	
	</div>

	<button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php require 'inc/footer.php'; ?>