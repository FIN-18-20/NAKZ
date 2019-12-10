<?php

/**
 * @author Nicolas Benitez, Alexandre Jaquier
 * @email nicolas.benitez@eduvaud.ch, alexandre.jaquier@eduvaud.ch
 * @create date 2019-12-03 10:44:40
 * @modify date 2019-12-10 08:44:28
 * @desc [classe database pour les requêtes SQL]
 */

class database
{

    protected $connector;
    protected $req;
    public $result;
    protected $printBaseInfo = "t_product.proName,t_brand.braName,t_manufacturer.manName, (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = t_product.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) AS \"priPrice\" ";
    protected $printBaseJoin = "NATURAL JOIN t_brand
    NATURAL JOIN t_manufacturer
    NATURAL JOIN t_history";

    /**
     * Constructeur de la classe database
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
     * Déstructeur de la classe database
     */
    function __destruct()
    {
        $this->connector = null;
    }

    /**
     * Fonction d'exécution d'une requête SQL non préparée
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
     * Fonction d'exécution d'une requête SQL préparée
     * À utiliser pour éviter l'injection SQL
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
        $this->req->execute();
    }

    /* EXEMPLE DE REQUÊTE UTILISANT LE PREPARE
     function getTeacherSection($id)
    {
        $request = ('SELECT s.secName
        FROM t_section s
        JOIN t_teach ON s.idSection = t_teach.idSection
        WHERE t_teach.idTeacher = :id');
        $toBind = array(array(
            'name' => 'id',
            'value' => $id,
            'type' => PDO::PARAM_INT
        ));
        $this->prepareExecute($request, $toBind);
        return $this->fetchData(PDO::FETCH_COLUMN);
    }
     */

    /**
     * Traite et transforme le résultat d'une query selon les besoins
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
     * Vide le jeu d'enregistrements
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
     * Récupère les informations générales d'une imprimante
     *
     * @return void
     */
    function getPrinterDetail($idPrinter)
    {
        $request = 'SELECT p.*,t_brand.braName,t_manufacturer.manName ,GROUP_CONCAT(DISTINCT t_consumable.idConsumable SEPARATOR ", ") "idsCon" , 
        (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = p.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) AS "priPrice" 
        FROM t_product p
        NATURAL JOIN t_use
        NATURAL JOIN t_consumable
        :printBaseJoin
        WHERE p.idProduct = :idPrinter';

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
     * Récupère les informations générales d'un consommable
     *
     * @return void
     */
    function getConsumableDetail(){
        $request = 'SELECT t_consumable.idConsumable, t_consumable.conName, t_consumable.conType, t_brand.braName, t_consumable.conPrice FROM t_consumable
        NATURAL JOIN t_brand';
        $this->queryExecute($request);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère et classe les imprimantes par vitesse d'impression noir/blanc
     *
     * @return void
     */
    function printersByBWSpeed()
    {
        $request = 'SELECT :printBaseInfo, p.proPrintSpeedBW FROM t_product p 
        :printBaseJoin
        ORDER BY p.proPrintSpeedBW LIMIT 10';
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
     * Récupère et classe les imprimantes par marques
     *
     * @return void
     */
    function printersByBrand()
    {
        $request = 'SELECT t_product.*, t_brand.braName,t_manufacturer.braName, (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = p.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) AS "priPrice"  
        FROM t_product p
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
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère et classe les imprimantes par taille
     *
     * @param [string] $order
     * @return void
     */
    function printersBySize($order)
    {
        $request = 'PD';
        $this->queryExecute($request);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère et classe les imprimantes par poids
     *
     * @param [string] $order
     * @return void
     */
    function printersByWeight($order)
    {
        $request = 'SELECT :printBaseInfo, t_product.proWeight FROM t_product
        :printBaseJoin
        ORDER BY t_product.proWeight ' . $order;
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
     * Récupère la date et la valeur d'un prix pour montrer son évolution
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
     *//*
    function getActualPrice(){
        $request = 'SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = 1 ORDER BY t_history.hisDate DESC LIMIT 1';
        $this->queryExecute($request);
        return $this->fetchData(PDO::FETCH_ASSOC);
    }*/

    /**
     * Récupère les trois produits les plus chers
     *
     * @param [string] $order
     * @return void
     */
    function getExpensivePrinters($order)
    {
        $request = 'SELECT :printBaseInfo, (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = p.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) FROM t_product p 
        :printBaseJoin
        GROUP BY p.idProduct ORDER BY t_history.hisPrice ' . $order . ' LIMIT 3';
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
     * Récupère les consommables compatibles avec un produit
     *
     * @param [string] $printer
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
     * Récupère les 5 meilleurs produits en fonction de leur statistiques de ventes sur les trois ans
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
     * Undocumented function
     *
     * @param [type] $idConsumable
     * @return void
     */
    function getConsumableAndPrinters($idConsumable){
        $request = 'SELECT conName, conType, t_brand.braName, conPrice,
        GROUP_CONCAT(DISTINCT t_product.proName SEPARATOR ", ") AS "Printers"
        FROM t_consumable
        NATURAL JOIN t_product
        NATURAL JOIN t_brand
        WHERE t_consumable.idConsumable = 1
        GROUP BY conName
        ORDER BY conName';

    $this->prepareExecute($request, $toBind);
    return $this->fetchData(PDO::FETCH_ASSOC);
    }
}
