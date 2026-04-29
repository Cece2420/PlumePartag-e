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
            <a href="connecter.php" class="btn-header">Se connecter</a>
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

    <section class="hero-home">
        <div class="hero-text">
            <h1>Bienvenue sur <span>Plume Partagée</span></h1>
            <p>
                Entre dans un espace chaleureux où les livres circulent, les avis se croisent
                et les histoires continuent de vivre. Découvre, partage et échange dans une
                ambiance douce et inspirante aupèrs d'une communauté passionée.
            </p>

            <div class="hero-tags">
                <h2>Nous vous invitons à explorer les différents espaces du site pour tirez le meilleur de votre expérience !</h2>
            </div>

            <div class="hero-mini-stats">
                <div class="mini-stat">
                    <strong>Découvrez</strong>
                    <span>de nouvelles lectures</span>
                </div>
                <div class="mini-stat">
                    <strong>Partagez</strong>
                    <span>ses impressions</span>
                </div>
                <div class="mini-stat">
                    <strong>Échangez</strong>
                    <span>et faire vivre les livres</span>
                </div>
            </div> </br>

        <div class="hero-side">
            <div class="hero-card-large">
                <h3 class="mini-title">Notre devise</h3>
                <p class="hero-quote">
                    “Un lecteur vit mille vies avant de mourir. Celui qui ne lit pas n’en vit qu’une.”
                </p>
            </div>

        </div>
    </section>

    <section class="home-features">
        <div class="feature-card">
            <div class="feature-icon"></div>
            <h2>Trouve ta prochaine lecture</h2>
            <p>
                Parcours des œuvres recommandées, découvre des univers variés
                et laisse-toi surprendre par de nouveaux coups de cœur.
            </p>
            <a href="pages/bibliotheque.php">Découvrir</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon"></div>
            <h2>Partage ton ressenti</h2>
            <p>
                Donne ton avis, note les livres et échange avec d’autres lecteurs
                pour enrichir chaque découverte.
            </p>
            <a href="pages/forum.php">Participer</a>
        </div>

        <div class="feature-card">
            <div class="feature-icon"></div>
            <h2>Offre une seconde vie aux livres</h2>
            <p>
                Vends, échange ou retrouve des ouvrages pour prolonger
                leur histoire entre plusieurs lecteurs.
            </p>
            <a href="pages/vente.php">Voir les annonces</a>
        </div>
    </section>

    <section class="home-highlight">
        <div class="highlight-left">
            <h2>Un cocon pour les amoureux des histoires</h2>
            <p>
                Plume Partagée est pensé comme un lieu calme, inspirant et accueillant.
                Ici, on prend le temps de lire, de discuter, de transmettre ses émotions
                et de créer des passerelles entre lecteurs.
            </p>
        </div>

        <div class="highlight-right">
            <h3>L’esprit du site</h3>
            <div class="point-box">Une ambiance douce et chaleureuse</div>
                <div class="point-box">Des échanges simples et sincères</div>
                <div class="point-box">Des découvertes pour tous les goûts</div>
                <div class="point-box">Une communauté autour des livres</div>
        </div>
    </section>

    <section class="home-bottom-banner">
        <h2>Chaque livre mérite une nouvelle rencontre</h2>
        <p>
            Lis, recommande, commente ou revends : sur Plume Partagée, chaque page peut continuer son voyage.
        </p>
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