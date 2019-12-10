<?php
include_once("database.php");
$db = new Database();

$productName = 'Page de produit';
$product;

if (isset($_GET["idProduct"]) and !empty($_GET["idProduct"])) {
    //fetch product data
    //$product = ;

    if (isset($product) and !empty($product)) {
        $productName = $product["proName"];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $productName ?></title>
</head>

<body>
    <?php
    if (isset($product) and !empty($product)) { ?>
        <div>
            <h1><?= $productName ?></h1>
            <p></p>
        </div>
    <?php } else { ?>
        <h1>Aucun produit trouvé</h1>
    <?php } ?>
</body>

</html>