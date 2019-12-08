 
<?php
/*
 *  Classe per la modifica delle news
 */

class Edit_news{

    public static function edit(){
        if(isset($_POST['submitEditNews']) && isset($_POST['title']) && isset($_POST['description'])){
            include_once('backend/get_news.php');
            (new Get_news())->set_news($_POST['title'],$_POST['description']);
        }
        return FALSE;
    }

}
?>
