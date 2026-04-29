<?php require_once '../config.php'; ?>

<?php
$message = "";

if (isset($_POST["ajouter_sujet"])) {
    if (isset($_SESSION["utilisateur_id"])) {
        $titre = trim($_POST["titre"]);
        $contenu = trim($_POST["contenu"]);
        $type_oeuvre = $_POST["type_oeuvre"];
        $genre = $_POST["genre"];
        $utilisateur_id = $_SESSION["utilisateur_id"];

        if ($titre != "" && $contenu != "" && $type_oeuvre != "" && $genre != "") {
            $sql = "INSERT INTO sujets (titre, contenu, type_oeuvre, genre, utilisateur_id)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titre, $contenu, $type_oeuvre, $genre, $utilisateur_id]);

            header("Location: forum.php");
            exit;
        } else {
            $message = "Veuillez remplir tous les champs.";
        }
    } else {
        $message = "Vous devez être connecté pour publier.";
    }
}

if (isset($_POST["ajouter_commentaire"])) {
    if (isset($_SESSION["utilisateur_id"])) {
        $contenu_commentaire = trim($_POST["contenu_commentaire"]);
        $sujet_id = $_POST["sujet_id"];
        $utilisateur_id = $_SESSION["utilisateur_id"];

        if ($contenu_commentaire != "") {
            $sql = "INSERT INTO commentaires (contenu, sujet_id, utilisateur_id)
                    VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$contenu_commentaire, $sujet_id, $utilisateur_id]);

            header("Location: forum.php");
            exit;
        } else {
            $message = "Le commentaire ne peut pas être vide.";
        }
    } else {
        $message = "Vous devez être connecté pour répondre.";
    }
}

if (isset($_POST["ajouter_like"])) {
    if (isset($_SESSION["utilisateur_id"])) {
        $sujet_id = $_POST["sujet_id"];
        $utilisateur_id = $_SESSION["utilisateur_id"];

        $sql = "INSERT IGNORE INTO likes (sujet_id, utilisateur_id)
                VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$sujet_id, $utilisateur_id]);

        header("Location: forum.php");
        exit;
    } else {
        $message = "Vous devez être connecté pour liker.";
    }
}

$sql = "SELECT sujets.*, utilisateurs.pseudo,
        COUNT(DISTINCT commentaires.id) AS nombre_reponses,
        COUNT(DISTINCT likes.id) AS nombre_likes
        FROM sujets
        INNER JOIN utilisateurs ON sujets.utilisateur_id = utilisateurs.id
        LEFT JOIN commentaires ON commentaires.sujet_id = sujets.id
        LEFT JOIN likes ON likes.sujet_id = sujets.id
        GROUP BY sujets.id
        ORDER BY sujets.date_creation DESC";

$stmt = $pdo->query($sql);
$sujets = $stmt->fetchAll();

$sql = "SELECT commentaires.*, utilisateurs.pseudo
        FROM commentaires
        INNER JOIN utilisateurs ON commentaires.utilisateur_id = utilisateurs.id
        ORDER BY commentaires.date_creation ASC";

