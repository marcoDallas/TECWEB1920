 
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
        $path = (new Get_products())->get_image($_POST['product']);
        unlink($path['Immagine']);
        return (new Get_products())->delete_product($_POST['product']);
    }

    public static function edit(){
        require_once 'backend/get_products.php';
        if(isset($_POST['title']) && isset($_POST['type']) && isset($_POST['description'])){
            require_once 'backend/input_security_check.php';
            $title = Input_security_check::general_input_check($_POST['title']);
            $type = Input_security_check::general_input_check($_POST['type']);
            $image='';
            if(is_uploaded_file($_FILES['image']['tmp_name'])){
                $image = '../images/uploaded/'.$_FILES['image']['name'];
                Edit_products::upload_image();
                if(isset($_POST['oldimage'])){
                    @unlink($_POST['oldimage']);
                }
            }
            $description = Input_security_check::general_input_check($_POST['description']);
            if(isset($_POST['id'])){
                if(strcmp($image,'')){
                    (new Get_products())->edit_product($_POST['id'],$type,$title,$description,$image);
                }else{
                    (new Get_products())->edit_product_noimage($_POST['id'],$type,$title,$description);
                }
            }else if(strcmp($image,''))
                (new Get_products())->add_product($type,$title,$description,$image);
            else
                (new Get_products())->add_product_noimage($type,$title,$description);
        }
        return FALSE;
    }

    public static function upload_image(){
        if (!isset($_FILES['image']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
            return;    
        }
        $uploaddir = '../images/uploaded/';
        $userfile_tmp = $_FILES['image']['tmp_name'];
        $userfile_name = $_FILES['image']['name'];

        if (!move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) 
            echo 'Upload NON riuscito!'; 
    }

}
?>
