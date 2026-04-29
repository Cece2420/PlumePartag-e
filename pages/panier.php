<?php require_once '../config.php'; ?>

<?php
if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = [];
}

$message = "";

if (isset($_POST["supprimer_article"])) {
    $index = $_POST["index"];

    if (isset($_SESSION["panier"][$index])) {
        unset($_SESSION["panier"][$index]);
        $_SESSION["panier"] = array_values($_SESSION["panier"]);
        $message = "Article retiré du panier.";
    }
}

$sous_total = 0;

foreach ($_SESSION["panier"] as $article) {
    $sous_total = $sous_total + ($article["prix"] * $article["quantite"]);
}

$livraison = 2.50;

if (count($_SESSION["panier"]) == 0) {
    $livraison = 0;
}

$total = $sous_total + $livraison;
$nombre_articles = count($_SESSION["panier"]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Plume Partagée - Mon Panier</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="page-panier">

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
    <a href="entreprise.php">À propos de nous</a>
</nav>

<main class="main">

    <h1 class="panier-titre">Mon panier</h1>

    <?php if ($message != ""): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="panier-layout">

        <section class="panier-articles">

            <?php if (count($_SESSION["panier"]) == 0): ?>

                <div class="panier-vide">
                    <div class="panier-icone">📚</div>
                    <p>Ton panier est vide pour l’instant.</p>
                    <a href="vente.php">Parcourir les annonces</a>
                </div>

            <?php else: ?>

                <?php foreach ($_SESSION["panier"] as $index => $article): ?>
                    <article class="panier-item">

                        <img
                            class="panier-item-image"
                            src="../<?php echo htmlspecialchars($article["image"]); ?>"
                            alt="Image du livre"
                        >

                        <div class="panier-item-info">
                            <h3><?php echo htmlspecialchars($article["titre"]); ?></h3>

                            <p class="item-description">
                                <?php echo htmlspecialchars($article["description"]); ?>
                            </p>

                            <p class="item-vendeur">
                                Quantité : <strong><?php echo $article["quantite"]; ?></strong>
                            </p>
                        </div>

                        <div class="panier-item-right">
                            <span class="item-prix">
                                <?php echo number_format($article["prix"], 2, ",", " "); ?> €
                            </span>

                            <form method="POST">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" name="supprimer_article" class="btn-supprimer">
                                    Retirer
                                </button>
                            </form>
                        </div>

                    </article>
                <?php endforeach; ?>

            <?php endif; ?>

        </section>

        <aside class="panier-recap">
            <div class="recap-box">
                <h2>Récapitulatif</h2>

                <div class="recap-ligne">
                    <span><?php echo $nombre_articles; ?> article(s)</span>
                    <span><?php echo number_format($sous_total, 2, ",", " "); ?> €</span>
                </div>

                <div class="recap-ligne">
                    <span>Livraison</span>
                    <span><?php echo number_format($livraison, 2, ",", " "); ?> €</span>
                </div>

                <div class="recap-ligne total">
                    <span>Total</span>
                    <span><?php echo number_format($total, 2, ",", " "); ?> €</span>
                </div>

                <button class="btn-commander" type="button">
                    Passer la commande
                </button>

                <a href="vente.php" class="btn-continuer">Continuer mes achats</a>
            </div>
        </aside>

    </div>

</main>

<footer class="footer">
    <a href="entreprise.php#aide">Aide</a>
    <a href="entreprise.php#services">Services</a>
    <a href="entreprise.php#entreprise">L’entreprise</a>
    <a href="entreprise.php#questions">Questions?</a>
</footer>

</body>
</html>