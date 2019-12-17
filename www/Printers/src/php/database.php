<?php

/**
 * @author Nicolas Benitez, Alexandre Jaquier
 * @email nicolas.benitez@eduvaud.ch, alexandre.jaquier@eduvaud.ch
 * @create date 2019-12-03 10:44:40
 * @modify date 2019-12-17 09:32:44
 * @desc [classe database pour les requêtes SQL // database class for SQL queries]
 */

class database
{
    protected $connector;
    protected $req;
    public $result;
    protected $printBaseInfo = "t_product.proName,t_brand.braName,t_manufacturer.manName, (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = t_product.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) AS \"priPrice\" ";
    protected $printBaseJoin = "NATURAL JOIN t_brand
    NATURAL JOIN t_manufacturer
    LEFT JOIN t_history ON t_history.idProduct = t_product.idProduct";

    /**
     * Constructeur de la classe database // database class constructor
     */
    function __construct()
    {
        try {
            $this->connector = new PDO('mysql:host=localhost;dbname=db_printers;charset=utf8', 'root', 'root');
        } catch (PDOException $e) {
            echo "Un problème est survenu avec la base de donnée, veuillez réessayer plus tard." . " " .  $e;
        }
    }

    /**
     * Déstructeur de la classe database // database class destructor
     */
    function __destruct()
    {
        $this->connector = null;
    }

    /**
     * Fonction d'exécution d'une requête SQL non préparée // non prepared query execute function
     *
     * @param [string] $query
     * @return void
     */
    function queryExecute($query)
    {
        if (isset($this->req)) {
            $this->closeCursor();
        }
        $this->req = $this->connector->query($query);
    }

    /**
     * Fonction d'exécution d'une requête SQL préparée // prepared query execute function
     * À utiliser pour éviter l'injection SQL // use to avoid SQL injection
     * @param [string] $query
     * @param [array] $values
     * @return void
     */
    function prepareExecute($query, $values)
    {
        $this->req = $this->connector->prepare($query);
        foreach ($values as $value) {
            $this->req->bindValue($value['name'], $value['value'], $value['type']);
        }
        echo $query;
        $this->req->execute();
    }

    /**
     * Traite et transforme le résultat d'une query selon les besoins // Process and transform the result of a query as needed
     *
     * @param [string] $mode
     * @return void
     */
    function fetchData($mode)
    {
        $result = $this->req->fetchALL($mode);
        return $result;
    }

    /**
     * Vide le jeu d'enregistrements // Empty the recordset
     *
     * @return void
     */
    function closeCursor()
    {
        if (isset($this->req)) {
            $this->req->closeCursor();
        }
    }

