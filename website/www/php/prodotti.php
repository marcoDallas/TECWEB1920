<?php
if (!isset($_GET['type']) || (strcmp($_GET['type'], 'Paste') && strcmp($_GET['type'], 'Torte'))) {
    header('Location: fallback.php');
}


require_once('backend/admin.php');
require_once('backend/print_content.php');
require_once('backend/utilities.php');
require_once('backend/print_news.php');
require_once('backend/print_products.php');
require_once('backend/input_security_check.php');
    
$DOM = file_get_contents('../html/template.html');
    
$DOM = str_replace('<title_page_to_insert/>', $_GET['type'], $DOM);

$DOM = str_replace('<meta_title_to_insert/>', '<meta name="title" content="Prodotti - Pasticceria Padovana"/>', $DOM);
$DOM = str_replace('<meta_description_to_insert/>', '<meta name="description" content="La Pasticceria Padovana offre uno svariato numero di prodotti, sempre in evoluzione!" />', $DOM);
$DOM = str_replace('<meta_keyword_to_insert/>', '<meta name="keywords" content="Pasticceria,Veneto,Padova,Padovana,Prodotti,Paste,Torte,Panna,Cioccolato" />', $DOM);

$DOM = str_replace('<no_index_to_insert/>', '', $DOM);
Admin::init_admin();
$DOM = str_replace('<logo_to_insert/>', Print_content::logo(Utilities::get_page_name()), $DOM);
if (!strcmp($_GET['type'], 'Paste')) {
    $DOM = str_replace('<title_h1_to_insert/>', 'Una vasta gamma di paste, ti basta solo scegliere', $DOM);
} elseif (!strcmp($_GET['type'], 'Torte')) {
    $DOM = str_replace('<title_h1_to_insert/>', 'Una vasta gamma di torte, ti basta solo scegliere', $DOM);
}

if (Admin::verify()) {
    $DOM = str_replace('<breadcrumb_path_to_insert/>', '<strong>'.$_GET['type'].' (Amministratore)</strong>', $DOM);
} else {
    $DOM = str_replace('<breadcrumb_path_to_insert/>', '<strong>'.$_GET['type'].'</strong>', $DOM);
}

$DOM = str_replace('<menu_to_insert/>', Print_content::menu('prodotti.php?type='.$_GET['type']), $DOM);
    
if (Admin::verify()) {
    require_once 'backend/edit_products.php';
    Edit_products::check_edit();
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


$content = new Print_products();
if (!strcmp($_GET['type'], 'Paste')) {
    if (isset($_GET['search'])) {
        $products = $content->print_searcheable_paste(Input_security_check::search_input_check($_GET['search']));
    } else {
        $products = $content->print_paste();
    }
} elseif (!strcmp($_GET['type'], 'Torte')) {
    if (isset($_GET['search'])) {
        $products = $content->print_searcheable_torte(Input_security_check::search_input_check($_GET['search']));
    } else {
        $products = $content->print_torte();
    }
}


$DOM = str_replace('<page_to_insert/>', $products, $DOM);
$DOM = str_replace('<footer_to_replace/>', '<div id="footer" class="box full_column">', $DOM);
$DOM = str_replace('<login_admin_to_insert/>', Print_content::admin_form(), $DOM);
    
echo($DOM);
?>