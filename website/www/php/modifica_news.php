<?php
require_once('backend/sessions.php');
require_once('backend/admin.php');
Sessions::init_session();
if(!Admin::verify() || !isset($_POST['editNews'])){
    header('Location: fallback.php');
}


require_once('backend/print_content.php');
require_once('backend/utilities.php');
require_once('backend/print_news.php');
require_once('backend/get_products.php');

$DOM = file_get_contents('../html/template.html');

$DOM = str_replace('<title_page_to_insert/>','Modifica News',$DOM);
$DOM = str_replace('<no_index_to_insert/>','<meta name="robots" content="noindex">',$DOM);
$DOM = str_replace('<login_error_to_insert/>','',$DOM);
$DOM = str_replace('<logo_to_insert/>',Print_content::logo(Utilities::get_page_name()),$DOM);
$DOM = str_replace('<title_h1_to_insert/>','Modifica News',$DOM);

if(isset($_POST['type'])){
    $prevpage = ucfirst($_POST['type']);
    $DOM = str_replace('<breadcrumb_path_to_insert/>','<strong>'.$prevpage.' / Modifica News</strong>',$DOM);
}else
    $DOM = str_replace('<breadcrumb_path_to_insert/>','<strong>Modifica News</strong>',$DOM);

$DOM = str_replace('<menu_to_insert/>',Print_content::menu('modifica_news.php'),$DOM);


require_once('backend/edit_news.php');
Edit_news::edit();

$news = new Print_news();
$DOM = str_replace('<news_title_to_replace/>',$news->title(),$DOM);
$DOM = str_replace('<news_content_to_replace/>',$news->content(),$DOM);
unset($news);

$DOM = str_replace('<edit_news_admin_to_replace/>','',$DOM);

$DOM = str_replace('<timetable_to_insert/>',file_get_contents('../html/components/timetable.html'),$DOM);

$news = (new Get_news())->get_news();

$content = file_get_contents('../html/components/edit.html');
$content = str_replace('<title_h2_to_insert/>','Da questa pagina puoi modificare la news laterale',$content);
$content = str_replace('<prev_page_to_insert/>','<form enctype="multipart/form-data" id="edit_form" class="general_form" method="post" action="'.$_POST['prevpage'].'">',$content);
$content = str_replace('<legend_to_insert/>','Modifica News',$content);
$content = str_replace('<title_to_insert/>','<input class="general_input" type="text" name="title" id="title" value="'.$news['Titolo'].'"/>',$content);
$content = str_replace('<content_to_insert/>',$news['Contenuto'],$content);
$content = str_replace('<file_to_insert/>','',$content);
$content = str_replace('<submit_to_insert/>','<input id="edit_form_submit" class="general_button" type="submit" value="Modifica" name="submitEditNews"/>',$content);

$DOM = str_replace('<page_to_insert/>',$content,$DOM);
$DOM = str_replace('<footer_to_replace/>','<footer id="footer" class="box full_column">',$DOM);
$DOM = str_replace('<login_admin_to_insert/>',Print_content::admin_form(),$DOM);

echo($DOM);
?>