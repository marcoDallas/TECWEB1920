<?php
/*
 * Classe per stampare i prodotti nella pagina prodotti.php
 */
require_once('get_news.php');
require_once('sessions.php');

class Print_news{

    private $news;

    public function __construct(){
        $this->news = new Get_news();
    }
    
    public function print_news(){
        $content=$this->news->get_news();
        echo('<div class="news_container">');
        echo('<p class="news_title">'.$content['Title'].'</p>');
        echo('<p class="news_content">'.$content['Content'].'</p>');
        if(Sessions::session_exists('admin') && Sessions::get_value('admin')==TRUE){
            echo('<a href="#modifica">modifica sezione news</a>');
        }
        echo('</div>');
    }
}

?>