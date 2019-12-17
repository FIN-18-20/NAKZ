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
$db = new database();

$title = 'Page de produit';
$product;

$error = true;

if (exists($_GET["idProduct"])) {
    $idProduct = $_GET["idProduct"];
    $product = $db->getPrinterDetail($idProduct);

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

        $error = false;
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


            <p>Constructeur: <?= $productManufacturer ?> </p>
            <p>Prix: <?= $productPrice ?> CHF</p>

            <div>
                <h4>Impression:</h4>
                <p> Technologie d'impression: <?= $productPrintTech ?> </p>
                <p> Couleur: <?= $productColour == 'Y' ? "Oui" : "Non" ?> </p>
                <p> Recto-verso: <?= $productRectoVerso == 'Y' ? "Oui" : "Non" ?> </p>
                <p> Vitesse d'impression NB: <?= $productPrintSpeedBW ?> pages/min</p>
                <p> Vitesse d'impression couleur: <?= $productPrintSpeedCol ?> pages/min</p>
                <p> Résolution d'impression: <?= $productPrintResX . 'x' . $productPrintResY ?> dpi</p>
            </div>
            <div>
                <h4>Scan</h4>
                <p> Vitesse de scan NB: <?= $productScanSpeedBW ?> pages/min</p>
                <p> Vitesse de scan couleur: <?= $productScanSpeedCol ?> pages/min</p>
                <p> Résolution de scan: <?= $productScanResX . 'x' . $productScanResY ?> dpi</p>
            </div>
            <div>
                <h4>Dimensions</h4>
                <p> Poids: <?= $productWeight ?> kg</p>
                <p> Dimensions: <?= $productLength . 'cm x' . $productHeight . 'cm x' . $productWidth . 'cm' ?> </p>
            </div>

            <div>
                <h4>Produits associés</h4>
                <p>Consommables:</p>

            </div>

        </div>
    <?php } else { ?>
        <h1>Aucun produit trouvé</h1>
    <?php } ?>
</body>

</html>