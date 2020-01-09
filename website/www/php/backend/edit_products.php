 
<?php
/*
 *  Classe per la modifica dei prodotti
 */

class Edit_products
{
    /* Il metodo controlla se è stata fatta una richiesta di cancellazione o modifica prodotto */
    public static function check_edit()
    {
        if (isset($_POST['remove'])) {
            return Edit_products::remove();
        } elseif (isset($_POST['writeEdits'])) {
            return Edit_products::edit();
        }
        return false;
    }
    /* Il metodo si occupa di rimuovere un prodotto, dato il suo id */
    public static function remove()
    {
        require_once 'backend/get_products.php';
        $path = (new Get_products())->get_image($_POST['product']);
        if (strcmp($path['Immagine'], '')) {
            @unlink($path['Immagine']);
        }
        return (new Get_products())->delete_product($_POST['product']);
    }
    /* Il metodo modifica un prodotto, se supera i controlli (per sicurezza viene controllato anche type) */
    public static function edit()
    {
        require_once 'backend/get_products.php';
        if (isset($_POST['title']) && isset($_POST['type']) && isset($_POST['description'])) {
            require_once 'backend/input_security_check.php';
            $title = Input_security_check::title_input_check($_POST['title']);
            $type = Input_security_check::title_input_check($_POST['type']);
            $image='';
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                $image = '../images/uploaded/'.$_FILES['image']['name'];
                Edit_products::upload_image();
                if (isset($_POST['oldimage'])) {
                    @unlink($_POST['oldimage']);
                }
            }
            $description = Input_security_check::description_input_check($_POST['description']);
            if (!$title || !$description) {
                return false;
            }
            if (isset($_POST['id'])) {
                if (strcmp($image, '')) {
                    (new Get_products())->edit_product($_POST['id'], $type, $title, $description, $image);
                } else {
                    (new Get_products())->edit_product_noimage($_POST['id'], $type, $title, $description);
                }
            } elseif (strcmp($image, '')) {
                (new Get_products())->add_product($type, $title, $description, $image);
            } else {
                (new Get_products())->add_product_noimage($type, $title, $description);
            }
        }
        return false;
    }
    /* Il metodo si occupa di fare l'upload di un immagine */
    public static function upload_image()
    {
        if (!isset($_FILES['image']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
            return;
        }
        $uploaddir = '../images/uploaded/';
        $userfile_tmp = $_FILES['image']['tmp_name'];
        $userfile_name = $_FILES['image']['name'];

        if (!move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
            error_log('Upload NON riuscito!');
        }
    }
}
?>
