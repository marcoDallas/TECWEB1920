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
        $content='<div id="content" class="body_column content">
                    <h2>'.$_GET['type'].'</h2>';
        if(Admin::verify()){
            $content.='<form class="general_form inline" method="post" action="modifica_prodotto.php">
                        <p>
                         <input type="hidden" name="prevpage" value="'.$_SERVER['REQUEST_URI'].'"/>
                         <input type="hidden" name="type" value="'.$_GET['type'].'"/>
                         <input class="general_button" type="submit" name="add" value="Aggiungi Prodotto"/>
                        </p> 
                       </form>';
        }
        $content.='<form class="general_form inline" id="ricerca_prodotti" method="get" action="prodotti.php">
                    <p>
                     <label for="cercaProdotti">Cerca '.$_GET['type'].': </label>
                     <input class="general_input" type="text" id="cercaProdotti" name="search"/>
                     <input type="hidden" name="type" value="'.$_GET['type'].'"/>
                     <input class="general_button" type="submit" value="cerca"/>
                    </p>    
                </form>';
        if($arr){
            if(!isset($_GET['page']))
                $_GET['page']=1;
            if(!array_slice($arr,intval($_GET['page'])*7-7,7))
                $_GET['page']=1;
            if(sizeof($arr)>10){
                $arrpage=array_slice($arr,intval($_GET['page'])*7-7,7);
            }else
                $arrpage=$arr;

            $content.='<ul>';
            foreach($arrpage as &$prodotto){

                $content.='<li class="product">
                            <div class="box full_column element" tabindex="0">
                                <div class="img_product">';
                if(!strcmp($prodotto['Immagine'],''))
                    $content.='<p>Forse l\'admin non ha inserito la foto <abbr title="cosa triste">:\'(</abbr></p>';
                else
                    $content.='<img class="product_image" src="'.$prodotto['Immagine'].'" alt="Immagine della sezione '.$_GET['type'].' : '.$prodotto['Nome'].'"/>';
                                    
                $content.='</div>
                                <div class="cont_product">
                                    <h3>'.$prodotto['Nome'].'</h3>
                                    <p>'.$prodotto['Descrizione'].'</p>
                                </div>';
                if(Admin::verify()){
                    $content.='<form class="general_form" method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'">
                                <p>
                                 <input type="hidden" name="product" value="'.$prodotto['Codice'].'"/>
                                 <input class="general_button" type="submit" name="remove" value="Rimuovi prodotto"/>
                                </p> 
                               </form>
                               <form class="general_form" method="post" action="modifica_prodotto.php">
                                <p>
                                 <input type="hidden" name="id" value="'.$prodotto['Codice'].'"/>
                                 <input type="hidden" name="prevpage" value="'.htmlentities($_SERVER['REQUEST_URI']).'"/>
                                 <input type="hidden" name="type" value="'.$_GET['type'].'"/>
                                 <input class="general_button" type="submit" name="edit" value="Modifica prodotto"/>
                                </p> 
                            </form>';
                }
                $content.='</div>
                        </li>';
            }
            $content.='</ul>';
            if(sizeof($arr)>10){
                $content.='<div id="nav_page">';
                $nextpage=$_GET['page']+1;
                if($_GET['page']>1){
                    $previouspage=$_GET['page']-1;
                    $content.='<a class="general_button anchor_button" href="?type='.$_GET['type'].'&amp;page='.$previouspage.'">Pagina precedente</a>';
                }
                if(array_slice($arr,intval($_GET['page'])*7-7,7))
                    $content.='<a class="general_button anchor_button" href="?type='.$_GET['type'].'&amp;page='.$nextpage.'">Pagina successiva</a>';

                $content.='</div>';
            }
        }else{
            $content.='<p>Nessun prodotto trovato</p>';
        }
        $content.='</div>';
        return $content;
    }
    
    public function print_paste(){
        return $this->print_pr($this->arr_prodotti->get_paste());
    }

    public function print_torte(){
        return $this->print_pr($this->arr_prodotti->get_torte());
    }

    public function print_searcheable_paste($to_search){
        return $this->print_pr($this->arr_prodotti->search_paste($to_search));
    }

    public function print_searcheable_torte($to_search){
        return $this->print_pr($this->arr_prodotti->search_torte($to_search));
    }

}

?>