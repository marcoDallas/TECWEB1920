 
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
        if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['type']) && isset($_POST['description'])){
            (new Get_products())->edit_product($_POST['id'],$_POST['type'],$_POST['title'],$_POST['description']);
        }else if(isset($_POST['title']) && isset($_POST['type']) && isset($_POST['description'])){
            (new Get_products())->add_product($_POST['type'],$_POST['title'],$_POST['description']);
        }
        return FALSE;
    }

}
?>
