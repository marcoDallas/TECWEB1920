 
<?php
require_once('backend/admin.php');
Admin::init_admin();
require_once('backend/print_content.php');
require_once('backend/utilities.php');
require_once('backend/print_news.php');
$DOM = file_get_contents('../html/template.html');
$DOM = str_replace('<title_page_to_insert/>', 'Fallback', $DOM);
$DOM = str_replace('<meta_title_to_insert/>', '<meta name="title" content="Fallback - Pasticceria Padovana"/>', $DOM);
$DOM = str_replace('<meta_description_to_insert/>', '<meta name="description" content="La Pasticceria Padovana, ti perderai tra una moltitudine di paste e torte" />', $DOM);
$DOM = str_replace('<meta_keyword_to_insert/>', '<meta name="keywords" content="Pasticceria,Veneto,Padova,Padovana,Perso"/>', $DOM);

$DOM = str_replace('<no_index_to_insert/>', '<meta name="robots" content="noindex"/>', $DOM);
$DOM = str_replace('<logo_to_insert/>', Print_content::logo(Utilities::get_page_name()), $DOM);
$DOM = str_replace('<title_h1_to_insert/>', 'Ti sei perso?', $DOM);
if (Admin::verify()) {
    $DOM = str_replace('<breadcrumb_path_to_insert/>', '<strong><span xml:lang="en">Fallback</span> (Amministratore)</strong>', $DOM);
} else {
    $DOM = str_replace('<breadcrumb_path_to_insert/>', '<strong xml:lang="en">Fallback</strong>', $DOM);
}
$DOM = str_replace('<menu_to_insert/>', Print_content::menu('fallback.php'), $DOM);

if (Admin::verify()) {
    require_once 'backend/edit_news.php';
    Edit_news::edit();
}
$news = new Print_news();
$DOM = str_replace('<news_title_to_replace/>', $news->title(), $DOM);
$DOM = str_replace('<news_content_to_replace/>', $news->content(), $DOM);
unset($news);

if (Admin::verify()) {
    $DOM = str_replace('<edit_news_admin_to_replace/>', Print_news::admin_zone(), $DOM);
} else {
    $DOM = str_replace('<edit_news_admin_to_replace/>', '', $DOM);
}

$DOM = str_replace('<timetable_to_insert/>', file_get_contents('../html/components/timetable.html'), $DOM);
$DOM = str_replace('<page_to_insert/>', file_get_contents('../html/fallback.html'), $DOM);
$DOM = str_replace('<footer_to_replace/>', '<div id="footer" class="container col-sm-1">', $DOM);
$DOM = str_replace('<login_admin_to_insert/>', Print_content::admin_form(), $DOM);

echo($DOM);
?>
