<!--
    Auteur      :
    Date        : 03.12.19
    Description : Page sur les consommables
-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>consommables</title>
</head>
<?php
    include_once("database.php");
    $db = new Database();


?>
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
            <!--
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
            <h3>
                Filter par
            </h3>
                Marque:<br>
                <select name="Brand">
                    <option value="all"></option>
                    <option value="HP">HP</option>
                    <option value="Canon">Canon</option>
                    <option value="Brother">Brother</option>
                </select><br>
                Compatible avec:<br>
                <input type="text" name="lastname" title="Rechercher le nom d'une imprimante"><br><br>

                <input type="submit" value="Rechercher">
            </form>
            -->
            <br>
        </div>
        <div>
        <table style="width: 100%;" cellpadding="1">
            <?php
            echo '<tbody>';
            echo '<tr>';
            echo '<td>Marque</td>';
            echo '<td>Nom</td>';
            echo '<td>Type</td>';
            echo '<td>Compatible</td>';
            echo '<td>Prix</td>';
            echo '</tr>';
            
            if(isset($_GET(['idPrinter'])){
                $allConsumables = $db->getPrintersAndConsumable();
            }
            else{
                $allConsumables = $db->getAllConsumables();
            }

            if (isset($_POST[""])) {
                # code...
            }

            if(isset($allConsumables)){
                foreach ($allConsumables as $consumable) {
                    if(isset($consumable)){
                        $compatiblePrinters = $db->getPrintersByConsumable($consumable['idConsumable']);
    
                        echo '<tr>';
                        echo '<td>' . $consumable['conName'] . '</td>';
                        echo '<td>' . $consumable['braName'] . '</td>';
                        echo '<td>' . $consumable['conType'] . '</td>';
                        if(isset($compatiblePrinters[0])){
                            echo '<td>' . $compatiblePrinters[0] . '</td>';
                        }
                        echo '<td>' . $consumable['conPrice'] . '</td>';
                        echo '</tr>';
                    }

                }
            }
            echo '</tbody>';
            if(!isset($allConsumables)){
                echo 'No consumable found'
            }
            ?>
            <tbody>
            <tr>
                <td>Marque</td>
                <td>Nom</td>
                <td>Type</td>
                <td>Compatible</td>
                <td>Prix</td>
            </tr>
            <tr>
                <td>HP</td>
                <td>415A (C)</td>
                <td>Toner</td>
                <td>Color LaserJet Pro M479fdw</td>
                <td>128</td>
            </tr>
            <tr>
                <td>Xerox</td>
                <td>Xerox Waste Toner Cartridge</td>
                <td>Rechange</td>
                <td>WorkCentre 6515V/DNI</td>
                <td>31.4</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
    <footer>
        Copyright NAKZ / ETML 2020
    </footer>
</body>
</html>