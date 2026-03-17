<?php
$page = $_GET['page'] ?? 'accueil';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Plume Partagée - <?php echo ucfirst($page); ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="logo">Plume Partagée</div>
  <a href="connection.php" class="login">Se connecter</a>
</header>

<nav>
  <a href="index.php?page=accueil">Accueil</a>
  <a href="index.php?page=forum">Forum</a>
  <a href="index.php?page=vente">Vente</a>
  <a href="index.php?page=classement">Classement</a>
  <a href="index.php?page=amateur">Amateur</a>
  <a href="index.php?page=bibliotheque">Bibliothèque</a>
  <a href="index.php?page=apropos">À propos de nous</a>
</nav>

<main>
<?php
switch ($page) {
    case 'forum':
        include 'pages/forum.php';
        break;
    case 'vente':
        include 'pages/vente.php';
        break;
    case 'classement':
        include 'pages/classement.php';
        break;
    case 'amateur':
        include 'pages/amateur.php';
        break;
    case 'bibliotheque':
        include 'pages/bibliotheque.php';
        break;
    case 'apropos':
        include 'pages/apropos.php';
        break;
    default:
        include 'pages/accueil.php';
        break;
}
?>
</main>

<footer>
  Aide · Services · L’entreprise · Questions ?
</footer>

</body>
</html>