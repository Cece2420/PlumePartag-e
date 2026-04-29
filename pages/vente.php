<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plume Partagée - Vente</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <header class="header">
        <div class="logo">
            <a href="../index.php">Plume Partagée</a>
        </div>

        <div class="header-buttons">
            <a href="../comptes/connecter.php" class="btn-header">Se connecter</a>
        </div>
    </header>

    <nav class="navbar">
        <a href="../index.php">Accueil</a>
        <a href="forum.php">Forum</a>
        <a href="vente.php">Vente</a>
        <a href="classement.php">Classement</a>
        <a href="bibliotheque.php">Bibliothèque</a>
        <a href="entreprise.php">À propos de nous</a>
    </nav>

    <main class="main-content">

        <section class="welcome-box">
            <h1>Espace de vente 🛍️</h1>
            <p>
                Cet espace permet aux utilisateurs de vendre ou d’acheter des livres
                d’occasion. Chaque annonce présente les informations essentielles sur
                l’ouvrage, son état et son vendeur.
            </p>
        </section>

        <section class="sale-toolbar">
            <div class="sale-filter">Romans</div>
            <div class="sale-filter">Mangas</div>
            <div class="sale-filter">Webtoons</div>
            <div class="sale-filter">Fantasy</div>
            <div class="sale-filter">Romance</div>
            <div class="sale-filter">Thriller</div>
        </section>

        <section class="sale-grid">
            <article class="sale-card">
                <div class="sale-cover">Couverture</div>
                <h2>Le pacte des ombres</h2>
                <p class="sale-author">Auteur : Claire Martin</p>
                <p class="sale-price">Prix : 7,50 €</p>
                <p class="sale-description">
                    Roman en très bon état, lu une seule fois. Idéal pour les amateurs
                    de mystère et de fantastique.
                </p>
                <div class="sale-info">
                    <p>Vendeur : Lina92</p>
                    <p>État : Très bon état</p>
                    <p>Mise en ligne : aujourd’hui</p>
                </div>
            </article>

            <article class="sale-card">
                <div class="sale-cover">Couverture</div>
                <h2>Les jours d’automne</h2>
                <p class="sale-author">Auteur : Julien Morel</p>
                <p class="sale-price">Prix : 5,00 €</p>
                <p class="sale-description">
                    Livre d’occasion avec quelques traces d’usage, mais reste en bon état.
                    Histoire touchante et agréable à lire.
                </p>
                <div class="sale-info">
                    <p>Vendeur : EmmaReads</p>
                    <p>État : Bon état</p>
                    <p>Mise en ligne : hier</p>
                </div>
            </article>

            <article class="sale-card">
                <div class="sale-cover">Couverture</div>
                <h2>Éclats de lune</h2>
                <p class="sale-author">Auteur : Sarah Noé</p>
                <p class="sale-price">Prix : 9,00 €</p>
                <p class="sale-description">
                    Roman récent, couverture propre, pages intactes. Convient parfaitement
                    pour une lecture légère et captivante.
                </p>
                <div class="sale-info">
                    <p>Vendeur : NoahBook</p>
                    <p>État : Comme neuf</p>
                    <p>Mise en ligne : il y a 2 jours</p>
                </div>
            </article>
        </section>

        <section class="highlight-box">
            <div class="highlight-text">
                <h2>Une seconde vie pour les livres</h2>
                <p>
                    Grâce à cet espace, les utilisateurs peuvent revendre leurs ouvrages,
                    découvrir de nouvelles lectures et participer à une consommation plus
                    responsable autour du livre.
                </p>
            </div>

            <div class="highlight-side">
                <h3>📚 Avantages</h3>
                <p>Prix accessibles</p>
                <p>Choix varié</p>
                <p>Échange entre lecteurs</p>
                <p>Réutilisation des livres</p>
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