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
        echo('<p class="news_title">'.$content['Title'].'</p>');
        echo('<p class="news_content">'.$content['Content'].'</p>');
        if(Admin::verify()){
            echo('<a href="#modifica">modifica sezione news</a>');
        }
        echo('</div>');
    }
}

?>