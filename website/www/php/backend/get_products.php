 
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
        return mysqli_fetch_all($this->prodotti->execute("select * from Prodotto where TipoProdotto LIKE 'Pasta' order by Nome"),MYSQLI_ASSOC);
    }

    public function get_torte(){
        return mysqli_fetch_all($this->prodotti->execute("select * from Prodotto where TipoProdotto LIKE 'Torta' order by Nome"),MYSQLI_ASSOC);
    }

    public function search_paste($to_search){
        return mysqli_fetch_all($this->prodotti->execute("select * from Prodotto where TipoProdotto LIKE 'Pasta' and Nome LIKE '%$to_search%' order by Nome"),MYSQLI_ASSOC);
    }

    public function search_torte($to_search){
        return mysqli_fetch_all($this->prodotti->execute("select * from Prodotto where TipoProdotto LIKE 'Torta' and Nome LIKE '%$to_search%' order by Nome"),MYSQLI_ASSOC);
    }
}
?>
