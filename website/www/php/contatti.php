<?php
require_once('backend/admin.php');
require_once('backend/print_content.php');
require_once('backend/utilities.php');
require_once('backend/print_news.php');

$DOM = file_get_contents('../html/template.html');

$DOM = str_replace('<title_page_to_insert/>','Contatti',$DOM);
$DOM = str_replace('<no_index_to_insert/>','',$DOM);
$DOM = str_replace('<login_error_to_insert/>',Admin::init_admin(),$DOM);
$DOM = str_replace('<logo_to_insert/>',Print_content::logo(Utilities::get_page_name()),$DOM);
$DOM = str_replace('<title_h1_to_insert/>','Come e quando puoi contattarci',$DOM);
if(Admin::verify())
    $DOM = str_replace('<breadcrumb_path_to_insert/>','<strong>Contatti (Amministratore)</strong>',$DOM);
else
    $DOM = str_replace('<breadcrumb_path_to_insert/>','<strong>Contatti</strong>',$DOM);
$DOM = str_replace('<menu_to_insert/>',Print_content::menu('contatti.php'),$DOM);

if(Admin::verify()){
    require_once 'backend/edit_news.php';
    Edit_news::edit();
}
$news = new Print_news();
$DOM = str_replace('<news_title_to_replace/>',$news->title(),$DOM);
$DOM = str_replace('<news_content_to_replace/>',$news->content(),$DOM);
unset($news);

if(Admin::verify())
    $DOM = str_replace('<edit_news_admin_to_replace/>',Print_news::admin_zone(),$DOM);
else
    $DOM = str_replace('<edit_news_admin_to_replace/>','',$DOM);

$DOM = str_replace('<timetable_to_insert/>','',$DOM);
$DOM = str_replace('<page_to_insert/>',file_get_contents('../html/contatti.html'),$DOM);
$DOM = str_replace('<footer_to_replace/>','<footer id="footer" class="box full_column print_hide">',$DOM);
$DOM = str_replace('<login_admin_to_insert/>',Print_content::admin_form(),$DOM);

echo($DOM);
?>