    /**
     * Récupère les informations générales d'une imprimante // Retrieve general informations of a printer
     *
     * @return void
     */
    function getPrinterDetail($idPrinter)
    {
        $request = 'SELECT t_product.*,t_brand.braName,t_manufacturer.manName ,GROUP_CONCAT(DISTINCT t_consumable.idConsumable SEPARATOR ", ") AS "idsCon" , 
        (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = t_product.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) AS "proPrice" 
        FROM t_product
        NATURAL JOIN t_use
        NATURAL JOIN t_consumable
        :printBaseJoin
        WHERE t_product.idProduct = :idPrinter';

        $toBind = array(
            array(
                'name' => 'idPrinter',
                'value' => $idPrinter,
                'type' => PDO::PARAM_INT
            ),
            array(
                'name' => 'printBaseJoin',
                'value' => $this->printBaseJoin,
                'type' => PDO::PARAM_STR
            )
        );
        $this->prepareExecute($request, $toBind);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les informations générales d'un consommable // Retrieve general information of a consumable
     *
     * @return void
     */
    function getConsumableDetail()
    {
        $request = 'SELECT t_consumable.idConsumable, t_consumable.conName, t_consumable.conType, t_brand.braName, t_consumable.conPrice FROM t_consumable
        NATURAL JOIN t_brand';
        $this->queryExecute($request);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }


    /**
     * Récupère et classe les imprimantes par vitesse d'impression noir/blanc // Retrieve and classified printers by 
     * black/white print speed
     *
     * @return void
     */
    function printersByBWSpeed()
    {
        $request = 'SELECT :printBaseInfo, t_product.proPrintSpeedBW FROM t_product  
        :printBaseJoin
        ORDER BY t_product.proPrintSpeedBW LIMIT 10';
        $toBind = array(
            array(
                'name' => 'printBaseInfo',
                'value' => $this->printBaseInfo,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'printBaseJoin',
                'value' => $this->printBaseJoin,
                'type' => PDO::PARAM_STR
            )
        );
        $this->prepareExecute($request, $toBind);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère et classe les imprimantes par vitesse d'impression noir/blanc // Retrieve and classified printers by 
     * color print speed
     *
     * @return void
     */
    function printersByColSpeed()
    {
        $request = 'SELECT :printBaseInfo, t_product.proPrintSpeedCol FROM t_product 
        :printBaseJoin
        ORDER BY t_product.proPrintSpeedBW LIMIT 10';
        $toBind = array(
            array(
                'name' => 'printBaseInfo',
                'value' => $this->printBaseInfo,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'printBaseJoin',
                'value' => $this->printBaseJoin,
                'type' => PDO::PARAM_STR
            )
        );
        $this->prepareExecute($request, $toBind);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère et classe les imprimantes par marques // Retrieve and classifies printers by brand
     *
     * @return void
     */
    function printersByBrand()
    {
        /*
        $request = 'SELECT t_product.*, t_brand.braName,t_manufacturer.manName, (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = t_product.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) AS "priPrice"  
        FROM t_product
        :printBaseJoin
        ORDER BY t_product.idBrand';
        */

        $request = 'SELECT DISTINCT t_product.*, t_brand.braName, t_manufacturer.manName, (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = t_product.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) AS "priPrice"  
        FROM t_product
        :printBaseJoin
        ORDER BY t_product.idBrand';

        $toBind = array(
            array(
                'name' => 'printBaseJoin',
                'value' => $this->printBaseJoin,
                'type' => PDO::PARAM_STR
            )
        );
        $this->prepareExecute($request, $toBind);
        //echo 'REQ ' . $request;
        //echo 'BIND ';
        //var_dump($toBind);
        //echo 'DATA ';
        //var_dump($this->fetchData(PDO::FETCH_ASSOC));
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère et classe les imprimantes par taille // Retrieve and classifies printers by size
     *
     * @param [string] $order
     * @return void
     */
    function printersBySize($order)
    {
        $request = 'SELECT t_product.proPrintResX,t_product.proPrintResY,:printBaseInfo FROM t_product 
        :printBaseJoin
        ORDER BY t_product.proPrintResX * t_product.proPrintResY :order';
        
        $toBind = array(
            array(
                'name' => 'printBaseInfo',
                'value' => $this->printBaseInfo,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'printBaseJoin',
                'value' => $this->printBaseJoin,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'order',
                'value' => $order,
                'type' => PDO::PARAM_STR
            )
        );
        $this->prepareExecute($request, $toBind);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère et classe les imprimantes par poids // Retrieve and classifies printers by weight
     *
     * @param [string] $order
     * @return void
     */
    function printersByWeight($order)
    {
        $request = 'SELECT :printBaseInfo, t_product.proWeight FROM t_product
        :printBaseJoin
        ORDER BY t_product.proWeight :order';
        $toBind = array(
            array(
                'name' => 'printBaseInfo',
                'value' => $this->printBaseInfo,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'printBaseJoin',
                'value' => $this->printBaseJoin,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'order',
                'value' => $order,
                'type' => PDO::PARAM_STR
            )
            
        );
        $this->prepareExecute($request, $toBind);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère la date et la valeur d'un prix pour montrer son évolution // Retrieve the date and value of a price to show its evolution
     *
     * @return void
     */
    function priceEvolution($idPrinter)
    {
        $request = 'SELECT :printBaseInfo,t_history.hisPrice, t_history.hisDate FROM t_history 
        :printBaseJoin
        WHERE t_history.idProduct = :idPrinter ORDER BY t_history.hisDate ASC';
        $toBind = array(
            array(
                'name' => 'idPrinter',
                'value' => $idPrinter,
                'type' => PDO::PARAM_INT
            ),
            array(
                'name' => 'printBaseInfo',
                'value' => $this->printBaseInfo,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'printBaseJoin',
                'value' => $this->printBaseJoin,
                'type' => PDO::PARAM_STR
            )
        );
        $this->prepareExecute($request, $toBind);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère le prix actuel d'un produit
     *
     * @return void
     *
     * function getActualPrice(){
     * $request = 'SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = 1 ORDER BY t_history.hisDate DESC LIMIT 1';
     * $this->queryExecute($request);
     * return $this->fetchData(PDO::FETCH_ASSOC);
     * */

    /**
     * Récupère les trois produits les plus chers // Retrieve the three most expensive printers
     *
     * @param [string] $order
     * @return void
     */
    function getExpensivePrinters($order)
    {
        $request = 'SELECT :printBaseInfo, (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = t_product.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) FROM t_product p 
        :printBaseJoin
        GROUP BY t_product.idProduct ORDER BY t_history.hisPrice :order LIMIT 3';
        $toBind = array(
            array(
                'name' => 'printBaseInfo',
                'value' => $this->printBaseInfo,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'printBaseJoin',
                'value' => $this->printBaseJoin,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'order',
                'value' => $order,
                'type' => PDO::PARAM_STR
            )
        );
        $this->prepareExecute($request, $toBind);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les consommables compatibles avec un produit // Retrieve all consumables compatible with a printer
     *
     * @param [string] $idPrinter
     * @return void
     */
    function getConsumablesPrinters($idPrinter)
    {
        $request = 'SELECT :printBaseInfo, t_consumable.conName, t_consumable.conType, t_consumable.conPrice FROM t_product p
        NATURAL JOIN t_consumable
        NATURAL JOIN t_use
        :printBaseJoin
        WHERE t_use.idProduct = :idPrinter';

        $toBind = array(
            array(
                'name' => 'idPrinter',
                'value' => $idPrinter,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'printBaseInfo',
                'value' => $this->printBaseInfo,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'printBaseJoin',
                'value' => $this->printBaseJoin,
                'type' => PDO::PARAM_STR
            )
        );
        $this->prepareExecute($request, $toBind);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les 5 meilleurs produits en fonction de leur statistiques de ventes sur les trois ans // Retrieve the five best products based on their sales statistics over the last three years
     *
     * @return void
     */
    function getBestPrinters()
    {
        $request = '';
        $this->queryExecute($request);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une string d'imprimante compatible avec un idConsumable // Retrieve some information of a consumable and a list of all compatible printers
     *
     * @param [int] $idConsumable
     * @return void
     */
    function getPrintersAndConsumables($idProduct,$orderCol,$order)
    {
        $toBind = array(
            array(
                'name' => 'orderCol',
                'value' => $orderCol,
                'type' => PDO::PARAM_STR
            ),
            array(
                'name' => 'order',
                'value' => $order,
                'type' => PDO::PARAM_STR
            )
        );
        if($idProduct == 0){
            $whereClause = "";
        }
        else{
            $whereClause = "WHERE t_product.idProduct = :idProduct";
            $valueID = array(
                'name' => 'idProduct',
                'value' => $idProduct,
                'type' => PDO::PARAM_INT
            );
            array_push($toBind,$valueID);
        }

        $request = 'SELECT t_product.proName, t_brand.braName,
        GROUP_CONCAT(DISTINCT conName SEPARATOR ", ") AS "Consumables"
        FROM t_consumable
        NATURAL JOIN t_product
        NATURAL JOIN t_brand
        '.$whereClause.'
        GROUP BY t_product.proName
        ORDER BY :orderCol :order';
        
        $this->prepareExecute($request, $toBind);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }


    /**
     * Undocumented function
     *
     * @param [type] $idConsumable
     * @return void
     */
    function getConsumablesAndPrinters($idConsumable){
        $request = 'SELECT conName, conType, t_brand.braName, conPrice,
        GROUP_CONCAT(DISTINCT t_product.proName SEPARATOR ", ") AS "Printers"
        FROM t_consumable
        NATURAL JOIN t_product
        NATURAL JOIN t_brand
        WHERE t_consumable.idConsumable = :idConsumable
        GROUP BY conName
        ORDER BY conName';
        $toBind = array(
            
            array(
                'name' => 'idConsumable',
                'value' => $idConsumable,
                'type' => PDO::PARAM_STR
            ),
        );
    $this->prepareExecute($request, $toBind);
    return $this->fetchData(PDO::FETCH_ASSOC);
    }
}
