<?php require_once '../config.php'; ?>

<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = trim($_POST["pseudo"]);
    $email = trim($_POST["email"]);
    $mot_de_passe = $_POST["mot_de_passe"];

    if (!empty($pseudo) && !empty($email) && !empty($mot_de_passe)) {
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        $sql = "INSERT INTO utilisateurs (pseudo, email, mot_de_passe) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([$pseudo, $email, $mot_de_passe_hash]);
            header("Location: connecter.php");
            exit;
        } catch (PDOException $e) {
            $message = "Ce pseudo ou cet email existe déjà.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Plume Partagée</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="page-auth">

<header class="header">
    <div class="logo">
        <a href="../index.php">Plume Partagée</a>
    </div>

    <div class="header-buttons">
        <a href="connecter.php" class="btn-header">Se connecter</a>
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
    <section class="auth-card">
        <h1>Créer un compte</h1>
        <p>Créez un compte pour poser des questions et répondre sur le forum.</p>

        <?php if (!empty($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" id="formInscription">
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="votre@email.com">

            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe">

            <p id="messageFormulaire" class="message-js"></p>

            <button type="submit">Créer mon compte</button>
        </form>

        <p class="auth-link">
            Déjà un compte ? <a href="connecter.php">Se connecter</a>
        </p>
    </section>
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