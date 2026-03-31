<?php
$page = $_GET['page'] ?? 'accueil';

$pages_autorisees = ['accueil', 'forum', 'connexion', 'classement', 'bibliotheque'];

if (!in_array($page, $pages_autorisees)) {
    $page = 'accueil';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plume Partagée</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="logo">Plume Partagée</div>
        <a href="index.php?page=connexion" class="btn-connexion">Se connecter</a>
    </header>

    <nav>
        <a href="index.php?page=accueil">Accueil</a>
        <a href="index.php?page=forum">Forum</a>
        <a href="#">Vente</a>
        <a href="index.php?page=classement">Classement</a>
        <a href="#">Amateur</a>
        <a href="index.php?page=bibliotheque">Bibliothèque</a>
        <a href="#">À propos de nous</a>
    </nav>

    <main>
        <?php include "pages/$page.php"; ?>
    </main>

    <footer>
        <a href="#">Aide</a>
        <a href="#">Services</a>
        <a href="#">L’entreprise</a>
        <a href="#">Questions ?</a>
    </footer>

</body>
</html>