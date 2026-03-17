<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Plume Partagée - Accueil</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <div class="logo">Plume Partagée</div>
  <a href="connection.php" class="login">Connexion</a>
</header>

<nav>
  <a href="index.html">Accueil</a>
  <a href="forum.html">Forum</a>
  <a href="vente.html">Vente</a>
  <a href="classement.html">Classement</a>
  <a href="amateur.html">Amateur</a>
  <a href="bibliotheque.html">Bibliothèque</a>
  <a href="profil.html">Mon Profil</a>
</nav>

<main>
    <h1>Créer un compte</h1>
    <form>
        <label id="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo">
        <label id="email">Email :</label>
        <input type="email" id="email" name="email">
        <label id="password">Mot de passe :</label>
        <input type="password" id="password" name="password">
        <button type="submit">OK</button>
    </form>
    <p>Vous avez déjà un compte ? <a href="connection.html">Ici</a></p>
</main>

<footer>
  Aide · Services · L’entreprise · Questions ?
</footer>

</body>
</html>