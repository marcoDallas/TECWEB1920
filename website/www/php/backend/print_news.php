<?php
/*
 * Classe per stampare i prodotti nella pagina prodotti.php
 */
require_once('get_news.php');
require_once('admin.php');
require_once('input_security_check.php');

class Print_news
{
    private $news;
    private $content;
    /* Il costruttore crea un oggetto news e ottiene il loro contenuto */
    public function __construct()
    {
        $this->news = new Get_news();
        $this->content = $this->news->get_news();
    }
    /* Il metodo ritorna il titolo delle news */
    public function title()
    {
        return $this->content['Titolo'];
    }
    /* Il metodo ritorna il contenuto delle news */
    public function content()
    {
        return $this->content['Contenuto'];
    }
    /* Il metodo stampa  il form per la modifica delle news per l'amministratore */
    public static function admin_zone()
    {
        return '<form method="post" action="modifica_news.php">
                 <div>
                  <input type="hidden" name="prevpage" value="'.htmlentities($_SERVER['REQUEST_URI']).'"/>
                  <input class="general_button" type="submit" name="editNews" value="Modifica news" aria-label="Modifica news"/>
                 </div>
                </form>';
    }
}
?>