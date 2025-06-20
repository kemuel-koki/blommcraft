<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: accueil.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin') {
        $_SESSION['username'] = $_POST['username'];
        header("Location: accueil.php");
        exit();
    } else {
        $error = 'Identifiants incorrects';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - BloomCraft</title>
    <style>
        body {
            margin: 0;
            font-family: 'Georgia', serif;
            background-color: #fff;
            color: #222;
        }
        header {
            background-color: #d6b1cc;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav {
            background-color: #d6b1cc;
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }
        nav a {
            margin: 0 20px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: white;
            font-family: 'Brush Script MT', cursive;
        }
        .icon {
            width: 24px;
            height: 24px;
            margin: 0 15px;
            cursor: pointer;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
        }
        .container img {
            width: 120px;
            margin-bottom: 20px;
        }
        .input-box {
            display: flex;
            align-items: center;
            background-color: #d6b1cc;
            margin: 10px auto;
            padding: 8px 12px;
            border-radius: 6px;
            width: 100%;
        }
        .input-box span {
            margin-right: 8px;
        }
        .input-box input {
            border: none;
            background: none;
            width: 100%;
            padding: 8px;
            font-size: 16px;
        }
        .remember {
            text-align: left;
            font-size: 14px;
            margin-top: 10px;
        }
        .login-btn {
            background-color: black;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 15px;
            font-size: 16px;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .forgot {
            margin-top: 15px;
            font-size: 14px;
        }
        .forgot a {
            color: #555;
            text-decoration: none;
        }
        .flower-banner {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <header>
        <a href="accueil.php"><img src="home.png" class="icon" alt="Accueil"></a>
        <div class="logo">BloomCraft</div>
        <a href="login.php"><img src="profile.png" class="icon" alt="Profil"></a>
    </header>

    <nav>
        <a href="bouquets.php">Nos bouquets</a>
        <a href="#">Personnaliser votre bouquet</a>
        <a href="#">Découvrir nos collections</a>
        <a href="#">Panier</a>
        <a href="#">En savoir plus sur nous</a>
    </nav>

    <!-- Bannière florale (reprend le style de l'accueil) -->
    <img src="fleurs.jpg" alt="Fleurs" class="flower-banner">

    <div class="container">
        <img src="avatar.png" alt="Avatar">
        <p>Veuillez entrer votre identifiant et mot de passe</p>

        <form method="POST">
            <div class="input-box">
                <span>👤</span><input type="text" name="username" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="input-box">
                <span>🔒</span><input type="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="remember"><input type="checkbox"> Se souvenir de moi</div>
            <button type="submit" class="login-btn">Connexion</button>
            <?php if ($error): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
        </form>
        <div class="forgot">
            <a href="#">Mot de passe oublié ?</a>
        </div>
    </div>
</body>
</html>
