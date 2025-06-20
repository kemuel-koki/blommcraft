<?php
// Mode DEV : affiche toutes les erreurs PHP (pense à désactiver en prod)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Tableau des bouquets
$bouquets = [
    "Bouquets de Saint Valentin" => [
        ["img" => "saint-valentin/coeur-ardent.png", "nom" => "Cœur Ardent", "prix" => 70],
        ["img" => "saint-valentin/folie-rose.png", "nom" => "Folie de rose", "prix" => 45],
        ["img" => "saint-valentin/tendresse-veloutee.png", "nom" => "Tendresse veloutée", "prix" => 70],
        ["img" => "saint-valentin/amour-absolu.png", "nom" => "Amour absolu", "prix" => 55],
    ],
    "Bouquets de Mariage" => [
        ["img" => "mariage/serment-amour.png", "nom" => "Serment d'amour", "prix" => 80],
        ["img" => "mariage/a-jamais.png", "nom" => "À jamais", "prix" => 100],
        ["img" => "mariage/un-jour-pour.png", "nom" => "Un jour pour toujours", "prix" => 60],
        ["img" => "mariage/eternelle-purete.png", "nom" => "Éternelle pureté", "prix" => 100],
    ],
    "Bouquets Fête des mères" => [
        ["img" => "fete-meres/pour-maman.png", "nom" => "Pour maman", "prix" => 70],
        ["img" => "fete-meres/tendresse.png", "nom" => "Tendresse", "prix" => 45],
        ["img" => "fete-meres/mon-coeur.png", "nom" => "Mon cœur", "prix" => 50],
        ["img" => "fete-meres/douce-maman.png", "nom" => "Douce maman", "prix" => 55],
    ],
    "Bouquets funéraires" => [
        ["img" => "funeraire/souvenir-de-toi.png", "nom" => "Souvenir de toi", "prix" => 120],
        ["img" => "funeraire/pour-ne-pas.png", "nom" => "Pour ne pas oublier", "prix" => 60],
        ["img" => "funeraire/un-dernier-mot.png", "nom" => "Un dernier mot", "prix" => 80],
        ["img" => "funeraire/larmes-de-fleur.png", "nom" => "Larmes de fleurs", "prix" => 90],
    ]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>BloomCraft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        /* Reset rapide */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #fff;
            color: #333;
            line-height: 1.5;
        }

        header {
            background: linear-gradient(135deg, #d8a5cb, #a56f9c);
            color: white;
            padding: 1em;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        nav {
            display: flex;
            justify-content: space-around;
            gap: 1em;
            margin-top: 0.5em;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 0.5em 1em;
            border-radius: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav a:hover,
        nav a:focus {
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
            outline: none;
        }

        .category {
            margin: 2em 1em;
        }

        h2 {
            border-bottom: 2px solid #ccc;
            padding-bottom: 0.5em;
            font-weight: 700;
            font-size: 1.6rem;
        }

        .bouquets {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2em;
            justify-content: center;
        }

        .bouquet {
            width: 180px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1em;
            text-align: center;
            transition: box-shadow 0.3s ease;
            background-color: #fafafa;
        }

        .bouquet:hover,
        .bouquet:focus-within {
            box-shadow: 0 4px 10px rgba(216, 165, 203, 0.7);
        }

        .bouquet img {
            width: 100%;
            border-radius: 8px;
            height: 150px;
            object-fit: cover;
        }

        .price {
            font-weight: bold;
            margin: 0.5em 0;
            font-size: 1.1rem;
            color: #a56f9c;
        }

        .cart {
            font-size: 1.1em;
            color: #444;
            text-decoration: none;
            display: inline-block;
            margin-top: 0.5em;
            border: 1px solid #a56f9c;
            padding: 0.4em 0.8em;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
            user-select: none;
        }

        .cart:hover,
        .cart:focus {
            color: white;
            background-color: #d8a5cb;
            border-color: #d8a5cb;
            outline: none;
        }
    </style>
</head>
<body>

<header>
    <h1>BloomCraft</h1>
    <nav>
        <a href="#bouquets">Nos bouquets</a>
        <a href="#personnaliser">Personnaliser votre bouquet</a>
        <a href="panier.php" aria-label="Voir le panier">Panier 🛒</a>
    </nav>
</header>

<main>
    <?php foreach ($bouquets as $categorie => $articles): ?>
        <section class="category" id="<?= htmlspecialchars(strtolower(str_replace(' ', '-', $categorie))) ?>">
            <h2><?= htmlspecialchars($categorie) ?></h2>
            <div class="bouquets">
                <?php foreach ($articles as $b): ?>
                    <article class="bouquet" tabindex="0" aria-label="<?= htmlspecialchars($b['nom']) ?> à <?= htmlspecialchars($b['prix']) ?> euros">
                        <img src="images/<?= htmlspecialchars($b['img']) ?>" alt="<?= htmlspecialchars($b['nom']) ?>" />
                        <div><?= htmlspecialchars($b['nom']) ?></div>
                        <div class="price"><?= htmlspecialchars($b['prix']) ?> €</div>
                        <a 
                           href="panier.php?action=ajouter&amp;nom=<?= urlencode($b['nom']) ?>&amp;prix=<?= urlencode($b['prix']) ?>" 
                           class="cart" 
                           role="button" 
                           aria-pressed="false"
                           >
                           🛒 Ajouter au panier
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>
</main>

<script>
  // Feedback simple à l’ajout panier (pas bloquant, juste UX)
  document.querySelectorAll('.cart').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const bouquetName = btn.parentElement.querySelector('div').innerText;
      alert(`Le bouquet "${bouquetName}" a été ajouté au panier !`);
      window.location.href = btn.href;
    });
  });
</script>

</body>
</html>
