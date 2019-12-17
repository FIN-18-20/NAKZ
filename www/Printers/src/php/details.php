<?php

/**
 * @author Kévin Mury
 * @email kevin.mury@eduvaud.ch
 * @create date 2019-12-10 08:29:35
 * @modify date 2019-12-17 09:11:25
 * @desc [detailed page of a product]
 */

include_once("util.php");

include_once("database.php");
$db = new Database();

$title = 'Page de produit';
$product;

$error = false;

if (exists($_GET["idProduct"])) {
    //fetch product data
    //$product = ;

    if (exists($product)) {
        $productManufacturer = secure($product["manName"]);
        $productBrand = secure($product["braName"]);
        $productName = secure($product["proName"]);
        $productPrintSpeedBW = secure($product["proPrintSpeedBW"]);
        $productPrintSpeedCol = secure($product["proPrintSpeedCol"]);
        $productPrintResX = secure($product["proPrintResX"]);
        $productPrintResY = secure($product["proPrintResY"]);
        $productRectoVerso = secure($product["proRectoVerso"]);
        $productColour = secure($product["proColour"]);
        $productPrintTech = secure($product["proPrintTech"]);
        $productScanSpeedBW = secure($product["proScanSpeedBW"]);
        $productScanSpeedCol = secure($product["proScanSpeedCol"]);
        $productScanResX = secure($product["proScanResX"]);
        $productScanResY = secure($product["proScanResY"]);
        $productWeight = secure($product["proWeight"]);
        $productLength = secure($product["proLength"]);
        $productHeight = secure($product["proHeight"]);
        $productWidth = secure($product["proWidth"]);
        $productPrice = secure($product["proPrice"]);
    }
}

if (!empty($productName)) {
    $title = $productBrand . ' ' . $productName;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $productBrand . ' ' . $productName ?></title>
</head>

<body>
    <?php
            if (!$error) { ?>
        <div>
            <h1><?= $productBrand . ' ' . $productName ?></h1>

            <p>Prix: <?= $productPrice ?> </p>
            <p>Constructeur: <?= $productManufacturer ?> </p>

            <p> Résolution d'impression: <?= $productPrintResX . 'x' . $productPrintResY ?> </p>
            <p> Recto-verso: <?= $productRectoVerso ?> </p>
            <p> Vitesse d'impression NB: <?= $productPrintSpeedBW ?> </p>
            <p> Couleur: <?= $productColour ?> </p>
            <p> Vitesse d'impression couleur: <?= $productPrintSpeedCol ?> </p>
            <p> Technologie d'impression <?= $productPrintTech ?> </p>
            <p> Vitesse de scan NB: <?= $productScanSpeedBW ?> </p>
            <p> Vitesse de scan couleur: <?= $productScanSpeedCol ?> </p>
            <p> Résolution de scan: <?= $productScanResX . 'x' . $productScanResY ?> </p>
            <p> Poids: <?= $productWeight ?> </p>
            <p> Dimensions: <?= $productLength . 'x' . $productHeight . 'x' . $productWidth ?> </p>

            <div>
                <p>Consommables:</p>

            </div>

        </div>
    <?php } else { ?>
        <h1>Aucun produit trouvé</h1>
    <?php } ?>
</body>

</html>