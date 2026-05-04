<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plume Partagée - L'Entreprise</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="page-entreprise">

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
    <a href="classement.php">Classement</a>
    <a href="bibliotheque.php">Bibliothèque</a>
    <a href="entreprise.php">Entreprise</a>
</nav>

<main class="main">

    <section id="entreprise" class="about-plume">
        <h2>Plume Partagée : Qui sommes-nous ?</h2>

        <div class="about-grid">

            <div class="about-card">
                <h3>Notre conviction</h3>
                <h4>La culture doit être accessible à tous !</h4>
                <p>
                    Aujourd’hui, le prix des livres neufs et la profusion des sorties ne cessent de s’accentuer.
                    Chaque lecteur est passionné, mais il peut hésiter à découvrir de nouveaux genres à cause du coût
                    ou de l’encombrement de ses étagères.
                </p>
            </div>

            <div class="about-card">
                <h3>Notre mission</h3>
                <h4>Décrypter et partager</h4>
                <p>
                    Notre rôle est de suivre les tendances littéraires, de dénicher des œuvres intéressantes
                    et de créer des outils comme le classement et la bibliothèque pour guider les lecteurs.
                </p>
                <p>
                    Nous accompagnons les utilisateurs vers une consommation plus responsable :
                    moins de gaspillage, plus de partage.
                </p>
            </div>

            <div class="about-card">
                <h3>Notre particularité</h3>
                <h4>La circularité passionnée</h4>
                <p>
                    Il ne s’agit pas seulement de vendre un livre, mais de lui donner une seconde vie.
                    Un livre qui circule est un livre qui continue à vivre.
                </p>
            </div>

            <div class="about-card">
                <h3>Notre force</h3>
                <h4>L’innovation communautaire</h4>
                <p>
                    Nous voulons faciliter la mise en relation entre lecteurs grâce à un site simple :
                    forum, annonces, panier, bibliothèque et classement.
                </p>
            </div>

        </div>
    </section>

    <hr class="separator">

    <section id="aide" class="help-section">
        <div class="help-intro">
            <h2>Besoin d'un coup de plume ?</h2>
            <p>Découvrez nos guides pour mieux utiliser le site.</p>
        </div>

        <div class="help-grid">

            <div class="help-card">
                <div class="help-icon"></div>
                <h3>Acheter un livre</h3>
                <p>
                    Consultez les annonces disponibles, choisissez un livre et ajoutez-le au panier.
                </p>
                <a href="vente.php" class="help-link">Voir les annonces →</a>
            </div>

            <div class="help-card">
                <div class="help-icon"></div>
                <h3>Vendre vos livres</h3>
                <p>
                    Un utilisateur connecté peut publier une annonce avec un titre, une description,
                    un prix et une image.
                </p>
                <a href="vente.php" class="help-link">Vendre un livre →</a>
            </div>

            <div class="help-card">
                <div class="help-icon"></div>
                <h3>Participer au forum</h3>
                <p>
                    Le forum permet de poser une question, commenter les sujets et échanger autour des lectures.
                </p>
                <a href="forum.php" class="help-link">Aller au forum →</a>
            </div>

        </div>
    </section>

    <hr class="separator">

    <section id="questions" class="faq-section">

        <div class="faq-hero">
            <h2>Comment pouvons-nous vous aider ?</h2>

            <div class="faq-tags">
                Exemples :
                <span class="faq-tag">Compte</span>
                <span class="faq-tag">Annonce</span>
                <span class="faq-tag">Panier</span>
            </div>
        </div>

        <div class="faq-list-container">
            <h3>Questions fréquentes</h3>

            <div class="faq-card">
                <div class="faq-question">
                    Faut-il créer un compte pour publier une annonce ?
                    <span class="faq-icon">❯</span>
                </div>
                <div class="faq-answer">
                    <p>
                        Oui, il faut être connecté pour publier une annonce ou participer au forum.
                    </p>
                </div>
            </div>

            <div class="faq-card">
                <div class="faq-question">
                    Comment ajouter un livre au panier ?
                    <span class="faq-icon">❯</span>
                </div>
                <div class="faq-answer">
                    <p>
                        Depuis la page Vente, il suffit de cliquer sur le bouton “Ajouter au panier”.
                    </p>
                </div>
            </div>

            <div class="faq-card">
                <div class="faq-question">
                    Le paiement est-il déjà fonctionnel ?
                    <span class="faq-icon">❯</span>
                </div>
                <div class="faq-answer">
                    <p>
                        Non, le paiement n’est pas encore finalisé. C’est une amélioration possible du projet.
                    </p>
                </div>
            </div>

        </div>
    </section>

</main>

<footer class="footer">
    <a href="#aide">Aide</a>
    <a href="#entreprise">L’entreprise</a>
    <a href="#questions">Questions?</a>
</footer>

</body>
</html>