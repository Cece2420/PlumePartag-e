<?php
require_once '../config.php';

header('Content-Type: application/json');

if (!isset($_POST["action"])) {
    echo json_encode(["success" => false, "message" => "Action inconnue."]);
    exit;
}

$action = $_POST["action"];

if ($action == "ajouter_like") {
    if (!isset($_SESSION["utilisateur_id"])) {
        echo json_encode(["success" => false, "message" => "Vous devez être connecté."]);
        exit;
    }

    $sujet_id = $_POST["sujet_id"];
    $utilisateur_id = $_SESSION["utilisateur_id"];

    $sql = "INSERT IGNORE INTO likes (sujet_id, utilisateur_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sujet_id, $utilisateur_id]);

    $sql = "SELECT COUNT(*) FROM likes WHERE sujet_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sujet_id]);
    $nombre_likes = $stmt->fetchColumn();

    echo json_encode([
        "success" => true,
        "message" => "Like ajouté.",
        "nombre_likes" => $nombre_likes
    ]);
    exit;
}

if ($action == "ajouter_commentaire") {
    if (!isset($_SESSION["utilisateur_id"])) {
        echo json_encode(["success" => false, "message" => "Vous devez être connecté."]);
        exit;
    }

    $sujet_id = $_POST["sujet_id"];
    $contenu = trim($_POST["contenu_commentaire"]);
    $utilisateur_id = $_SESSION["utilisateur_id"];

    if ($contenu == "") {
        echo json_encode(["success" => false, "message" => "Le commentaire est vide."]);
        exit;
    }

    $sql = "INSERT INTO commentaires (contenu, sujet_id, utilisateur_id) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contenu, $sujet_id, $utilisateur_id]);

    echo json_encode([
        "success" => true,
        "message" => "Commentaire ajouté.",
        "pseudo" => $_SESSION["pseudo"],
        "contenu" => htmlspecialchars($contenu)
    ]);
    exit;
}

if ($action == "ajouter_favori") {
    if (!isset($_SESSION["utilisateur_id"])) {
        echo json_encode(["success" => false, "message" => "Vous devez être connecté."]);
        exit;
    }

    $annonce_id = $_POST["annonce_id"];
    $utilisateur_id = $_SESSION["utilisateur_id"];

    $sql = "INSERT IGNORE INTO favoris (utilisateur_id, annonce_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$utilisateur_id, $annonce_id]);

    echo json_encode([
        "success" => true,
        "message" => "Livre ajouté aux favoris."
    ]);
    exit;
}

if ($action == "retirer_favori") {
    if (!isset($_SESSION["utilisateur_id"])) {
        echo json_encode(["success" => false, "message" => "Vous devez être connecté."]);
        exit;
    }

    $favori_id = $_POST["favori_id"];
    $utilisateur_id = $_SESSION["utilisateur_id"];

    $sql = "DELETE FROM favoris WHERE id = ? AND utilisateur_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$favori_id, $utilisateur_id]);

    echo json_encode([
        "success" => true,
        "message" => "Favori retiré."
    ]);
    exit;
}

if ($action == "ajouter_panier") {
    if (!isset($_SESSION["panier"])) {
        $_SESSION["panier"] = [];
    }

    $annonce_id = $_POST["annonce_id"];

    $sql = "SELECT * FROM annonces WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$annonce_id]);
    $annonce = $stmt->fetch();

    if (!$annonce) {
        echo json_encode(["success" => false, "message" => "Annonce introuvable."]);
        exit;
    }

    $article = [
        "id" => $annonce["id"],
        "titre" => $annonce["titre"],
        "description" => $annonce["description"],
        "prix" => $annonce["prix"],
        "image" => $annonce["image"],
        "quantite" => 1
    ];

    $_SESSION["panier"][] = $article;

    $nombre_articles = 0;
    foreach ($_SESSION["panier"] as $article) {
        $nombre_articles += $article["quantite"];
    }

    echo json_encode([
        "success" => true,
        "message" => "Article ajouté au panier.",
        "nombre_articles" => $nombre_articles
    ]);
    exit;
}

echo json_encode(["success" => false, "message" => "Action non reconnue."]);
exit;
?>