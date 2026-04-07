<?php
require_once '../config.php';

/* Ajouter un commentaire */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenu = trim($_POST['contenu'] ?? '');
    $id_sujet = $_POST['id_sujet'] ?? '';
    $id_utilisateur = $_POST['id_utilisateur'] ?? '';

    if ($contenu !== '' && $id_sujet !== '' && $id_utilisateur !== '') {
        $sqlInsert = "INSERT INTO reponse_forum (contenu, date_reponse, id_sujet, id_utilisateur)
                      VALUES (:contenu, NOW(), :id_sujet, :id_utilisateur)";
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([
            'contenu' => $contenu,
            'id_sujet' => $id_sujet,
            'id_utilisateur' => $id_utilisateur
        ]);
    }

    header('Location: forum.php');
    exit;
}

/* Récupérer les utilisateurs pour le formulaire */
$sqlUtilisateurs = "SELECT id_utilisateur, pseudo FROM utilisateur ORDER BY pseudo";
$utilisateurs = $pdo->query($sqlUtilisateurs)->fetchAll(PDO::FETCH_ASSOC);

/* Récupérer les sujets */
$sqlSujets = "
    SELECT 
        s.id_sujet,
        s.titre,
        s.contenu,
        s.categorie_forum,
        s.date_publication,
        s.nb_vues,
        u.pseudo,
        COUNT(r.id_reponse) AS nb_reponses
    FROM sujet_forum s
    JOIN utilisateur u ON s.id_utilisateur = u.id_utilisateur
    LEFT JOIN reponse_forum r ON s.id_sujet = r.id_sujet
    GROUP BY s.id_sujet, s.titre, s.contenu, s.categorie_forum, s.date_publication, s.nb_vues, u.pseudo
    ORDER BY s.date_publication DESC
";
$sujets = $pdo->query($sqlSujets)->fetchAll(PDO::FETCH_ASSOC);

/* Récupérer toutes les réponses */
$sqlReponses = "
    SELECT 
        r.id_reponse,
        r.contenu,
        r.date_reponse,
        r.id_sujet,
        u.pseudo
    FROM reponse_forum r
    JOIN utilisateur u ON r.id_utilisateur = u.id_utilisateur
    ORDER BY r.date_reponse ASC
";
$reponses = $pdo->query($sqlReponses)->fetchAll(PDO::FETCH_ASSOC);

/* Ranger les réponses par sujet */
$reponsesParSujet = [];

foreach ($reponses as $reponse) {
    $reponsesParSujet[$reponse['id_sujet']][] = $reponse;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plume Partagée - Forum</title>
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
            <h1>Forum des lecteurs 💬</h1>
            <p>
                Dans cet espace, les utilisateurs peuvent échanger entre eux,
                poser des questions, partager leurs impressions et commenter les sujets déjà publiés.
            </p>
        </section>

        <section class="forum-toolbar">
            <div class="forum-category">Discussions récentes</div>
            <a href="#" class="forum-button">Créer un sujet</a>
        </section>

        <section class="forum-list">
            <?php foreach ($sujets as $sujet) { ?>
                <article class="forum-topic forum-topic-full">
                    <div class="forum-topic-left">
                        <h2><?php echo htmlspecialchars($sujet['titre']); ?></h2>
                        <p class="forum-meta">
                            Posté par <strong><?php echo htmlspecialchars($sujet['pseudo']); ?></strong>
                            • <?php echo htmlspecialchars($sujet['categorie_forum']); ?>
                            • <?php echo htmlspecialchars($sujet['date_publication']); ?>
                        </p>
                        <p><?php echo htmlspecialchars($sujet['contenu']); ?></p>
                    </div>

                    <div class="forum-topic-right">
                        <p><strong><?php echo $sujet['nb_reponses']; ?></strong> réponses</p>
                        <p><strong><?php echo $sujet['nb_vues']; ?></strong> vues</p>
                    </div>
                </article>

                <section class="comments-box">
                    <h3>Commentaires</h3>

                    <?php if (!empty($reponsesParSujet[$sujet['id_sujet']])) { ?>
                        <?php foreach ($reponsesParSujet[$sujet['id_sujet']] as $reponse) { ?>
                            <div class="comment-item">
                                <p class="comment-meta">
                                    <strong><?php echo htmlspecialchars($reponse['pseudo']); ?></strong>
                                    • <?php echo htmlspecialchars($reponse['date_reponse']); ?>
                                </p>
                                <p><?php echo htmlspecialchars($reponse['contenu']); ?></p>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="no-comment">Aucun commentaire pour le moment.</p>
                    <?php } ?>

                    <form action="forum.php" method="post" class="comment-form">
                        <input type="hidden" name="id_sujet" value="<?php echo $sujet['id_sujet']; ?>">

                        <label for="id_utilisateur_<?php echo $sujet['id_sujet']; ?>">Utilisateur</label>
                        <select name="id_utilisateur" id="id_utilisateur_<?php echo $sujet['id_sujet']; ?>" required>
                            <option value="">Choisir un utilisateur</option>
                            <?php foreach ($utilisateurs as $utilisateur) { ?>
                                <option value="<?php echo $utilisateur['id_utilisateur']; ?>">
                                    <?php echo htmlspecialchars($utilisateur['pseudo']); ?>
                                </option>
                            <?php } ?>
                        </select>

                        <label for="contenu_<?php echo $sujet['id_sujet']; ?>">Ajouter un commentaire</label>
                        <textarea name="contenu" id="contenu_<?php echo $sujet['id_sujet']; ?>" rows="4" required></textarea>

                        <button type="submit" class="forum-button">Publier</button>
                    </form>
                </section>
            <?php } ?>
        </section>

        <section class="highlight-box">
            <div class="highlight-text">
                <h2>Une vraie ambiance communautaire</h2>
                <p>
                    Grâce à la base de données, les sujets et les commentaires sont affichés automatiquement.
                    Les utilisateurs peuvent donc interagir entre eux de manière plus vivante.
                </p>
            </div>

            <div class="highlight-side">
                <h3>🔥 Le forum permet</h3>
                <p>de débattre</p>
                <p>de recommander</p>
                <p>de commenter</p>
                <p>de partager ses lectures</p>
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