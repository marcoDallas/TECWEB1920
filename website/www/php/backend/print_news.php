<?php
/*
 * Classe per stampare i prodotti nella pagina prodotti.php
 */
require_once('get_news.php');
require_once('admin.php');

class Print_news{

    private $news;

    public function __construct(){
        $this->news = new Get_news();
    }
    
    public function print_news(){
        $content=$this->news->get_news();
        echo('<div class="news_container">');
        echo('<p class="news_title">'.$content['Titolo'].'</p>');
        echo('<p class="news_content">'.$content['Contenuto'].'</p>');
        if(Admin::verify()){
            echo('<form class="general_form" method="post" action="modifica_news.php">');
            echo('<input type="hidden" name="prevpage" value="'.$_SERVER['REQUEST_URI'].'"/>');
            echo('<input class="general_button" type="submit" name="editNews" value="Modifica news" tabindex="10"/>');
            echo('</form>');
        }
        echo('</div>');
    }
}

?>