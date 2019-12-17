<?php

/**
 * @author Kévin Mury
 * @email kevin.mury@eduvaud.ch
 * @create date 2019-12-03 10:17:02
 * @modify date 2019-12-17 09:19:28
 * @desc [home page of the website]
 */

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
</head>

<body>
    <form action="products.php" method="post">
        <div style="display: inline;">
            <p style="width: 100px;">
                <label for="ascending">Ascendant</label>
                <input type="radio" name="order" id="ascending" value="ASC">
            </p>
            <p style="width: 100px;">
                <label for="descending">Descendant</label>
                <input type="radio" name="order" id="descending" value="DESC">
            </p>
        </div>
        <button name="sorting" value="brand">Par marques</button>
        <button name="sorting" value="size">Taille</button>
        <button name="sorting" value="weight">Poids</button>
        <button name="sorting" value="manufacturer">Par constructeurs</button>
        <button name="sorting" value="top5Sell">Meilleures ventes</button>
        <button name="sorting" value="printSpeedBW">Vitesse impression NB</button>
        <button name="sorting" value="printSpeedCol">Vitesse impression Couleur</button>
        <button name="sorting" value="scanResolution">Résolution scan</button>
        <button name="sorting" value="topPrice">3 top prix</button>
        <button name="sorting" value="priceAndManufacturer">Par constructeurs ET prix</button>
    </form>
</body>

</html>