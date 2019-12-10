<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produits</title>
</head>

<body>
    <?php
    include_once("database.php");
    $db = new Database();
    $data = array();

    switch ($_POST["sorting"]) {
        case "brand":
            echo 'Par marques';
            break;
        case "size":
            $order;
            if(isset($_POST["order"]) and !empty($_POST["order"])) {
                $order = $_POST["order"] == "ascending" ? "ASC" : "DESC";
            }
            echo 'Taille';
            break;
        case "weight":
            $order;
            if(isset($_POST["order"]) and !empty($_POST["order"])) {
                $order = $_POST["order"] == "ascending" ? "ASC" : "DESC";
            }
            echo 'Poids';
            break;
        case "manufacturer":
            echo 'Par constructeurs';
            break;
        case "top5Sell":
            echo 'Meilleures ventes';
            break;
        case "printSpeedBW":
            $order;
            if(isset($_POST["order"]) and !empty($_POST["order"])) {
                $order = $_POST["order"] == "ascending" ? "ASC" : "DESC";
            }
            echo 'Vitesse impression NB';
            break;
        case "printSpeedCol":
            $order;
            if(isset($_POST["order"]) and !empty($_POST["order"])) {
                $order = $_POST["order"] == "ascending" ? "ASC" : "DESC";
            }
            echo 'Vitesse impression Couleur';
            break;
        case "scanResolution":
            $order;
            if(isset($_POST["order"]) and !empty($_POST["order"])) {
                $order = $_POST["order"] == "ascending" ? "ASC" : "DESC";
            }
            echo 'Résolution scan';
            break;
        case "topPrice":
            $order;
            if(isset($_POST["order"]) and !empty($_POST["order"])) {
                $order = $_POST["order"] == "ascending" ? "ASC" : "DESC";
            }
            echo '3 top prix';
            break;
        case "priceAndManufacturer":
            $order;
            if(isset($_POST["order"]) and !empty($_POST["order"])) {
                $order = $_POST["order"] == "ascending" ? "ASC" : "DESC";
            }
            echo 'Par constructeurs ET prix';
            break;
        default;
            echo 'Valeur inconnue';
    }

    if (isset($data) and !empty($data)) {
        $_SESSION["data"] = $data;
        ?>
            <ul>
                <?php foreach ($data as $product) { ?>
                    <li>
                        <article>
                            <div>
                                <h1><?= $product["proName"] . ': ' . $product["braName"] ?></h1>
                                <p><?= $product["proManufacturer"] ?></p>
                                <?php
                                        switch ($_POST["sorting"]) {
                                            case "size":
                                                echo '<p>' . $product["proSize"] . '</p>';
                                                break;
                                            case "weight":
                                                echo '<p>' . $product["proWeight"] . '</p>';
                                                break;
                                            case "printSpeedBW":
                                                echo '<p>' . $product["proPrintSpeedBW"] . '</p>';
                                                break;
                                            case "printSpeedCol":
                                                echo '<p>' . $product["proPrintSpeedCol"] . '</p>';
                                                break;
                                            case "scanResolution":
                                                echo '<p>' . $product["proScanRes"] . '</p>';
                                                break;
                                            default;
                                                echo '';
                                        }
                                        ?>
                                    <p><?= $product["proPrice"] ?></p>
                                    <p>
                                        <a href="details.php?idProduct=<?= $product["idProduct"] ?>">Détails</a>
                                        <a href="consumables.php?idProduct=<?= $product["idProduct"] ?>">Consommables</a>
                                    </p>
                            </div>
                        </article>
                    </li>
                <?php } ?>
            </ul>
        <?php } else {
            echo 'Aucune donnée trouvées';
        }
        ?>
</body>

</html>