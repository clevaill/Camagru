<?php

require_once 'inc/bootstrap.php';
$auth = App::getAuth()->restrict();
$db = App::getDatabase();
$session = Session::getInstance();

if (!empty($_POST) && isset($_POST['password'])){
    if (!empty(htmlspecialchars($_POST['password'])) && htmlspecialchars($_POST['password']) != $_POST['password_confirm']){
        $session->setFlash('danger', "Les mots des passes ne correspondent pas");
    } else if (!empty(htmlspecialchars($_POST['password'])) && !preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$#', htmlspecialchars($_POST['password']))) {
    	$session->setFlash('danger', "Le mot de passe n'est pas valide");
    } else if (!empty(htmlspecialchars($_POST['password']))){
        $user_id = $_SESSION['auth']->id;
        $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);
        $db->query('UPDATE users SET password = ? WHERE id = ?', [$password, $user_id]);
        $session->setFlash('success', "Votre mot de passe a bien été mise à jour");
    }
}

if (isset($_POST['username'])) {
	if (!preg_match('/^[a-zA-Z0-9_]+$/', htmlspecialchars($_POST['username']))) {
		$session->setFlash('danger', "Votre nom d'utilisateur n'est pas valide");
	} else {
		$user = $db->query('SELECT id FROM users WHERE username = ?', [htmlspecialchars($_POST['username'])])->fetch(); 
		if ($user) {
			$session->setFlash('danger', "Ce nom d'utilisateur est déjà pris");
		} else if (!empty(htmlspecialchars($_POST['username']))) {
			$user_id = $_SESSION['auth']->id;
			$db->query('UPDATE users SET username = ? WHERE id = ?', [htmlspecialchars($_POST['username']), $user_id]);
			$session->setFlash('success', "Votre nom d'utilisateur a bien été changé");
			$_SESSION['auth']->username = htmlspecialchars($_POST['username']);
		}
	}
}

if (isset($_POST['email'])) {
	$email = filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL);
	if ($email) {
		$user = $db->query('SELECT id FROM users WHERE email = ?', [htmlspecialchars($_POST['email'])])->fetch();
		if ($user) {
			$session->setFlash('danger', "Cette email est déjà pris");
		} else {
			$user_id = $_SESSION['auth']->id;
			$db->query('UPDATE users SET email = ? WHERE id = ?', [htmlspecialchars($_POST['email']), $user_id]);
			$session->setFlash('success', "Votre adresse mail est a été changée");
		}
	}
}

require 'inc/header.php'
?>

	<h1>Votre compte <?= $_SESSION['auth']->username; ?></h1>
</br>
	<form action="" method="post">
		<h3>Changement de votre mot de passe</h3>
		<div class="form-group">
			<input class="form-control" type="password" name="password" placeholder="Changement de mot de passe">
		</div>
		<div class="form-group">
			<input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe">
		</div>
		<button class="btn btn-primary">Valider</button>
	</form>
	
	<form action="" method="post">
		<h3>Changement de votre nom d'utilisateur</h3>

		<div class="form-group">
			<input class="form-control" type="text" name="username" placeholder="Changement de nom d'utilisateur">
		</div>

		<button class="btn btn-primary">Valider</button>
	</form>

	<form action="" method="post">
		<h3>Changement de votre adresse mail</h3>

		<div class="form-group">
			<input class="form-control" type="email" name="email" placeholder="Changement de l'adresse mail">
		</div>

		<button class="btn btn-primary">Valider</button>
	</form>

<?php require 'inc/footer.php'; ?>
