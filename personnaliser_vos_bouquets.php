
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Personnaliser mon bouquet - Bloomcraft</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8f4f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 4rem auto;
            background: white;
            border-radius: 15px;
            padding: 3rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #a3528e;
            margin-bottom: 2rem;
        }

        label {
            display: block;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #5e2c4e;
        }

        select, input[type="text"], textarea, input[type="date"] {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            background: #fdfbfc;
        }

        .btn {
            display: block;
            width: fit-content;
            background: #a3528e;
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            margin: 2rem auto 0;
        }

        .btn:hover {
            background: #7e356b;
        }

        .fleurs-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 1rem;
        }

        .fleurs-preview img {
            width: 100px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .fleurs-preview-caption {
            font-size: 0.9rem;
            text-align: center;
            color: #5e2c4e;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Personnalisez votre bouquet</h1>
    <form action="traitement_personnalisation.php" method="POST">

        <label for="fleurs">Choisissez vos fleurs 🌼</label>
        <select name="fleurs[]" id="fleurs" multiple required>
            <option value="roses">Roses</option>
            <option value="tulipes">Tulipes</option>
            <option value="lys">Lys</option>
            <option value="pivoines">Pivoines</option>
            <option value="marguerites">Marguerites</option>
            <option value="tournesols">Tournesols</option>
        </select>

        <div class="fleurs-preview">
            <div>
                <img src="images/fleurs/roses.jpg" alt="Roses">
                <div class="fleurs-preview-caption">Roses</div>
            </div>
            <div>
                <img src="images/fleurs/tulipes.jpg" alt="Tulipes">
                <div class="fleurs-preview-caption">Tulipes</div>
            </div>
            <div>
                <img src="images/fleurs/lys.jpg" alt="Lys">
                <div class="fleurs-preview-caption">Lys</div>
            </div>
            <div>
                <img src="images/fleurs/pivoines.jpg" alt="Pivoines">
                <div class="fleurs-preview-caption">Pivoines</div>
            </div>
            <div>
                <img src="images/fleurs/marguerites.jpg" alt="Marguerites">
                <div class="fleurs-preview-caption">Marguerites</div>
            </div>
            <div>
                <img src="images/fleurs/tournesols.jpg" alt="Tournesols">
                <div class="fleurs-preview-caption">Tournesols</div>
            </div>
        </div>

        <label for="couleur">Couleur dominante 🎨</label>
        <select name="couleur" id="couleur" required>
            <option value="rose">Rose</option>
            <option value="blanc">Blanc</option>
            <option value="jaune">Jaune</option>
            <option value="rouge">Rouge</option>
            <option value="mélangé">Mélangé</option>
        </select>

        <label for="taille">Taille du bouquet 📏</label>
        <select name="taille" id="taille" required>
            <option value="petit">Petit</option>
            <option value="moyen">Moyen</option>
            <option value="grand">Grand</option>
        </select>

        <label for="message">Message personnalisé ✏️</label>
        <textarea name="message" id="message" rows="4" placeholder="Écrivez votre message..."></textarea>

        <label for="livraison">Date de livraison souhaitée 📆</label>
        <input type="date" name="livraison" id="livraison" required>

        <button type="submit" class="btn">Valider la personnalisation</button>
    </form>
</div>

</body>
</html>
