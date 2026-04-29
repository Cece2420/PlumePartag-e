<?php require_once '../config.php'; ?>

<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $mot_de_passe = $_POST["mot_de_passe"];

    if (!empty($email) && !empty($mot_de_passe)) {
        $sql = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur["mot_de_passe"])) {
            $_SESSION["utilisateur_id"] = $utilisateur["id"];
            $_SESSION["pseudo"] = $utilisateur["pseudo"];

            header("Location: ../index.php");
            exit;
        } else {
            $message = "Email ou mot de passe incorrect.";
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
    <title>Connexion - Plume Partagée</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="page-auth">

<header class="header">
    <div class="logo">
        <a href="../index.php">Plume Partagée</a>
    </div>

    <div class="header-buttons">
        <a href="inscrire.php" class="btn-header">Créer un compte</a>
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
        <h1>Connexion</h1>
        <p>Connectez-vous pour participer au forum.</p>

        <?php if (!empty($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" id="formConnexion">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="votre@email.com">

            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe">

            <p id="messageFormulaire" class="message-js"></p>

            <button type="submit">Se connecter</button>
        </form>

        <p class="auth-link">
            Pas encore de compte ? <a href="inscrire.php">Créer un compte</a>
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