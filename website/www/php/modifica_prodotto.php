<?php
require_once('backend/sessions.php');
require_once('backend/admin.php');
Sessions::init_session();
if(!Admin::verify() || ( (!isset($_POST['edit']) || !isset($_POST['id']) || !isset($_POST['prevpage'])) && ( !isset($_POST['add'] ) ))){
    header('Location: fallback.php');
}
if(Admin::verify()){
    require_once 'backend/edit_news.php';
    Edit_news::edit();
}
$edit=TRUE;
if(isset($_POST['add']))
    $edit=FALSE;

require_once('backend/print_content.php');
require_once('backend/utilities.php');
require_once('backend/print_news.php');
require_once('backend/get_products.php');

$DOM = file_get_contents('../html/template.html');

$DOM = str_replace('<title_page_to_insert/>','Modifica Prodotto',$DOM);
$DOM = str_replace('<no_index_to_insert/>','<meta name="robots" content="noindex">',$DOM);
$DOM = str_replace('<login_error_to_insert/>','',$DOM);
$DOM = str_replace('<logo_to_insert/>',Print_content::logo(Utilities::get_page_name()),$DOM);
$DOM = str_replace('<title_h1_to_insert/>','Modifica Prodotto',$DOM);
$DOM = str_replace('<breadcrumb_path_to_insert/>','<strong>Modifica Prodotto</strong>',$DOM);
$DOM = str_replace('<menu_to_insert/>',Print_content::menu('modifica_prodotto.php'),$DOM);

require_once('backend/edit_news.php');
Edit_news::edit();

$news = new Print_news();
$DOM = str_replace('<news_title_to_replace/>',$news->title(),$DOM);
$DOM = str_replace('<news_content_to_replace/>',$news->content(),$DOM);
unset($news);

$DOM = str_replace('<edit_news_admin_to_replace/>',Print_news::admin_zone(),$DOM);

$DOM = str_replace('<timetable_to_insert/>',file_get_contents('../html/components/timetable.html'),$DOM);

if($edit)
    $product = (new Get_products())->search_by_code($_POST['id']);

$content = file_get_contents('../html/components/edit.html');
$content = str_replace('<title_h2_to_insert/>','Da questa pagina puoi aggiungere/modificare un prodotto',$content);
$content = str_replace('<prev_page_to_insert/>','<form enctype="multipart/form-data" id="edit_form" class="general_form" method="post" action="'.$_POST['prevpage'].'">',$content);
if($edit)
    $input="Modifica ".$product['Nome'];
else $input="Aggiungi Prodotto";
$content = str_replace('<legend_to_insert/>',$input,$content);
if($edit)
    $input=$product['Nome'];
else
    $input="";
$content = str_replace('<title_to_insert/>','<input class="general_input" type="text" name="title" id="title" value="'.$input.'"/>',$content);
if($edit)
    $input=$product['Descrizione'];

$content = str_replace('<content_to_insert/>',$input,$content);
$content = str_replace('<type_to_insert/>','<input type=hidden name="type" value="'.substr($_POST['type'],0,-1).'a'.'"/>',$content);
$path='';
if($edit){
    $path=$product['Immagine'];
}
$content = str_replace('<file_to_insert/>','<img id="preview" src="'.$path.'" alt=""><div class="input_line"><label for="image">Cambia immagine: </label><input name="image" type="file" id="image" onclick="input_image(this)"/></div><input type="hidden" name="oldimage" value="'.$path.'"/>',$content);
$content = str_replace('<submit_to_insert/>','<input id="edit_form_submit" class="general_button" type="submit" value="Modifica" name="writeEdits"/>',$content);
if($edit)
    $content = str_replace('<id_to_insert/>','<input type="hidden" value="'.$_POST['id'].'" name="id"/>',$content);

$DOM = str_replace('<page_to_insert/>',$content,$DOM);
$DOM = str_replace('<login_admin_to_insert/>',Print_content::admin_form(),$DOM);

echo($DOM);

?>