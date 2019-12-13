 
<?php
/*
 *  Classe per la modifica delle news
 */

class Edit_news{

    public static function edit(){
        if(isset($_POST['submitEditNews']) && isset($_POST['title']) && isset($_POST['description'])){
            require_once 'backend/input_security_check.php';
            $title = Input_security_check::general_input_check($_POST['title']);
            $description = Input_security_check::general_input_check($_POST['description']);
            if(!$title || !$description){
                error_log("Security check failed");
                return FALSE;
            }
            include_once('backend/get_news.php');
            (new Get_news())->set_news($title,$description);
        }
        return FALSE;
    }

}
?>
