 
<?php
/*
 *  Classe per la gestione dei prodotti
 */

require_once('database_connection.php');

class Get_products{

    private $prodotti='';

    public function __construct(){
        $this->prodotti = new database_connection();
    }

    public function get_paste(){
        return $this->prodotti->execute("select * from Prodotto where TipoProdotto LIKE 'Pasta'");
    }

    public function get_torte(){
         return mysqli_fetch_all($this->prodotti->execute("select * from Prodotto where TipoProdotto LIKE 'Torta'"));
    }

}
?>
