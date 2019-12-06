<?php
require_once 'backend/sessions.php';
Sessions::init_session();
if(!isset($_POST['username']) || !isset($_POST['password']))
    header('Location: fallback.php');
else{
    require_once 'backend/get_admin.php';
    $verify = new Get_admin();
    if(!$verify->admin($_POST['username'],$_POST['password']))
        header('Location: fallback.php');
    else
        Sessions::new_session('admin',TRUE);
}
if(!Sessions::session_exists('admin'))
    header('Location: fallback.php');
require_once 'backend/print_content.php';
echo(Print_content::top('xhtml+aria'));
echo(Print_content::openHTML());
echo(Print_content::head('Home'));
echo(Print_content::openBody());
echo(Print_content::header('Benvenuto amministratore!','home.php')."\r");
echo(Print_content::breadcrumb('<strong xml:lang="en">Home</strong>')."\r");
echo(Print_content::openGeneralContainer());
echo(Print_content::menu("home.php"));
echo(Print_content::news("home.php"));
echo(Print_content::closeDiv());

echo(Print_content::closeDiv());
echo(Print_content::footer());
echo(Print_content::closeBody());
echo(Print_content::closeHTML());
?>