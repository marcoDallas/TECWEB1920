<?php
/*
 * Classe per stampare i prodotti nella pagina prodotti.php
 */
require_once('get_products.php');

class Print_products{

    private $arr_prodotti;

    public function __construct(){
        $this->arr_prodotti = new Get_products();
    }

    public static function print_pr($arr){
        foreach($arr as &$prodotto){
            echo('<div class="prodotto">');
            echo('<h3>'.$prodotto['Nome'].'</h3>');
            echo('<p>'.$prodotto['Descrizione'].'</p>');
            echo('</div>');
        }
    }
    
    public function print_paste(){
        $this->print_pr($this->arr_prodotti->get_paste());
    }

    public function print_torte(){
        $this->print_pr($this->arr_prodotti->get_torte());
    }

    public function print_searcheable_paste($to_search){
        $this->print_pr($this->arr_prodotti->search_paste($to_search));
    }

    public function print_searcheable_torte($to_search){
        $this->print_pr($this->arr_prodotti->search_torte($to_search));
    }

}

?>