$stmt = $pdo->query($sql);
$commentaires = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Forum - Plume Partagée</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="page-forum">

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

    <div class="forum-layout">

        <div class="forum-left">

            <section class="intro-forum">
                <h1>Forum</h1>
                <p>Pose une question, partage tes lectures et réponds aux autres lecteurs.</p>
            </section>

            <?php if ($message != ""): ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <section class="liste-sujets">
                <h2>Questions récentes</h2>

                <?php if (count($sujets) == 0): ?>
                    <p>Aucune question pour le moment.</p>
                <?php endif; ?>

                <?php foreach ($sujets as $sujet): ?>
                    <article class="sujet">
                        <div class="sujet-top">
                            <div>
                                <h3><?php echo htmlspecialchars($sujet["titre"]); ?></h3>

                                <p class="sujet-info">
                                    Posté par <strong><?php echo htmlspecialchars($sujet["pseudo"]); ?></strong>
                                    • <?php echo htmlspecialchars($sujet["type_oeuvre"]); ?>
                                    • <?php echo htmlspecialchars($sujet["genre"]); ?>
                                    • <?php echo $sujet["date_creation"]; ?>
                                </p>
                            </div>

                            <div class="sujet-stats">
                                <p><?php echo $sujet["nombre_reponses"]; ?> réponses</p>
                                <p><?php echo $sujet["nombre_likes"]; ?> likes</p>
                            </div>
                        </div>

                        <p><?php echo htmlspecialchars($sujet["contenu"]); ?></p>

                        <div class="sujet-actions">
                            <?php if (isset($_SESSION["utilisateur_id"])): ?>
                                <form method="POST">
                                    <input type="hidden" name="sujet_id" value="<?php echo $sujet["id"]; ?>">
                                    <button type="submit" name="ajouter_like">J’aime</button>
                                </form>
                            <?php endif; ?>

                            <button type="button" class="btn-commentaires" data-id="<?php echo $sujet["id"]; ?>">
                                Afficher les commentaires
                            </button>
                        </div>

                        <div class="commentaires-zone" id="commentaires-<?php echo $sujet["id"]; ?>" style="display: none;">
                            <h4>Commentaires</h4>

                            <?php
                            $a_des_commentaires = false;
                            foreach ($commentaires as $commentaire):
                                if ($commentaire["sujet_id"] == $sujet["id"]):
                                    $a_des_commentaires = true;
                            ?>
                                <div class="commentaire">
                                    <p class="sujet-info">
                                        <strong><?php echo htmlspecialchars($commentaire["pseudo"]); ?></strong>
                                        • <?php echo $commentaire["date_creation"]; ?>
                                    </p>
                                    <p><?php echo htmlspecialchars($commentaire["contenu"]); ?></p>
                                </div>
                            <?php
                                endif;
                            endforeach;
                            ?>

                            <?php if (!$a_des_commentaires): ?>
                                <p>Aucun commentaire pour le moment.</p>
                            <?php endif; ?>

                            <?php if (isset($_SESSION["utilisateur_id"])): ?>
                                <form method="POST" class="commentaire-form">
                                    <input type="hidden" name="sujet_id" value="<?php echo $sujet["id"]; ?>">

                                    <label>Ajouter un commentaire</label>
                                    <textarea name="contenu_commentaire" placeholder="Écris ton commentaire..."></textarea>

                                    <p class="message-js"></p>

                                    <button type="submit" name="ajouter_commentaire">Répondre</button>
                                </form>
                            <?php else: ?>
                                <p class="petit-message">Connectez-vous pour répondre.</p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        </div>

        <aside class="forum-right">
            <?php if (isset($_SESSION["utilisateur_id"])): ?>

                <section class="form-section">
                    <h2>Poser une question</h2>

                    <form method="POST" id="formQuestion">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" placeholder="Exemple : Vos webtoons préférés du moment ?">

                        <label for="type_oeuvre">Type d’œuvre</label>
                        <select id="type_oeuvre" name="type_oeuvre">
                            <option value="">Choisir un type</option>
                            <option value="Manga">Manga</option>
                            <option value="Manhwa">Manhwa</option>
                            <option value="Manhua">Manhua</option>
                            <option value="Webtoon">Webtoon</option>
                            <option value="Roman">Roman</option>
                            <option value="Light novel">Light novel</option>
                            <option value="Web novel">Web novel</option>
                            <option value="BD">BD</option>
                            <option value="Comics">Comics</option>
                        </select>

                        <p id="aideType" class="aide-js"></p>

                        <label for="genre">Genre</label>
                        <select id="genre" name="genre">
                            <option value="">Choisir un genre</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Romance">Romance</option>
                            <option value="Thriller">Thriller</option>
                            <option value="Policier">Policier</option>
                            <option value="Horreur">Horreur</option>
                            <option value="Slice of life">Slice of life</option>
                            <option value="School life">School life</option>
                            <option value="Isekai">Isekai</option>
                            <option value="Cultivation">Cultivation</option>
                            <option value="Revenge story">Revenge story</option>
                            <option value="Réincarnation">Réincarnation</option>
                            <option value="Shōnen">Shōnen</option>
                            <option value="Shōjo">Shōjo</option>
                            <option value="Seinen">Seinen</option>
                            <option value="Josei">Josei</option>
                        </select>

                        <label for="contenu">Question</label>
                        <textarea id="contenu" name="contenu" placeholder="Écris ta question ici..."></textarea>

                        <p class="message-js"></p>

                        <button type="submit" name="ajouter_sujet">Publier</button>
                    </form>
                </section>

            <?php else: ?>

                <section class="connexion-info">
                    <h2>Participer</h2>
                    <p>Vous devez être connecté pour poser une question ou répondre à un sujet.</p>

                    <div class="connexion-buttons">
                        <a href="connecter.php">Se connecter</a>
                        <a href="inscrire.php">Créer un compte</a>
                    </div>
                </section>

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

<script src="../script.js"></script>
</body>
</html>