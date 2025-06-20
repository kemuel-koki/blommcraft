<?php
session_start();

// Initialisation du panier s'il n'existe pas
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter un produit au panier
if (isset($_GET['action']) && $_GET['action'] == 'ajouter' && isset($_GET['nom']) && isset($_GET['prix'])) {
    $nom = htmlspecialchars($_GET['nom']);
    $prix = (float) $_GET['prix'];
    
    // Vérifier si le produit existe déjà dans le panier
    $existe = false;
    foreach ($_SESSION['panier'] as &$article) {
        if ($article['nom'] == $nom) {
            $article['quantite']++;
            $existe = true;
            break;
        }
    }
    
    // Si le produit n'existe pas encore, l'ajouter
    if (!$existe) {
        $_SESSION['panier'][] = ['nom' => $nom, 'prix' => $prix, 'quantite' => 1];
    }

    // Redirection pour éviter le rechargement multiple
    header("Location: panier.php");
    exit;
}

// Supprimer un produit du panier
if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['nom'])) {
    $nom = htmlspecialchars($_GET['nom']);
    foreach ($_SESSION['panier'] as $key => $article) {
        if ($article['nom'] == $nom) {
            unset($_SESSION['panier'][$key]);
            break;
        }
    }
    // Réindexer le tableau
    $_SESSION['panier'] = array_values($_SESSION['panier']);
    header("Location: panier.php");
    exit;
}

// Vider le panier
if (isset($_GET['action']) && $_GET['action'] == 'vider') {
    $_SESSION['panier'] = [];
    header("Location: panier.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Panier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #fff; }
        header { background-color: #d8a5cb; color: white; padding: 1em; text-align: center; position: sticky; top: 0; }
        table { width: 80%; margin: 2em auto; border-collapse: collapse; }
        th, td { padding: 1em; border: 1px solid #ddd; text-align: center; }
        th { background-color: #f5f5f5; }
        .btn { padding: 0.5em 1em; background-color: #d8a5cb; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { background-color: #c487bb; }
        .actions { margin-top: 1em; text-align: center; }
    </style>
</head>
<body>

<header>
    <h1>Votre Panier</h1>
</header>

<main>
    <?php if (!empty($_SESSION['panier'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalPanier = 0;
                foreach ($_SESSION['panier'] as $article): 
                    $totalArticle = $article['prix'] * $article['quantite'];
                    $totalPanier += $totalArticle;
                ?>
                    <tr>
                        <td><?= $article['nom'] ?></td>
                        <td><?= number_format($article['prix'], 2) ?> €</td>
                        <td><?= $article['quantite'] ?></td>
                        <td><?= number_format($totalArticle, 2) ?> €</td>
                        <td>
                            <a href="?action=supprimer&nom=<?= urlencode($article['nom']) ?>" class="btn">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="actions">
            <p><strong>Total :</strong> <?= number_format($totalPanier, 2) ?> €</p>
            <a href="?action=vider" class="btn">Vider le panier</a>
        </div>
    <?php else: ?>
        <p style="text-align: center;">Votre panier est vide.</p>
    <?php endif; ?>
</main>

</body>
</html>
