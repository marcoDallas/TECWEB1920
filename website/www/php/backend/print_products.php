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

    public function print_pr($arr){
        if(!isset($_GET['page']))
            $_GET['page']=1;
        if(sizeof($arr)>10){
            $arrpage=array_slice($arr,$_GET['page'].'0'-10,10);
        }else
            $arrpage=$arr;
        echo('<div class="large_column">');
        echo('<form id="ricercaProdotti" method="get" action="prodotti.php"');
        echo('<label for="cercaProdotti">Cerca '.$_GET['type'].'</label>');
        echo('<input type="hidden" name="type" value="'.$_GET['type'].'"/>');
        echo('<input type="text" id="cercaProdotti" name="search" tabindex="9"/>');
        echo('<input type="submit" value="search" tabindex="10"/>');
        echo('</form>');
        echo('<ul>');
        foreach($arrpage as &$prodotto){
            echo('<li>');
            echo('<div class="box a_column element">');
            echo('<h3>'.$prodotto['Nome'].'</h3>');
            echo('<p>'.$prodotto['Descrizione'].'</p>');
            echo('</div>');
            echo('</li>');
        }
        echo('</ul>');
        if(sizeof($arr)>10){
            $nextpage=$_GET['page']+1;
            if(array_slice($arr,$nextpage.'0'-10,10))
                echo('<a href="?type='.$_GET['type'].'&page='.$nextpage.'">NEXTPAGE</a>');
            if($_GET['page']>1){
                $previouspage=$_GET['page']-1;
                echo('<a href="?type='.$_GET['type'].'&page='.$previouspage.'">PREVIOUSPAGE</a>');
            }
        }
        echo('</div>');
        $this->arr_prodotti->disconnect();
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