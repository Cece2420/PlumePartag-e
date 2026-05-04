<?php require_once '../config.php'; ?>

<?php
$message = "";

if (!isset($_SESSION["panier"])) {
    $_SESSION["panier"] = [];
}

/* Ajouter une annonce */
if (isset($_POST["ajouter_annonce"])) {
    if (isset($_SESSION["utilisateur_id"])) {

        $titre = $_POST["titre"];
        $description = $_POST["description"];
        $prix = $_POST["prix"];
        $image = $_FILES["image"]["name"];

        if ($titre != "" && $description != "" && $prix != "" && $image != "") {
            $image = time() . "_" . $image;
            $dossier = "../uploads/annonces/";

            if (!is_dir($dossier)) {
                mkdir($dossier, 0777, true);
            }

            move_uploaded_file($_FILES["image"]["tmp_name"], $dossier . $image);

            $chemin_image = "uploads/annonces/" . $image;

            $sql = "INSERT INTO annonces (titre, description, image, prix, utilisateur_id)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titre, $description, $chemin_image, $prix, $_SESSION["utilisateur_id"]]);

            header("Location: vente.php");
            exit;
        } else {
            $message = "Veuillez remplir tous les champs.";
        }

    } else {
        $message = "Vous devez être connecté pour publier une annonce.";
    }
}

/* Ajouter un article au panier */
if (isset($_POST["ajouter_panier"])) {
    $annonce_id = $_POST["annonce_id"];

    $sql = "SELECT * FROM annonces WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$annonce_id]);
    $annonce = $stmt->fetch();

    if ($annonce) {
        $article = [
            "id" => $annonce["id"],
            "titre" => $annonce["titre"],
            "description" => $annonce["description"],
            "prix" => $annonce["prix"],
            "image" => $annonce["image"],
            "quantite" => 1
        ];

        $_SESSION["panier"][] = $article;

        $message = "L'article a été ajouté au panier.";
    }
}

/* Compter les articles du panier */
$nombre_articles = 0;

foreach ($_SESSION["panier"] as $article) {
    $nombre_articles = $nombre_articles + $article["quantite"];
}

/* Récupérer les annonces */
$sql = "SELECT annonces.*, utilisateurs.pseudo
        FROM annonces
        INNER JOIN utilisateurs ON annonces.utilisateur_id = utilisateurs.id
        ORDER BY annonces.date_creation DESC";

$stmt = $pdo->query($sql);
$annonces = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vente - Plume Partagée</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="page-vente">

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

    <section class="vente-intro">
        <div>
            <h1>Espace vente</h1>
            <p>
                Ici, les utilisateurs peuvent publier des livres à vendre avec une photo,
                un titre, une description et un prix.
            </p>
        </div>

        <div class="panier-resume">
            <p>Panier</p>
            <strong><?php echo $nombre_articles; ?> article(s)</strong>
            <a href="panier.php">Voir le panier</a>
        </div>
    </section>

    <?php if ($message != ""): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="vente-layout">

        <section class="annonces-liste">
            <h2>Livres en vente</h2>

            <?php if (count($annonces) == 0): ?>
                <p>Aucune annonce pour le moment.</p>
            <?php endif; ?>

            <div class="annonces-grid">
                <?php foreach ($annonces as $annonce): ?>
                    <article class="annonce-card">
                        <img src="../<?php echo htmlspecialchars($annonce["image"]); ?>" alt="Image du livre">

                        <div class="annonce-contenu">
                            <h3><?php echo htmlspecialchars($annonce["titre"]); ?></h3>

                            <p class="annonce-info">
                                Posté par <strong><?php echo htmlspecialchars($annonce["pseudo"]); ?></strong>
                                le <?php echo $annonce["date_creation"]; ?>
                            </p>

                            <p><?php echo htmlspecialchars($annonce["description"]); ?></p>

                            <p class="annonce-prix">
                                <?php echo number_format($annonce["prix"], 2, ",", " "); ?> €
                            </p>

                            <form method="POST">
                                <input type="hidden" name="annonce_id" value="<?php echo $annonce["id"]; ?>">
                                <button type="submit" name="ajouter_panier">Ajouter au panier</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <aside class="annonce-formulaire">
            <?php if (isset($_SESSION["utilisateur_id"])): ?>

                <h2>Ajouter une annonce</h2>

                <form method="POST" enctype="multipart/form-data">
                    <label for="titre">Titre du livre</label>
                    <input type="text" id="titre" name="titre" placeholder="Exemple : Demon Slayer Tome 1">

                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Décris l'état du livre, le type d'œuvre, etc."></textarea>

                    <label for="prix">Prix</label>
                    <input type="number" id="prix" name="prix" step="0.01" min="0" placeholder="Exemple : 6.50">

                    <label for="image">Photo du livre</label>
                    <input type="file" id="image" name="image" accept="image/*">

                    <button type="submit" name="ajouter_annonce">Publier l'annonce</button>
                </form>

            <?php else: ?>

                <h2>Ajouter une annonce</h2>
                <p>Vous devez être connecté pour vendre un livre.</p>

                <div class="connexion-buttons">
                    <a href="connecter.php">Se connecter</a>
                    <a href="inscrire.php">Créer un compte</a>
                </div>

            <?php endif; ?>
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