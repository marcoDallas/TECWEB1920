<?php
/*
 * Classe per stampare i prodotti nella pagina prodotti.php
 */
require_once('get_products.php');
require_once('admin.php');

class Print_products
{
    private $arr_prodotti;

    public function __construct()
    {
        $this->arr_prodotti = new Get_products();
    }

    public function print_pr($arr)
    {
        $content='<div id="content" class="col-sm-1 col-ds-1 content">
                    <h2>'.$_GET['type'].'</h2>';
        
        $content.='<form class="general_form col-sm-1" method="get" action="prodotti.php">
                    <div class="col-sm-1">
                     <label for="cercaProdotti">Cerca '.$_GET['type'].': </label>
                     <input class="general_input" type="text" maxlength="40" id="cercaProdotti" name="search"/>
                     <input type="hidden" name="type" value="'.$_GET['type'].'"/>
                     <input class="general_button" type="submit" value="cerca" aria-label="Cerca"/>
                    </div>    
                </form>';
        if ($arr) {
            if (!isset($_GET['page'])) {
                $_GET['page']=1;
            }
            if (!array_slice($arr, intval($_GET['page'])*7-7, 7)) {
                $_GET['page']=1;
            }
            if (sizeof($arr)>10) {
                $arrpage=array_slice($arr, intval($_GET['page'])*7-7, 7);
            } else {
                $arrpage=$arr;
            }

            $content.='<ul>';
            foreach ($arrpage as &$prodotto) {
                $content.='<li class="product">
                            <div class="container col-sm-1 element">
                                <div class="product_image_container">';
                if (!strcmp($prodotto['Immagine'], '')) {
                    $content.='<p>Forse l\'admin non ha inserito la foto  title="cosa triste">:\'(</abbr></p>';
                } else {
                    $content.='<img class="product_image" src="'.$prodotto['Immagine'].'" alt="Immagine della sezione '.$_GET['type'].' : '.$prodotto['Nome'].'"/>';
                }
                                    
                $content.='</div>
                                <div class="product_text_container">
                                    <h3>'.$prodotto['Nome'].'</h3>
                                    <p>'.$prodotto['Descrizione'].'</p>
                                </div>';
                if (Admin::verify()) {
                    $content.='<div class="col-sm-1 product_buttons">
                                <form method="post" action="'.htmlentities($_SERVER['REQUEST_URI']).'">
                                    <div>
                                        <input type="hidden" name="product" value="'.$prodotto['Codice'].'"/>
                                        <input class="general_button" type="submit" name="remove" value="Rimuovi prodotto" aria-label="Rimuovi prodotto"/>
                                    </div> 
                               </form>
							   
                               <form method="post" action="modifica_prodotto.php">
                                    <div>
                                        <input type="hidden" name="id" value="'.$prodotto['Codice'].'"/>
                                        <input type="hidden" name="prevpage" value="'.htmlentities($_SERVER['REQUEST_URI']).'"/>
                                        <input type="hidden" name="type" value="'.$_GET['type'].'"/>
                                        <input class="general_button" type="submit" name="edit" value="Modifica prodotto" aria-label="Modifica prodotto"/>
                                    </div>
                                </form>
							</div>';
                }
                $content.='</div>
                        </li>';
            }
            $content.='</ul>';
            if (sizeof($arr)>7) {
                $content.='<div id="nav_page">';
                $nextpage=$_GET['page']+1;
                if ($_GET['page']>1) {
                    $previouspage=$_GET['page']-1;
                    $content.='<a class="general_button nav_button" href="?type='.$_GET['type'].'&amp;page='.$previouspage.'">Indietro</a>';
                }else{
                    $content.='<a class="general_button nav_button not_visible">Pagina precedente</a>';
                }
                $content.='<span id="page_number">Pagina '.$_GET['page'].'</span>';
                if ((sizeof($arr)-$_GET['page']*7) > 0) {
                    $content.='<a class="general_button nav_button" href="?type='.$_GET['type'].'&amp;page='.$nextpage.'">Avanti</a>';
                }else{
                    $content.='<a class="general_button nav_button not_visible">Pagina successiva</a>';
                }
                
                $content.='</div>';
                if (Admin::verify()) {
                    $content.='<form class="general_form col-sm-1" method="post" action="modifica_prodotto.php">
                                <div>
                                 <input type="hidden" name="prevpage" value="'.htmlentities($_SERVER['REQUEST_URI']).'"/>
                                 <input type="hidden" name="type" value="'.$_GET['type'].'"/>
                                 <input class="general_button" type="submit" name="add" value="Aggiungi Prodotto" aria-label="Aggiungi prodotto"/>
                                </div> 
                               </form>';
                }
            }
        } else {
            $content.='<p>Nessun prodotto trovato</p>
                       <img class="general_image" src="../images/img_fallback_and_empty_search.jpg" alt="Immagine di un pasticcere in stile cartone animato" />';
        }
        $content.='</div>';
        return $content;
    }
    
    public function print_paste()
    {
        return $this->print_pr($this->arr_prodotti->get_paste());
    }

    public function print_torte()
    {
        return $this->print_pr($this->arr_prodotti->get_torte());
    }

    public function print_searcheable_paste($to_search)
    {
        return $this->print_pr($this->arr_prodotti->search_paste($to_search));
    }

    public function print_searcheable_torte($to_search)
    {
        return $this->print_pr($this->arr_prodotti->search_torte($to_search));
    }
}
?>