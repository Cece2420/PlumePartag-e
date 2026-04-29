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
            <a href="comptes/connecter.php" class="btn-header">Se connecter</a>
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

    <main class="main-content">

    <section class="welcome-box">
        <h1>Bienvenue sur Plume Partagée ✨</h1>
        <p>
            Installe-toi confortablement et laisse-toi emporter dans un univers
            dédié aux livres et aux histoires. Ici, chaque lecteur peut partager
            ses découvertes, ses émotions et ses coups de cœur.
        </p>
    </section>

    <section class="cards-section">
        <div class="card">
            <h2>📚 Trouve ta prochaine lecture</h2>
            <p>
                Parcours des œuvres recommandées et découvre des livres qui
                correspondent à ton univers.
            </p>
        </div>

        <div class="card">
            <h2>⭐ Partage ton ressenti</h2>
            <p>
                Donne ton avis, note les livres et aide les autres lecteurs à
                choisir leur prochaine lecture.
            </p>
        </div>

        <div class="card">
            <h2>🛍️ Donne une seconde vie aux livres</h2>
            <p>
                Échange, vends ou trouve des ouvrages pour continuer à faire vivre
                les histoires.
            </p>
        </div>
    </section>

    <section class="quote-box">
        <p>
            “Un lecteur vit mille vies avant de mourir. Celui qui ne lit pas n’en vit qu’une.”
        </p>
    </section>

    <section class="highlight-box">
        <div class="highlight-text">
            <h2>Un espace cosy pour lire et échanger</h2>
            <p>
                Plume Partagée est pensé comme un endroit calme et chaleureux,
                où l’on peut découvrir de nouvelles histoires, partager ses impressions
                et profiter d’un moment de lecture dans une ambiance douce.
            </p>
        </div>

        <div class="highlight-side">
            <h3>❤️ L’esprit du site</h3>
            <p>Découvrir</p>
            <p>Partager</p>
            <p>Échanger</p>
            <p>Profiter</p>
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