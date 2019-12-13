 
<?php
/*
 *  Classe per la modifica dei prodotti
 */

class Edit_products{

    public static function check_edit(){
        if(isset($_POST['remove']))
            return Edit_products::remove();
        else if(isset($_POST['writeEdits']))
            return Edit_products::edit();
        return FALSE;
    }
    
    public static function remove(){
        require_once 'backend/get_products.php';
        return (new Get_products())->delete_product($_POST['product']);
    }

    public static function edit(){
        require_once 'backend/get_products.php';
        if(isset($_POST['title']) && isset($_POST['type']) && isset($_POST['description'])){
            require_once 'backend/input_security_check.php';
            $title = Input_security_check::general_input_check($_POST['title']);
            $type = Input_security_check::general_input_check($_POST['type']);
            $description = Input_security_check::general_input_check($_POST['description']);
            if(isset($_POST['id'])){
                (new Get_products())->edit_product($_POST['id'],$type,$title,$description);
            }else{
                (new Get_products())->add_product($type,$title,$description);
            }
        }
        return FALSE;
    }
}
?>
