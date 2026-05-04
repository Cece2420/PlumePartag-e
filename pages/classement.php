<?php require_once '../config.php'; ?>
 
<?php
$sql = "SELECT genre, COUNT(*) AS nombre_sujets
        FROM sujets
        GROUP BY genre
        ORDER BY nombre_sujets DESC
        LIMIT 5";
 
$stmt = $pdo->query($sql);
$genres = $stmt->fetchAll();
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Top genres - Plume Partagée</title>
<link rel="stylesheet" href="../style.css">
</head>
 
<body class="page-classement">
 
<header class="header">
<div class="logo">
<a href="../index.php">Plume Partagée</a>
</div>
 
    <div class="header-buttons">
<?php if (isset($_SESSION["pseudo"])): ?>
<span class="user-name">Bonjour <?php echo htmlspecialchars($_SESSION["pseudo"]); ?></span>
<a href="deconnexion.php" class="btn-header">Déconnexion</a>
<?php else: ?>
<a href="connecter.php" class="btn-header">Se connecter</a>
<?php endif; ?>
</div>
</header>
 
<nav class="navbar">
<a href="../index.php">Accueil</a>
<a href="forum.php">Forum</a>
<a href="vente.php">Vente</a>
<a href="classement.php">Top genres</a>
<a href="bibliotheque.php">Bibliothèque</a>
<a href="entreprise.php">À propos de nous</a>
</nav>
 
<main class="main">
 
    <section class="classement-intro">
<h1>Top genres</h1>
<p>
            Cette page affiche les genres les plus populaires du forum.
            Le classement est généré automatiquement à partir des sujets publiés par les utilisateurs.
</p>
</section>
 
    <section class="top-genres">
 
        <?php if (count($genres) == 0): ?>
 
            <div class="classement-vide">
<p>Aucun genre n’est encore disponible.</p>
<p>Le classement apparaîtra lorsque des sujets seront publiés sur le forum.</p>
<a href="forum.php">Publier un sujet</a>
</div>
 
        <?php else: ?>
 
            <?php $rang = 1; ?>
<?php foreach ($genres as $genre): ?>
<article class="genre-card <?php if ($rang == 1) echo 'premier'; ?>">
<div class="rang"><?php echo $rang; ?></div>
 
                    <div>
<h2><?php echo htmlspecialchars($genre["genre"]); ?></h2>
 
                        <p>
                            Ce genre apparaît dans
<strong><?php echo $genre["nombre_sujets"]; ?></strong>
                            sujet(s) du forum.
</p>
 
                        <?php if ($rang == 1): ?>
<p class="genre-populaire">
                                C’est actuellement le genre le plus populaire de la communauté.
</p>
<?php endif; ?>
</div>
</article>
 
                <?php $rang++; ?>
<?php endforeach; ?>
 
        <?php endif; ?>
 
    </section>
 
    <section class="classement-info">
<h2>Comment le classement est-il calculé ?</h2>
<p>
            Le site compte automatiquement le nombre de sujets publiés pour chaque genre.
            Plus un genre est utilisé dans le forum, plus il monte dans le classement.
</p>
 
        <div class="classement-buttons">
<a href="forum.php">Participer au forum</a>
<a href="vente.php">Voir les livres en vente</a>
</div>
</section>
 
</main>
 
<footer class="footer">
<a href="entreprise.php#aide">Aide</a>
<a href="entreprise.php#services">Services</a>
<a href="entreprise.php#entreprise">L’entreprise</a>
<a href="entreprise.php#questions">Questions?</a>
</footer>
 
</body>
</html>