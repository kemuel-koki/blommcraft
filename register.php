<?php
// Activer les erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db.php'); // Connexion à la base via $pdo

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = trim($_POST['email']);

    if ($password !== $confirm_password) {
        $message = "<div class='alert alert-warning text-center mt-3'>❌ Les mots de passe ne correspondent pas.</div>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (nom, mail, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashedPassword]);
            $message = "<div class='alert alert-success text-center mt-3'>✅ Compte créé avec succès !</div>";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Doublon unique (username déjà utilisé)
                $message = "<div class='alert alert-danger text-center mt-3'>⚠️ Le nom d'utilisateur est déjà pris.</div>";
            } else {
                $message = "<div class='alert alert-danger text-center mt-3'>❌ Erreur : " . $e->getMessage() . "</div>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary">
    <form class="mt-3 p-3 rounded bg-white container" action="" method="post">
        <h1 class="text-center">Créer un compte</h1>

        <?= $message ?>

        <input class="form-control" type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input class="mt-3 form-control" type="password" name="password" placeholder="Mot de passe" required>
        <input class="mt-3 form-control" type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
        <input class="mt-3 form-control" type="email" name="email" placeholder="Adresse email" required>

        <!-- Champs non stockés dans la BDD (mais affichés dans le formulaire) -->
        <input class="mt-3 form-control" type="text" name="phone" placeholder="Numéro de téléphone">
        <div class="form-check mt-3">
            <input class="form-check-input" type="radio" name="sexe" value="femme" id="sexe_femme">
            <label class="form-check-label" for="sexe_femme">Femme</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexe" value="homme" id="sexe_homme" checked>
            <label class="form-check-label" for="sexe_homme">Homme</label>
        </div>

        <input class="mt-3 btn btn-outline-primary w-100" type="submit" value="S'inscrire">
    </form>
</body>
</html>
