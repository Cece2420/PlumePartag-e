<?php require_once '../config.php'; ?>

<?php
$favoris = [];
$message = "";

/* Retirer un favori */
if (isset($_POST["retirer_favori"]) && isset($_SESSION["utilisateur_id"])) {
    $favori_id = $_POST["favori_id"];
    $utilisateur_id = $_SESSION["utilisateur_id"];

    $sql = "DELETE FROM favoris 
            WHERE id = ? AND utilisateur_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$favori_id, $utilisateur_id]);

    $message = "Livre retiré de votre bibliothèque.";
}

/* Récupérer les favoris de l'utilisateur connecté */
if (isset($_SESSION["utilisateur_id"])) {
    $utilisateur_id = $_SESSION["utilisateur_id"];

    $sql = "SELECT favoris.id AS favori_id,
                   favoris.date_ajout,
                   annonces.titre,
                   annonces.description,
                   annonces.image,
                   annonces.prix
            FROM favoris
            INNER JOIN annonces ON favoris.annonce_id = annonces.id
            WHERE favoris.utilisateur_id = ?
            ORDER BY favoris.date_ajout DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$utilisateur_id]);
    $favoris = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bibliothèque - Plume Partagée</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="page-bibliotheque">

<header class="header">
    <div class="logo">
        <a href="../index.php">Plume Partagée</a>
    </div>

    <div class="header-buttons">
        <?php if (isset($_SESSION["pseudo"])): ?>
            <span class="user-name">
                Bonjour <?php echo htmlspecialchars($_SESSION["pseudo"]); ?>
            </span>
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
    <a href="entreprise.php">À propos de nous</a>
</nav>

<main class="main">

    <section class="bibliotheque-intro">
        <h1>Ma Bibliothèque 📚</h1>
        <p>
            Retrouvez ici les livres que vous avez ajoutés à vos favoris depuis la page Vente.
        </p>
    </section>

    <?php if ($message != ""): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <section class="bibliotheque-section">
        <h2>Mes favoris ❤️</h2>

        <?php if (!isset($_SESSION["utilisateur_id"])): ?>

            <p>Vous devez être connecté pour voir votre bibliothèque.</p>
            <a href="connecter.php" class="btn-voir">Se connecter</a>

        <?php elseif (count($favoris) == 0): ?>

            <p class="bibli-vide">
                Votre bibliothèque est vide pour l’instant.
            </p>
            <a href="vente.php" class="btn-voir">Voir les livres en vente</a>

        <?php else: ?>

            <div class="bibli-grid">

                <?php foreach ($favoris as $favori): ?>
                    <article class="book-card-fav">

                        <img 
                            src="../<?php echo htmlspecialchars($favori["image"]); ?>" 
                            alt="Image du livre"
                            class="book-cover-mini"
                        >

                        <div class="book-details">
                            <h3><?php echo htmlspecialchars($favori["titre"]); ?></h3>

                            <p>
                                <?php echo htmlspecialchars($favori["description"]); ?>
                            </p>

                            <p>
                                <strong>
                                    <?php echo number_format($favori["prix"], 2, ",", " "); ?> €
                                </strong>
                            </p>

                            <form method="POST">
                                <input 
                                    type="hidden" 
                                    name="favori_id" 
                                    value="<?php echo $favori["favori_id"]; ?>"
                                >

                                <button type="submit" name="retirer_favori" class="btn-retirer">
                                    Retirer
                                </button>
                            </form>
                        </div>

                    </article>
                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </section>

    <section class="bibliotheque-section">
        <h2>Suggestions pour vous ✨</h2>

        <div class="suggest-container">

            <article class="suggest-card">
                <div class="suggest-emoji">🏮</div>
                <h3>Le Voyage de Chihiro</h3>
                <p>Une œuvre poétique pour les amateurs d’univers japonais.</p>
                <a href="forum.php" class="btn-voir">En discuter</a>
            </article>

            <article class="suggest-card">
                <div class="suggest-emoji">🏰</div>
                <h3>Le Château de Hurle</h3>
                <p>Une recommandation idéale pour les lecteurs qui aiment la fantasy.</p>
                <a href="forum.php" class="btn-voir">En discuter</a>
            </article>

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