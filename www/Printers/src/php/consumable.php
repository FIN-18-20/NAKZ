<?php

/**
 * @author Zhi Ngo
 * @email bing.ngo@eduvaud.ch
 * @create date 2019-12-17 09:11:54
 * @modify date 2019-12-17 09:33:02
 * @desc [page of consumables]
 */

    //Connection à la DB
    include_once("database.php");
    $db = new Database();

    //DEBUG
    var_dump($_GET);
    var_dump($_POST);

//Récupération et triage des consommables

//Si idPrinter en GET, Récupère consommable pour ce printer et order les consommable selon POST
if(isset($_GET['idPrinter'])){
    echo "DEBUG CASE 0";
    if (isset($_POST[""])) {
        echo "DEBUG CASE 00";
        if(isset($_POST['Column']) && isset($_POST['ordering'])){
            echo "DEBUG CASE 000";
            $allConsumables = $db->getPrintersAndConsumables( $_GET['idPrinter'], $_POST['Column'], $_POST['ordering']);
        }
    }
    else {
        echo "DEBUG CASE 01";
        $allConsumables = $db->getPrintersAndConsumables($_GET['idPrinter'], 'conName', 'ASC');
    }
    //$allConsumables = $db->getPrintersAndConsumable();
}
//Sinon, Récupère consommable pour tout printer et order les consommable selon POST
else{
    echo "DEBUG CASE 1";
    if (isset($_POST[""])) {
        echo "DEBUG CASE 10";
        if(isset($_POST['Column']) && isset($_POST['ordering'])){
            echo "DEBUG CASE 110";
            $allConsumables = $db->getPrintersAndConsumables(0, $_POST['Column'], $_POST['ordering']);
        }
    }
    else {
        echo "DEBUG CASE 11";
        $allConsumables = $db->getPrintersAndConsumables(0 , 'conName', 'ASC');
    }
    //$allConsumables = $db->getConsumableDetail();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consommables</title>
</head>
<body>
    <header>
        Gestion des imprimantes
    </header>
    <div>
        <h1>
            Liste des consommables
        </h1>
        <div>
            <h2>
                Recherche des consommables
            </h2>
            
            <form action="" method="POST">
            <h3>
                Ordonner par
            </h3>
                Colonne:<br>
                <input type="radio" name="Column" value="idBrand" checked> Marque<br>
                <input type="radio" name="Column" value="conName"> Nom<br>
                <input type="radio" name="Column" value="conType"> Type<br>
                <input type="radio" name="Column" value="idPrinter"> Compatible<br>
                <input type="radio" name="Column" value="conPrice"> Prix<br>

                Direction:<br>
                <input type="radio" name="ordering" value="ASC" checked> Ascendent<br>
                <input type="radio" name="ordering" value="DESC"> Descedent<br>
                <input type="submit" value="Rechercher">
            </form>
            
            <br>
        </div>
        <div>
        <table style="width: 100%;" cellpadding="1">
            <?php
            echo '<tbody>' .
            '<tr>' .
            '<td>Marque</td>' .
            '<td>Nom</td>' .
            '<td>Type</td>' .
            '<td>Compatible</td>' .
            '<td>Prix</td>' .
            '</tr>';
        
            if(isset($allConsumables)){
                echo "DEBUG CASE A0";
                var_dump($allConsumables);
                foreach ($allConsumables as $consumable) {
                    var_dump($consumable);
                    if(isset($consumable)){
                        $compatiblePrinters = $db->getConsumablesAndPrinters($consumable['idConsumable']);
                        var_dump($compatiblePrinters);
                        echo '<tr>' .
                            '<td>' . $consumable['conName'] . '</td>' .
                            '<td>' . $consumable['braName'] . '</td>' .
                            '<td>' . $consumable['conType'] . '</td>';
                        if(isset($compatiblePrinters[0])){
                            echo '<td>' . $compatiblePrinters[0] . '</td>';
                        }
                        echo '<td>' . $consumable['conPrice'] . '</td>' .
                            '</tr>';
                    }

                }
            }
            echo '</tbody>';
            if(!isset($allConsumables)){
                echo "DEBUG CASE B0";
                echo 'Aucune donnée trouvée';
            }
            ?>
        </table>
        </div>
    </div>
    <footer>
        Copyright NAKZ / ETML 2020
    </footer>
</body>
</html>