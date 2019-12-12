<?php
/*
 * Classe per stampare i prodotti nella pagina prodotti.php
 */
require_once('get_products.php');
require_once('admin.php');

class Print_products{

    private $arr_prodotti;

    public function __construct(){
        $this->arr_prodotti = new Get_products();
    }

    public function print_pr($arr){
        echo('<div class="body_column content">');
        if(Admin::verify()){
            echo('<form class="general_form inline" method="post" action="modifica_prodotto.php">');
            echo('<input type="hidden" name="prevpage" value="'.$_SERVER['REQUEST_URI'].'"/>');
            echo('<input class="general_button" type="submit" name="add" value="Aggiungi Prodotto" tabindex="10"/>');
            echo('</form>');
        }
        echo('<form class="general_form inline" id="ricerca_prodotti" method="get" action="prodotti.php"');
        echo('<label for="cercaProdotti">Cerca '.$_GET['type'].': </label>');
        echo('<input type="hidden" name="type" value="'.$_GET['type'].'"/>');
        echo('<input class="general_input" type="text" id="cercaProdotti" name="search" tabindex="9"/>');
        echo('<input class="general_button" type="submit" value="cerca" tabindex="10"/>');
        echo('</form>');
        if($arr){
            if(!isset($_GET['page']))
                $_GET['page']=1;
            if(!array_slice($arr,$_GET['page'].'0'-10,10))
                $_GET['page']=1;
            if(sizeof($arr)>10){
                $arrpage=array_slice($arr,$_GET['page'].'0'-10,10);
            }else
                $arrpage=$arr;

            echo('<ul>');
            foreach($arrpage as &$prodotto){
                echo('<li class="product">');
                echo('<div class="box full_column element">');
                echo('<div class="img_product">');
                echo('<img src="'.$prodotto['Immagine'].'" alt=""/>');
                echo('</div>');
                echo('<div class="cont_product">');
                echo('<h3>'.$prodotto['Nome'].'</h3>');
                echo('<p>'.$prodotto['Descrizione'].'</p>');
                echo('</div>');
                if(Admin::verify()){
                    echo('<form class="general_form" method="post" action="'.$_SERVER['REQUEST_URI'].'">');
                    echo('<input type="hidden" name="product" value="'.$prodotto['Codice'].'"/>');
                    echo('<input class="general_button" type="submit" name="remove" value="Rimuovi prodotto"/>');
                    echo('</form>');
                    echo('<form class="general_form" method="post" action="modifica_prodotto.php">');
                    echo('<input type="hidden" name="product" value="'.$prodotto['Codice'].'"/>');
                    echo('<input type="hidden" name="prevpage" value="'.$_SERVER['REQUEST_URI'].'"/>');
                    echo('<input class="general_button" type="submit" name="edit" value="Modifica prodotto"/>');
                    echo('</form>');
                }
                echo('</div>');
                echo('</li>');
            }
            echo('</ul>');
            if(sizeof($arr)>10){
                echo('<div id="nav_page">');
                $nextpage=$_GET['page']+1;
                if($_GET['page']>1){
                    $previouspage=$_GET['page']-1;
                    echo('<a class="general_button anchor_button" href="?type='.$_GET['type'].'&page='.$previouspage.'">Pagina precedente</a>');
                }
                if(array_slice($arr,$nextpage.'0'-10,10))
                    echo('<a class="general_button anchor_button" href="?type='.$_GET['type'].'&page='.$nextpage.'">Pagina successiva</a>');

                echo('</div>');
            }
        }else{
            echo('<p>Nessun prodotto trovato</p>');
        }
        echo('</div>');
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