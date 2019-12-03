<?php

/**
 * @author Nicolas Benitez, Alexandre Jaquier
 * @email nicolas.benitez@eduvaud.ch, alexandre.jaquier@eduvaud.ch
 * @create date 2019-12-03 10:44:40
 * @modify date 2019-12-03 11:41:00
 * @desc [classe database pour les requêtes SQL]
 */

class database {

    protected $connector;
    protected $req;
    public $result;

    /**
     * constructeur de la classe database
     */
    function __construct()
    {
        try{
            $this->connector = new PDO('mysql:host=localhost;dbname=db_printers;charset=utf8' , 'root' , 'root');
        }

        catch (PDOException $e){
            echo "Un problème est survenu avec la base de donnée, veuillez réessayer plus tard." . " " .  $e;
        }
    }

    /**
     * Undocumented function
     */
    function __destruct()
    {
        $this->connector = null; 
    }

    /**
     * Fonction d'exécution d'une requête SQL non préparée
     *
     * @param [type] $query
     * @return void
     */
    function queryExecute($query){
        if (isset($this->req)) {
            $this->closeCursor();
        }
        $this->req = $this->connector->query($query);
    }

    /**
     * Fonction d'exécution d'une requête SQL préparée
     * À utiliser pour éviter l'injection SQL
     * TODO : Améliorer...
     * @param [type] $query
     * @param [type] $values
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
     * Undocumented function
     *
     * @param [type] $mode
     * @return void
     */
    function fetchData($mode){
        $result = $this->req->fetchALL($mode);
        return $result;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function closeCursor(){
        if (isset($this->req)) {
            $this->req->closeCursor();
        }
    }

    function getPrinterDetail(){
        $request = 'SELECT p.*, GROUP_CONCAT(DISTINCT t_consumable.idConsumable SEPARATOR ", ") "idsCon" , 
        (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = p.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) AS "priPrice" 
        FROM t_product p
        NATURAL JOIN t_history
        NATURAL JOIN t_use
        NATURAL JOIN t_consumable
        NATURAL JOIN t_brand
        WHERE p.idProduct = 1';
/*PD*/
    }

    function printersByBWSpeed(){
        $request = 'SELECT p.proName, proPrintSpeedBW FROM t_product p ORDER BY proPrintSpeedBW LIMIT 10';
    }

    function printersByBrand(){
        $request = 'SELECT t_product.*, t_brand.braName FROM t_product
        NATURAL JOIN t_brand
        ORDER BY t_product.idBrand';
    }

    function printersBySize($order){
        if ($order== "croissant") {
            $mode = "ASC";
        } else {
            $mode = "DESC";
        }
        $request = '';
    }

    function printersByWeight($order){
        if ($order== "croissant") {
            $mode = "ASC";
        } else {
            $mode = "DESC";
        }
        $request = 'SELECT t_product.proName, t_product.proWeight FROM t_product
        ORDER BY t_product.proWeight ' . $mode;
    }

    function priceEvolution(){
        $request = 'SELECT t_history.hisPrice, t_history.hisDate FROM t_history WHERE t_history.idProduct = 1 ORDER BY t_history.hisDate ASC';
    }

    function getActualPrice(){
        $request = 'SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = 1 ORDER BY t_history.hisDate DESC LIMIT 1';
    }

    function getExpensivePrinters($order){
        if ($order== "croissant") {
            $mode = "ASC";
        } else {
            $mode = "DESC";
        }
        $request = 'SELECT p.proName, (SELECT t_history.hisPrice FROM t_history WHERE t_history.idProduct = p.idProduct ORDER BY t_history.hisDate DESC LIMIT 1) FROM t_product p 
        NATURAL JOIN t_history
        GROUP BY p.idProduct ORDER BY t_history.hisPrice '.$mode.' LIMIT 3';
    }

    function getConsumablesPrinters(){
        $request = '';
    }

    function getBestPrinters(){
        $request = '';
    }
}

?>