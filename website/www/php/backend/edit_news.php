 
<?php
/*
 *  Classe per la modifica delle news
 */

class Edit_news
{
    /* controlla se è stato richiesto di modificare una news, e se passa i controlli, la modifica */ 
    public static function edit()
    {
        if (isset($_POST['submitEditNews']) && isset($_POST['title']) && isset($_POST['description'])) {
            require_once 'backend/input_security_check.php';
            $title = Input_security_check::title_input_check($_POST['title']);
            $description = Input_security_check::description_input_check($_POST['description']);
            if (!$title || !$description) {
                error_log("Security check failed");
                return false;
            }
            include_once('backend/get_news.php');
            (new Get_news())->set_news($title, $description);
        }
        return false;
    }
}
?>
