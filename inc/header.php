<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Camagru</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
  </head>
  
<body>
   <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Camagru</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php
                if(!isset($_SESSION['auth'])){
                    // ... 
                }else{
                ?>
                    <li><a href="account.php">Profile</a></li>
                    <li><a href="camera.php">Caméra</a></li>
                <?php
                } 
            ?>
        </ul>
        <ul class="nav navbar-nav">
            <?php
                if(!isset($_SESSION['auth'])){
                ?>
                    <li><a href="register.php">Inscription</a></li>
                    <li><a href="login.php">Connexion</a></li>
                <?php
                }else{
                ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php
                } 
            ?>
        </ul>
        </div>
      </div>
    </nav>
    <div class="container">
        <?php if (Session::getInstance()->hasFlashes()): ?>
            <?php foreach (Session::getInstance()->getFlashes() as $type => $message ): ?>
                <div class="alert alert-<?= $type; ?>" >
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>


