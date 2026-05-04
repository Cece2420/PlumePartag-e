<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plume Partagée - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <a href="index.php">Plume Partagée</a>
    </div>

    <div class="header-buttons">
        <?php if (isset($_SESSION["pseudo"])): ?>
            <span class="user-name">Bonjour <?php echo htmlspecialchars($_SESSION["pseudo"]); ?></span>
            <a href="pages/deconnexion.php" class="btn-header">Déconnexion</a>
        <?php else: ?>
            <a href="pages/connecter.php" class="btn-header">Se connecter</a>
        <?php endif; ?>
    </div>
</header>

<nav class="navbar">
    <a href="index.php">Accueil</a>
    <a href="pages/forum.php">Forum</a>
    <a href="pages/vente.php">Vente</a>
    <a href="pages/classement.php">Classement</a>
    <a href="pages/bibliotheque.php">Bibliothèque</a>
    <a href="pages/entreprise.php">À propos de nous</a>
</nav>

<main class="main">

    <section class="hero-accueil">
        <div class="hero-texte">
            <p class="badge-accueil">Communauté de lecteurs</p>

            <h1>Bienvenue sur <span>Plume Partagée</span></h1>

            <p>
                Un espace pour découvrir des livres, partager ses coups de cœur,
                vendre ses ouvrages et échanger avec d’autres passionnés.
            </p>

            <div class="hero-boutons">
                <a href="pages/vente.php">Voir les livres</a>
                <a href="pages/forum.php" class="bouton-secondaire">Aller au forum</a>
            </div>
        </div>

        <div class="hero-carte">
            <div class="emoji">☀︎</div>
            <h2>Lire, partager, transmettre</h2>
            <p>Chaque livre peut continuer son histoire avec un nouveau lecteur.</p>
        </div>
    </section>

    <section class="accueil-actions">
        <article class="action-card">
            <span>01</span>
            <h2>Découvrir</h2>
            <p>Consulte les annonces et trouve ta prochaine lecture.</p>
        </article>

        <article class="action-card">
            <span>02</span>
            <h2>Échanger</h2>
            <p>Pose des questions et partage tes avis sur le forum.</p>
        </article>

        <article class="action-card">
            <span>03</span>
            <h2>Revendre</h2>
            <p>Publie une annonce pour donner une seconde vie à tes livres.</p>
        </article>
    </section>

    <section class="accueil-ambiance">
        <div>
            <h2>Pourquoi Plume Partagée ?</h2>
            <p>
                Le site a été pensé comme une plateforme simple et chaleureuse.
                Il permet aux lecteurs de se retrouver autour d’une passion commune :
                les livres, les histoires et les découvertes.
            </p>
        </div>

        <div class="ambiance-liste">
            <p>Une ambiance douce</p>
            <p>Des échanges entre lecteurs</p>
            <p>Des livres à vendre</p>
            <p>Des favoris à conserver</p>
        </div>
    </section>

</main>

<footer class="footer">
    <a href="pages/entreprise.php#aide">Aide</a>
    <a href="pages/entreprise.php#services">Services</a>
    <a href="pages/entreprise.php#entreprise">L’entreprise</a>
    <a href="pages/entreprise.php#questions">Questions?</a>
</footer>

</body>
</html>