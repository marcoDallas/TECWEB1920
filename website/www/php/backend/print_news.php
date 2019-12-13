<?php
/*
 * Classe per stampare i prodotti nella pagina prodotti.php
 */
require_once('get_news.php');
require_once('admin.php');

class Print_news{

    private $news;
    private $content;

    public function __construct(){
        $this->news = new Get_news();
        $this->content = $this->news->get_news();
    }
    
    public function title(){
        return $this->content['Titolo'];
    }

    public function content(){
        return $this->content['Contenuto'];
    }

    public static function admin_zone(){
        return '<form class="general_form" method="post" action="modifica_news.php">
                    <input type="hidden" name="prevpage" value="'.$_SERVER['REQUEST_URI'].'"/>
                    <input class="general_button" type="submit" name="editNews" value="Modifica news" tabindex="10"/>
                </form>';
    }
}

?>