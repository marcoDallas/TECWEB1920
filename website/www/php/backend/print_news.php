<?php
/*
 * Classe per stampare i prodotti nella pagina prodotti.php
 */
require_once('get_news.php');
require_once('admin.php');
require_once('input_security_check.php');

class Print_news{

    private $news;
    private $content;

    public function __construct(){
        $this->news = new Get_news();
        $this->content = $this->news->get_news();
    }
    
    public function title(){
        return Input_security_check::tag_check($this->content['Titolo']);
    }

    public function content(){
        return Input_security_check::tag_check($this->content['Contenuto']);
    }

    public static function admin_zone(){
        return '<form class="general_form" method="post" action="modifica_news.php">
                 <p>
                  <input type="hidden" name="prevpage" value="'.htmlentities($_SERVER['REQUEST_URI']).'"/>
                  <input class="general_button" type="submit" name="editNews" value="Modifica news" tabindex="0"/>
                 </p>
                </form>';
    }
}

?>